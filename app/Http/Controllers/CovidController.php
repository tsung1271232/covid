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

class CovidController extends Controller
{
    public function signIn(Request $request)
    {
        if($request->has("id_number")){
            $name = $request->input('name') ?? '';
            $birth = $request->input('birth') ?? '';
            $ID_number = $request->input('id_number') ?? '';
            $address = $request->input('address') ?? '';
            $tel_home = $request->input('tel_home') ?? '';
            $tel_mobile = $request->input('tel_mobile') ?? '';

            $client_user = ClientUser::whereIdNumber($ID_number)->first();
            if($client_user === null){
                $client_user = new ClientUser;
                $client_user->name = $name;
                $client_user->ID_number = $ID_number;
                $client_user->birth = $birth;
                $client_user->address = $address;
                $client_user->tel_home = $tel_home;
                $client_user->tel_mobile = $tel_mobile;
                $client_user->save();
            }
            $uuid = Uuid::generate()->string;

            $re = [
                "state" => "true",
                "uuid" => $uuid
            ];
            return $re;
        }
        else{
            $re = [
                "state" => "false",
                "uuid" => ""
            ];
            return $re;
        }
    }

    public function startQuestion(Request $request){
        if($request->has("id_number")){
            $name = $request->input('name') ?? '';
            $birth = $request->input('birth') ?? '';
            $ID_number = $request->input('id_number') ?? '';
            $address = $request->input('address') ?? null;
            $tel_home = $request->input('tel_home') ?? null;
            $tel_mobile = $request->input('tel_mobile') ?? null;
            $topic_id = $request->input('topic_id') ?? null;

            $client_user = ClientUser::whereIdNumber($ID_number)->first();
            if($client_user === null) {
                $client_user = new ClientUser;
                $client_user->name = $name;
                $client_user->ID_number = $ID_number;
                $client_user->birth = $birth;
                $client_user->address = $address;
                $client_user->tel_home = $tel_home;
                $client_user->tel_mobile = $tel_mobile;
                $client_user->save();
            }
            Redis::set($ID_number, "1");

            $question = Question::where('question_number', "1")->first();
            $re = new QuestionResource($question);
            $re["uuid"] = $ID_number;
            $re["end"] = "N";
            return $re;

        }
        else{
            $re = [
                "state" => "false",
                "uuid" => "",
            ];
            return $re;
        }
    }

    public function nextQuestion(Request $request){
        $uuid = $request->input("uuid");
        $answer = $request->input("answer");

        $nowUsageCount = Redis::get($uuid) ?? 'unknown';
        $nowQuesNum = Redis::get($uuid."@".$nowUsageCount);
        Log::debug($nowUsageCount. " " . $nowQuesNum);
        $maxQuesNum = Topic::find(Redis::get($uuid."_topic"))->max_number;

        if($nowQuesNum >= $maxQuesNum){
            Redis::set($uuid, (string)((int)$nowUsageCount+1));
            Redis::set($uuid."@".(string)((int)$nowUsageCount+1), (string)((int)$maxQuesNum+1));

            $re = new QuestionResource(new Question, $uuid, "Y", "None");
            return $re;
        }

        $question = Question::where('question_number', $nowQuesNum)->first();

        $next_flow = $this->json2array($question->next_question);
        Log::debug($next_flow);

        $question_number = (count($next_flow) > 1)? $next_flow[(int)$answer] : $question->next_question;

        $question = Question::where('question_number', $question_number)->first();

        Redis::set($uuid, (string)((int)$nowUsageCount+1));
        Redis::set($uuid."@".(string)((int)$nowUsageCount+1), $question_number);

        $end = ($question->next_question === null)?"Y":"N";

        $re = new QuestionResource($question, $uuid, $end, $question_number);
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
            $ID_number = $request->input('id_number') ?? '';
            $address = $request->input('address') ?? null;
            $tel_home = $request->input('tel_home') ?? null;
            $tel_mobile = $request->input('tel_mobile') ?? null;
            $topic_id = $request->input('topic_id') ?? null;

            $client_user = ClientUser::whereIdNumber($ID_number)->first();
            if($client_user === null) {
                $client_user = new ClientUser;
                $client_user->name = $name;
                $client_user->ID_number = $ID_number;
                $client_user->birth = $birth;
                $client_user->address = $address;
                $client_user->tel_home = $tel_home;
                $client_user->tel_mobile = $tel_mobile;
                $client_user->save();
            }

            /* $ID_number: $current usage counter*/
            Redis::set($ID_number, "0");
            /* $ID_number_topic: topic_id*/
            // TODO:
            Redis::set($ID_number."_topic", "1");
            /* $state == $ID_number-$usage_counter, ex: F111@15 */
            $state = $ID_number . "@0";
            /* F111@15: question_number*/
            Redis::set($state, "1");

            $question = Question::where('question_number', "1")->first();

            $re = new QuestionResource($question, $ID_number, "N", "1");
            return $re;
        }
        else{
            $re = [
                "state" => "false",
                "uuid" => "",
            ];
            return $re;
        }
    }

    public function endQuestion(Request $request){
        if ($request->hasFile('signature')) {

            $uuid = $request->input("uuid");
            $signature = $request->input("signature");
            $file_name = $signature->getClientOriginalName();
            //  $signature->move('uploads', $file_name);

            $path = $request->signature->storeAs('uploads', $file_name);

            $re = [
                "state" => "ture",
            ];
            return $re;
        }
        else {
            $re = [
                "state" => "false",
            ];
            return $re;
        }
    }

    public function json2array($json){
        $jsonArray = json_decode($json);
        $list = [];
        if($jsonArray === null || gettype($jsonArray) != "object") {
            array_push($list, $json);
        }
        else{
            foreach ($jsonArray as $key => $value){
                array_push($list, $value);
            }
        }
        return $list;
    }

}
