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
    public function __construct($resource, $uuid, $end, $question_number, $flag = false, $max_number = null)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;

        $this->uuid = $uuid;
        $this->end = $end;
        $this->question_number = $question_number;
        $this->flag = $flag;
        $this->max_nubmer = $max_number;
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
            "uuid" => $this->uuid,
            "question_type" => $this->question_type,
            "question" => json2array($this->question),
            "question_en" => json2array($this->question_en),
            "options" => json2array($this->options),
            "options_en" => json2array($this->options_en),
            // TODO: conditional
            "end" => $this->end,
            "question_number" => $this->question_number,
            "max_number" => $this->when($this->flag, $this->max_nubmer)
        ];
    }
}
