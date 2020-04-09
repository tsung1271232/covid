<?php

namespace App\Http\Controllers;

use App\ClientUser;
use App\Question;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Webpatser\Uuid\Uuid;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Log;
use Storage;
use App\TopicRecord;
use App\CovidJson;
use App\QuestionRecord;
use GuzzleHttp\Client;

class CovidController extends Controller
{
    public function patientProfile(Request $request)
    {
        $id_number = $request->id_number ?? null;
        if($id_number === null){
            return response()->json(['status' => "id number not found"], 400);
        }
        else{
//            $client = new \GuzzleHttp\Client();
//            $response = $client->post(env("Hosipital_Url")."/Set2019nCoVAneswerByJson", [
//                'form_params' => [
//                    'IDNo' => $id_number,
//                ]
//            ]);
            return response()->json([["Chart_No" => "88888", 'Patient_Name' => "aaa", "Birth" => "1997-01-01", "Height" => "180",
                "Weight" => "180", "Sex" => "男", "Age"=> "58", "BloodyType" => "o+", "id_number" => $id_number], ["Chart_No" => "7777", 'Patient_Name' => "bbb", "Birth" => "1997-01-01", "Height" => "180",
                "Weight" => "180", "Sex" => "女", "Age"=> "58", "BloodyType" => "o+", "id_number" => $id_number] ], 200);
        }
    }

    public function nextQuestion(Request $request){
        $uuid = $request->input("uuid");
        $answer = $request->input("answer");

        /* get current user state*/
        $nowUsageCount = Redis::get($uuid) ?? 'unknown';
        $nowQuesNum = Redis::get($uuid."@".$nowUsageCount);
        Log::debug($nowUsageCount. " " . $nowQuesNum);

        /* save answer record*/
        $cur_question = Question::where('topic_id', Redis::get($uuid."@topic"))->where('question_number', $nowQuesNum)->first();
        $userTopicRecordID = Redis::get($uuid."@topicRecord");
        $record = QuestionRecord::where('topic_record_id', $userTopicRecordID)->where('question_number', $nowQuesNum)->first();
        if($record === null) {
            $record = new QuestionRecord;
            $record->topic_record_id = $userTopicRecordID;
            $record->question_number = $nowQuesNum;
            $record->question_type = $cur_question->question_type;
            $record->question_code = $cur_question->question_code;
            $record->options_code = $cur_question->options_code ?? null;
            $record->value = $request->answer;
            $record->save();
        } else {
            $record->value = $request->answer;
            $record->save();
        }

        if($cur_question->next_question === null){
//            Redis::set($uuid, (string)((int)$nowUsageCount+1));
//            Redis::set($uuid."@".(string)((int)$nowUsageCount+1), (string)((int)$nowQuesNum+1));
            // return empty
            $re = new QuestionResource(new Question, $uuid, "Y", "None");
            return $re;
        }

        $next_flow = json2array($cur_question->next_question);

        $next_question_number = (count($next_flow) > 1)? $next_flow[(int)$answer] : $cur_question->next_question;
        Log::debug("next question " . $next_question_number);

        $next_question = Question::where('question_number', $next_question_number)->first();

        Redis::set($uuid, (string)((int)$nowUsageCount+1));
        Redis::set($uuid."@".(string)((int)$nowUsageCount+1), $next_question_number);

        $end = ($next_question->next_question === null)?"Y":"N";
        $re = new QuestionResource($next_question, $uuid, $end, $next_question_number);
        return $re;
    }

    public function preQuestion(Request $request){
        $uuid = $request->input("uuid");

        $nowUsageCount = Redis::get($uuid) ?? 'unknown';
        $preUsageCount = (string)((int)$nowUsageCount-1);
        $preQuesNum = Redis::get($uuid."@".$preUsageCount);
        $question = Question::where('question_number', $preQuesNum)->first();

        Redis::set($uuid, $preUsageCount);

        $end = ($question->next_question === null)?"Y":"N";

        Log::debug($preQuesNum);

        $re = new QuestionResource($question, $uuid, $end, $preQuesNum);
        return $re;
    }

    public function new_startQuestion(Request $request){
        if($request->has("id_number")){
            $name = $request->input('name') ?? '';
            $birth = $request->input('birth') ?? '';
            $sex = $request->input('sex') ?? '';
            $ID_number = $request->input('id_number') ?? '';
            $chart_no = $request->input('Chart_No') ?? '';
            $topic_id = $request->input('topic_id') ?? '1';

            $address = $request->input('address') ?? null;
            $tel_home = $request->input('tel_home') ?? null;
            $tel_mobile = $request->input('tel_mobile') ?? null;

            $client_user = ClientUser::whereIdNumber($ID_number)->first();
            if($client_user === null) {
                $client_user = new ClientUser;
                $client_user->name = $name;
                $client_user->ID_number = $ID_number;
                $client_user->birth = $birth;
                $client_user->sex = $sex;
                $client_user->medical_number = $chart_no;

                $client_user->address = $address;
                $client_user->tel_home = $tel_home;
                $client_user->tel_mobile = $tel_mobile;
                $client_user->save();
            }

            /*
                $chart_no: $current usage counter
                $chart_no_topic: topic_id
                $state: $chart_no @ $usage_counter, ex: F111@15
                F111@15: question_number
            */
            //TODO: $ID_number -> $chart_no,
            Redis::set($ID_number, "0");
            Redis::set($ID_number."@topic", $topic_id);
            Redis::set($ID_number."@0", "1");

            $topic = Topic::find($topic_id);
            $question = $topic->question;
            $question = $question->firstWhere("question_number", "1");
            /* save record */
            $topicRecord = new TopicRecord();
            $topicRecord->client_user_id = $client_user->id;
            $topicRecord->topic_id = $topic_id;
            $topicRecord->finish = false;
            $topicRecord->signature_path = null;
            $topicRecord->save();

            /* $chart_no @ topic_record id, for collect record and report*/
            Redis::set($ID_number.'@topicRecord', $topicRecord->id);

            $re = new QuestionResource($question, $ID_number, "N", "1", true, $topic->max_number);
            return $re;
        }
        else{
            return response()->json(['status' => false, 'uuid' => ''], 400);
        }
    }

    /* after finish questionnaire, we get the signature, and post data to hosipital*/
    public function endQuestion(Request $request){
        $uuid = $request->input("uuid") ?? null;
        $signature = $request->input("signature") ?? null;

        if($uuid === null || $signature === null){
            return response()->json(['status' => false], 400);
        }
        else{
            /*save signature*/
            Storage::disk('local')->put($uuid.'.png', $signature);
            $topicRecordID = Redis::get($uuid.'@topicRecord');
            $topicRecord = TopicRecord::find($topicRecordID);
            $topicRecord->finish = true;
            $topicRecord->signature_path = $uuid.'.png';
            $topicRecord->save();
            $this->forward2Hosp($topicRecord, Topic::find($topicRecord->topic_id), $uuid, $signature);
        }



        if($uuid === null || $signature === null){
            return response()->json(['status' => false], 400);
        }
        else{
            return response()->json(['status' => true], 200);
        }
    }

    public function test(){
    }

    public function forward2Hosp(TopicRecord $topicRecord, Topic $topic, $uuid, $signature){
        $typeMapping = [
            "D" => "DT",
            "R" => "R",
            "RS" => "R",
            "T" => "T"
        ];
        //TODO: data format

        $rtnAnswer = new CovidJson();
        $rtnAnswer = $rtnAnswer->create($topic);

        $questionRecord = $topicRecord->questionRecord;

        foreach($questionRecord as $oneRecord) {
            $question_code = json2array($oneRecord->question_code);
            $value = json2array($oneRecord->value);

            $pair = array_combine($question_code, $value);

            foreach ($pair as $Q => $A){
                if($typeMapping[$oneRecord->question_type] == "R"){
                    $idx = $rtnAnswer->search(function ($item, $key) use ($Q, $A, $oneRecord){
                        if($item["QuestionID"] == $Q && $item["OptionID"] == json2array($oneRecord->options_code)[$A])
                            return $item;
                    });
                    $rtnAnswer[$idx]["Checked"] = true;
                }
                else{
                    $idx = $rtnAnswer->search(function ($item, $key) use ($Q, $A, $oneRecord){
                        if($item["QuestionID"] == $Q && $item["OptionID"] == "")
                            return $item;
                    });
                    $rtnAnswer[$idx]["value"] = $A;
                }
            }
        }

//        $client = new \GuzzleHttp\Client();
//        $response = $client->post(env("Hosipital_Url")."/Set2019nCoVAneswerByJson", [
//            'form_params' => [
//                'rtnAnswer' => $rtnAnswer,
//                'TopicID' => $topic->description,
//                "ChartNo" => $uuid,
//                "Singbase64" => $signature,
//            ]
//        ]);
        return $rtnAnswer;
    }
    //TODO:
    public function selfManage(Request $request)
    {
        return response()->json(['status' => true], 200);
    }

}
