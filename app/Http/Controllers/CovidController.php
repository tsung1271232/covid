<?php

namespace App\Http\Controllers;

use App\ClientUser;
use App\Question;
use App\Topic;
use http\Env\Response;
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
            return response()->json(['message' => "id number not found"], 400);
        }
        else{
            //TODO
//            $client = new \GuzzleHttp\Client();
//            $response = $client->post(env("Hosipital_Url")."/Set2019nCoVAneswerByJson", [
//                'form_params' => [
//                    'IDNo' => $id_number,
//                ]
//            ]);
//            if($response->getStatusCode() != "200"){
//                return response()->json(['message' => "Set2019nCoVAneswerByJson API error: " . $response->getReasonPhrase()], 400);
//            }
//            else{
//                $data = json_decode($response->getBody(), true);
    //            for($i = 0; $i < count($data); $i++){
    //                $data[$i]["id_number"] = $id_number;
    //            }
//                return response()->json($data,200);
//            }

            return response()->json([["Chart_No" => "88888", 'Patient_Name' => "aaa", "Birth" => "1997-01-01", "Height" => "180",
                "Weight" => "180", "Sex" => "男", "Age"=> "58", "BloodyType" => "o+", "id_number" => $id_number], ["Chart_No" => "7777", 'Patient_Name' => "bbb", "Birth" => "1997-01-01", "Height" => "180",
                "Weight" => "180", "Sex" => "女", "Age"=> "58", "BloodyType" => "o+", "id_number" => $id_number] ], 200);
        }
    }

    public function confirmPatient(Request $request)
    {
        $name = $request->input('name') ?? null;
        $birth = $request->input('birth') ?? null;
        $sex = $request->input('sex') ?? null;
        $ID_number = $request->input('id_number') ?? null;
        $chart_no = $request->input('Chart_No') ?? null;
        if($name=== null || $birth=== null|| $sex=== null|| $ID_number=== null|| $chart_no=== null)
            return response()->json(['message' => "loss information"], 400);

        $client_user = ClientUser::whereMedicalNumber($chart_no)->first();
        if($client_user === null)
            $client_user = new ClientUser;
        $client_user->name = $name;
        $client_user->ID_number = $ID_number;
        $client_user->birth = $birth;
        $client_user->sex = $sex;
        $client_user->medical_number = $chart_no;
        $client_user->address = null;
        $client_user->tel_home = null;
        $client_user->tel_mobile = null;
        $client_user->save();

        $topicRecords = $client_user->topicRecord;
        /* get latest one */
        $latest = TopicRecord::where('client_user_id', $client_user->id)->where('topic_id', "1")->orderBy('id', 'desc')->first();
        $flag = ($latest->finish == "1") ? true:false;
        return response()->json(['uuid' => $chart_no, "patient_fill" => $flag], 200);
    }

    public function nextQuestion(Request $request){
        $uuid = $request->input("uuid") ?? null;
        $answer = $request->input("Answer") ?? $request->input("answer");

        log::debug($answer);
        if($uuid == null || $answer == null){
            return response()->json(['status' => false, 'message' => 'uuid or answer not found'], 400);
        }

        /* get current user state*/
        $nowUsageCount = Redis::get($uuid);
        $nowQuesNum = Redis::get($uuid."@".$nowUsageCount);

        /* save answer record*/
        $cur_topic_id = Redis::get($uuid."@topic");
        $cur_question = Question::where('topic_id', $cur_topic_id)->where('question_number', $nowQuesNum)->first();
        $userTopicRecordID = Redis::get($uuid."@topicRecord");
        $record = QuestionRecord::where('topic_record_id', $userTopicRecordID)->where('question_number', $nowQuesNum)->first();
        if($record === null) {
            $record = new QuestionRecord;
            $record->topic_record_id = $userTopicRecordID;
            $record->question_number = $nowQuesNum;
            $record->question_type = $cur_question->question_type;
            $record->question_code = $cur_question->question_code;
            $record->options_code = $cur_question->options_code ?? null;
            $record->value = $answer;
            $record->save();
        } else {
            $record->value = $answer;
            $record->save();
        }

        if($cur_question->next_question === null){
            $re = new QuestionResource(new Question, $uuid, "Y", "None");
            return $re;
        }

        $next_flow = json2array($cur_question->next_question);

        $next_question_number = (count($next_flow) > 1)? $next_flow[(int)$answer] : $cur_question->next_question;
        Log::debug("next question " . $next_question_number);

        $next_question = Question::where('topic_id', $cur_topic_id)->where('question_number', $next_question_number)->first();

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
        $cur_topic_id = Redis::get($uuid."@topic");
        $question = Question::where('topic_id', $cur_topic_id)->where('question_number', $preQuesNum)->first();
        Redis::set($uuid, $preUsageCount);

        $end = ($question->next_question === null)?"Y":"N";

        Log::debug($preQuesNum);

        $re = new QuestionResource($question, $uuid, $end, $preQuesNum);
        return $re;
    }

    public function new_startQuestion(Request $request){
        $topic_id = $request->topic_id;
        $medical_number = $request->uuid;
        $client_user = ClientUser::whereMedicalNumber($medical_number)->first();

        /*
            $chart_no: $current usage counter
            $chart_no_topic: topic_id
            $state: $chart_no @ $usage_counter, ex: F111@15
            F111@15: question_number
        */
        Redis::set($client_user->medical_number, "0");
        Redis::set($client_user->medical_number."@topic", $topic_id);
        Redis::set($client_user->medical_number."@0", "1");

        $topic = Topic::find($topic_id);
        $question = $topic->question;
        $question = $question->firstWhere("question_number", "1");
        /* save new topic record */
        $topicRecord = new TopicRecord();
        $topicRecord->client_user_id = $client_user->id;
        $topicRecord->topic_id = $topic_id;
        $topicRecord->finish = false;
        $topicRecord->signature_path = null;
        $topicRecord->save();
        log::debug("topic record: " . $topicRecord->id);
        /* $chart_no @ topic_record id, for collect record and report*/
        Redis::set($client_user->medical_number.'@topicRecord', $topicRecord->id);

        $re = new QuestionResource($question, $client_user->medical_number, "N", "1", true, $topic->max_number);
        return $re;
    }

    /* after finish questionnaire, we get the signature, and post data to hosipital*/
    public function endQuestion(Request $request){
        $uuid = $request->input("uuid") ?? null;
        $signature = $request->input("signature") ?? "lalalla";

        if($uuid === null || $signature === null){
            return response()->json(['status' => false, 'message' => 'missing uuid or signature'], 400);
        }

        /* save signature */
        $topicRecordID = Redis::get($uuid.'@topicRecord');
        Storage::disk('local')->put($uuid. '-'.$topicRecordID.'.png', $signature);
        $topicRecord = TopicRecord::find($topicRecordID);
        $topicRecord->finish = true;
        $topicRecord->signature_path = $uuid. '-' . $topicRecordID . '.png';
        $topicRecord->save();
        try {
            $rtnAnswer = $this->forward2Hosp($topicRecord, Topic::find($topicRecord->topic_id), $uuid, $signature);
            return response()->json(['status' => true], 200);
        }
        catch(\Exception $e){
            log::emergency($e->getMessage());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function test($topicRecord, $topic){
        $rtnAnswer = $this->forward2Hosp(TopicRecord::find($topicRecord), Topic::find($topic), 7777, "none");
        return response()->json([$rtnAnswer], 200);
    }

    /* patient_fill and self_manage*/
    public function forward2Hosp(TopicRecord $topicRecord, Topic $topic, $uuid, $signature){
        $typeMapping = [
            // TODO DT 圖和文字 描述不一樣
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
//                'TopicID' => $topic->topic_code,
//                "ChartNo" => $uuid,
//                "Singbase64" => $signature,
//            ]
//        ]);
        return $rtnAnswer;
    }
    /* should fill covid first*/
    public function selfManage(Request $request)
    {
//        $address = $request->address ?? null;
//        $name = $request->name ?? null;
//        $tel_mobile = $request->tel_mobile ?? null;
//        $tel_home = $request->tel_home ?? null;
//        $ID_number = $request->id_number ?? null;
//        $topic_id = $request->topic_id ?? null;
//        $uuid = $request->Chart_No ?? null;

        $address = $request->address ?? "123";
        $name = $request->name ?? "123";
        $tel_mobile = $request->tel_mobile ?? "123";
        $tel_home = $request->tel_home ?? "123";
        $ID_number = $request->id_number ?? "123";
        $topic_id = $request->topic_id ?? "2";
        $uuid = $request->Chart_No ?? "7777";

        if($address === null || $name === null || $tel_mobile === null || $tel_home === null || $ID_number === null || $uuid === null){
            return response()->json(['message' => "loss information"], 400);
        }

        /* check user*/
        $client_user = ClientUser::whereMedicalNumber($uuid)->first();
        if($client_user === null) {
            return response()->json(['status' => false, 'message' => "user not found"], 400);
        }
        else{
            $client_user->address = $address;
            $client_user->tel_home = $tel_home;
            $client_user->tel_mobile = $tel_mobile;
            $client_user->save();
        }

        $topicRecord = TopicRecord::where('client_user_id', $client_user->id)->where('topic_id', $topic_id)->first();
        /* check record */
        if($topicRecord === null){ /* insert new topic record */
            log::debug("沒寫過");
            $topicRecord = new TopicRecord();
            $topicRecord->client_user_id = $client_user->id;
            $topicRecord->topic_id = $topic_id;
            $topicRecord->finish = 0;
            $topicRecord->signature_path = null;
            $topicRecord->save();
            $topicRecordId = $topicRecord->id;
            try{
                /* new question records */
                $questions = Question::where('topic_id', $topic_id)->get();
                $user_ans = array('Address' => $address, 'ID_No'=>$ID_number, 'Patient_Name' => $name, 'Tel_Home' => $tel_home, 'Tel_Mobile' => $tel_mobile);
                $data = $questions->map(function($item) use ($topicRecordId, $user_ans) {
                    return ['topic_record_id' => $topicRecordId, 'question_number' => $item->question_number, 'question_type' => $item->question_type,
                        'question_code' => $item->question_code, 'options_code' => null, 'value' => $user_ans[$item->question_code]];
                });
                QuestionRecord::insert($data->toArray());
//                return $data;
            } catch(\Exception $e){
                log::emergency($e->getMessage());
                return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
            }
            /* 記錄使用者最後位置 */
            Redis::set($client_user->medical_number.'@topicRecord', $topicRecord->id);
            return response()->json(['status' => true], 200);
        } /* overwrite record */
        else{
            log::debug("寫過了");
//            $questionRecords = $topicRecord->questionRecord;
            Redis::set($client_user->medical_number.'@topicRecord', $topicRecord->id);
            return response()->json(['status' => true], 200);
        }
    }
}
