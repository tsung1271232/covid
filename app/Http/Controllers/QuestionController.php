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
        $contents = $topic->question;
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
        //
        $question = new Question;
        $question->question_number = $request->question_number ?? '';
        $question->question_type = $request->question_type ?? '';
        $question->topic_id = $request->topic_id ?? '';
        $question->question_id = $request->question_id ?? null;
        $question->question = $request->question ?? '';
        $question->question_en = $request->question_en ?? null;
        $question->options_id = $request->options_id ?? null;
        $question->options = $request->options ?? null;
        $question->options_en = $request->options_en ?? null;
        $question->required = $request->required ?? "Y";
        $question->next_question = $request->next_question ?? null;
        $question->save();
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
    public function update(Request $request, Question $question)
    {
        //
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
}
