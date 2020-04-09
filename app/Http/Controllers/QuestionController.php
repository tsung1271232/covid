<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Imports\QuestionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Topic;

class QuestionController extends Controller
{
//    public function import(Request $request)
    public function import(string $file_name)
    {
//        $collection = Excel::toCollection(new QuestionImport, $request->excel);
        $collection = Excel::toCollection(new QuestionImport, $file_name);
        /*only deal with one sheet*/
        $new_collection = collect();
        foreach ($collection as $sheet) {
            $title = $sheet->all()[0];
            Log::debug($title);
            $new_sheet = collect();
            foreach ($sheet as $question) {
                $new_question = $title->combine($question);
                $new_sheet->push($new_question);
            }
            $new_collection->push($new_sheet);
        }
        $new_collection = $new_collection->collapse();
        return $new_collection->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        $contents = $topic->question->all();
        usort($contents, function($a, $b) {
            return (float)$a->question_number > (float)$b->question_number;
        });
        return view('question.index', ['questions' => $contents, 'topic_id' => $topic->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->question_number = $request->question_number ?? '';
        $question->question_type = $request->question_type ?? '';
        $question->topic_id = $request->topic_id ?? '';
        $question->question_code = $request->question_code ?? null;
        $question->question = $request->question ?? '';
        $question->question_en = $request->question_en ?? null;
        $question->options_code = $request->options_code ?? null;
        $question->options = $request->options ?? null;
        $question->options_en = $request->options_en ?? null;
        $question->required = $request->required ?? "Y";
        $question->next_question = $request->next_question ?? null;

        try{
//            $question->save();
            return response()->json(['status' => true], 200);
        }
        catch (\Exception $e){
            return response()->json(['status' => false], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $content = Question::where('topic_id', $request->topic_id)->where('question_number', $request->ori_question_number)->first();
        $content->question_number = $request->question_number;
        log::debug($request->question_number);
        $content->next_question = $request->next_question;
        $content->topic_id = $request->topic_id;
        $content->options = $request->options;
        $content->options_en = $request->options_en;
        $content->options_code = $request->options_code;
        $content->question = $request->question;
        $content->question_en = $request->question_en;
        $content->question_code = $request->question_code;
        $content->question_type = $request->question_type;
        $content->required = $request->required;

        try{
            $content->save();
            return response()->json(['status' => true], 200);
        }
        catch (\Exception $e){
            return response()->json(['status' => false], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function getContent(Request $request){
        $topic_id = $request->topic_id;
        $question_number = $request->question_number;

        $content = Question::where('topic_id', $topic_id)->where('question_number', $question_number)->get();
        log::debug($content);
        return $content;
    }
}
