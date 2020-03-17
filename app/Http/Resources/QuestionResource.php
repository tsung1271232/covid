<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "question_type" => $this->question_type,
            "question" => $this->json2array($this->question),
            "question_en" => $this->json2array($this->question_en),
            "options" => $this->json2array($this->options),
            "options_en" => $this->json2array($this->options_en)
        ];
//        return parent::toArray($request);
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
