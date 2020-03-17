<?php

namespace App\Http\Controllers;

use App\ClientUser;
use App\Question;
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

        $nowQuesNum = Redis::get($uuid) ?? 'unknown';
        Log::debug("nowQuestion ". $nowQuesNum);
        $question = Question::where('question_number', $nowQuesNum)->first();

        if($question->next_question != null){
            $next_flow = $this->json2array($question->next_question);

            if(count($next_flow) > 1)
                $question_number = $next_flow[(int)$answer];
            else
                $question_number = $question->next_question;

            if ($question_number != "3")
                $end = "N";
            else
                $end = "Y";

            Redis::set($uuid, $question_number);

            $question = Question::where('question_number', $question_number)->first();
            Log::debug($question_number);
            $re = [
                "uuid" => $uuid,
                "question_type" => $question->question_type,
                "question" => $this->json2array($question->question),
                "question_en" => $this->json2array($question->question_en),
                "options" => $this->json2array($question->options),
                "options_en" => $this->json2array($question->options_en),
                "end" => $end
            ];
            return $re;

        }
        else{
            $question_number = (string)((int)$nowQuesNum + 1);
            if($question_number != "3")
                $end = "N";
            else
                $end = "Y";

            Redis::set($uuid, $question_number);

            $question = Question::where('question_number', $question_number)->first();

            $re = [
                "uuid" => $uuid,
                "question_type" => $question->question_type,
                "question" => $this->json2array($question->question),
                "question_en" => $this->json2array($question->question_en),
                "options" => $this->json2array($question->options),
                "options_en" => $this->json2array($question->options_en),
                "end" => $end
            ];
            return $re;
        }
    }

    public function preQuestion(Request $request){
        $uuid = $request->input("uuid");
        $answer = $request->input("answer");

        $nowQuesNum = Redis::get($uuid) ?? 'unknown';

        $question = Question::where('next_question', $nowQuesNum)->first();

        if($question->next_question != null){
            $next_flow = $question->next_question;
            $next_flow = explode("/",$next_flow);

            if(count($next_flow) > 1)
                $question_number = $next_flow[(int)$answer];
            else
                $question_number = $question->next_question;

            if ($question_number != "3")
                $end = "N";
            else
                $end = "Y";

            Redis::set($uuid, $question_number);

            $question = Question::where('question_number', $question_number)->first();

            $re = [
                "uuid" => $uuid,
                "question_type" => $question->question_type,
                "question" => $this->json2array($question->question),
                "question_en" => $this->json2array($question->question_en),
                "options" => $this->json2array($question->options),
                "options_en" => $this->json2array($question->options_en),
                "end" => $end
            ];
            return $re;

        }
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
            Redis::set($ID_number, "1");

            $question = Question::where('question_number', "1")->first();

            $re = [
                "uuid" => $ID_number,
                "question_type" => $question->question_type,
                "question" => $this->json2array($question->question),
                "question_en" => $this->json2array($question->question_en),
                "options" => $this->json2array($question->options),
                "options_en" => $this->json2array($question->options_en),
                "end" => "N"
            ];
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

    public function json2array($json){
        Log::debug($json);
        $jsonArray = json_decode($json);
        $list = [];
        if($jsonArray === null || gettype($jsonArray) == "integer") {
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
