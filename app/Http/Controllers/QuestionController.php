<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Imports\QuestionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function import(Request $request)
    {
        $collection = Excel::toCollection(new QuestionImport, $request->excel);

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
        return $new_collection;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
