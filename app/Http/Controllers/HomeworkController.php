<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Psy\debug;
use Illuminate\Support\Facades\View;

class HomeworkController extends Controller
{
    public function index()
    {
        return view('homework.index');
    }

    public function buttonExample($query_type)
    {
        $table_head = array();
        switch ($query_type) {
            case "count":
                array_push($table_head, "count result");
                $contents = DB::table('topic_records')->where('client_user_id', 1)->count();
                $contents = array($contents);
                break;
            case "max":
                array_push($table_head, "max result");
                $contents =  DB::table('topics')->max('max_number');
                $contents = array($contents);
                break;
            case "min":
                array_push($table_head, "min result");
                $contents =  DB::table('topics')->min('max_number');
                $contents = array($contents);
                break;
            case "avg":
                array_push($table_head, "avg result");
                $contents =  DB::table('topic_records')->groupBy('client_user_id')->avg('finish');
                $contents = array($contents);
                break;
            case "sum":
                array_push($table_head, "sum result");
                $contents =  DB::table('topics')->sum('max_number');
                $contents = array($contents);
                break;
            case "having":
                $contents = DB::select("select * from topic_records group by client_user_id having finish = 1");
                if($contents)
                    $table_head = array_keys((array)$contents[0]);
                break;
            case "exist":
                $contents = DB::select("SELECT * FROM client_users WHERE EXISTS (SELECT * FROM topic_records WHERE client_users.id = topic_records.client_user_id)");
                if($contents)
                    $table_head = array_keys((array)$contents[0]);
                break;
            case "in":
                $contents = DB::select("SELECT * FROM client_users WHERE id in (SELECT client_user_id FROM topic_records)");
                if($contents)
                    $table_head = array_keys((array)$contents[0]);
                break;
        }
        if(empty($table_head)){
            return view('homework.index', ['heads' => "not found", 'content' => "not found"]);
        }
        else
            return view('homework.index', ['heads' => $table_head, 'contents' => $contents]);
    }

    public function queryExample(Request $request)
    {
        $table_head = array();
        if($request->input('sql_command')){
            $contents = DB::select($request->input('sql_command'));
//            dd($contents);
        }
        if(is_array($contents))
            $table_head = array_keys((array)$contents[0]);
        else
            array_push($table_head, "sql result");

        if(empty($table_head)){
            return view('homework.index', ['heads' => "not found", 'content' => "not found"]);
        }
        else
            return view('homework.index', ['heads' => $table_head, 'contents' => $contents]);
        return $user;
    }
}
