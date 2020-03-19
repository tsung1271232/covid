<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $id_number, $end, $question_number)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;

        $this->id_number = $id_number;
        $this->end = $end;
        $this->question_number = $question_number;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "uuid" => $this->id_number,
            "question_type" => $this->question_type,
            "question" => $this->json2array($this->question),
            "question_en" => $this->json2array($this->question_en),
            "options" => $this->json2array($this->options),
            "options_en" => $this->json2array($this->options_en),
            // TODO: conditional
            "end" => $this->end,
            "question_number" => $this->question_number,
        ];
    }
    public function json2array($json){
        $json_array = json_decode($json);
        $list = [];
        if($json_array === null) {
            array_push($list, $json);
        }
        else{
            foreach ($json_array as $key => $value){
                array_push($list, $value);
            }
        }
        return $list;
    }
}
