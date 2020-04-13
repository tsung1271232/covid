<?php

namespace App\Http\Controllers;

use App\QuestionRecord;
use App\TopicRecord;
use Illuminate\Http\Request;

class QuestionRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TopicRecord $topic_record_id)
    {
        //

        $contents = $topic_record_id->questionRecord;
        $sorted = $contents->sort(function ($a, $b){
            return (float)$a->question_number > (float)$b->question_number;
        });

        return view('questionRecord.index', ['records' => $sorted]);
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
     * @param  \App\QuestionRecord  $questionRecord
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionRecord $questionRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionRecord  $questionRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionRecord $questionRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionRecord  $questionRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionRecord $questionRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionRecord  $questionRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionRecord $questionRecord)
    {
        //
    }
}
