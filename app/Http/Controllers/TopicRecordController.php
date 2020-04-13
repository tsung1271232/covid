<?php

namespace App\Http\Controllers;

use App\ClientUser;
use App\TopicRecord;
use Illuminate\Http\Request;

class TopicRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientUser $user)
    {
        //
        $contents = $user->topicRecord;
        return view('topicRecord.index', ['records' => $contents]);
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
     * @param  \App\TopicRecord  $topicRecord
     * @return \Illuminate\Http\Response
     */
    public function show(TopicRecord $topicRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TopicRecord  $topicRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(TopicRecord $topicRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TopicRecord  $topicRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopicRecord $topicRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TopicRecord  $topicRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopicRecord $topicRecord)
    {
        //
    }
}
