<?php


namespace App;
use App\Topic;

class CovidJson
{
    private $typeMapping = [
      "D" => "DT",
      "R" => "R",
      "RS" => "R",
      "T" => "T"
    ];

    public function create(Topic $topic){
        $questionList = $topic->question;
        $defaultCollection = $this->parseCovidJsonFormat($questionList);
        return $defaultCollection;
    }

    public function parseCovidJsonFormat($questionList){
        $defaultCollection = collect();

        foreach ($questionList as $oneQuestion) {
            $questionCodes = json2array($oneQuestion->question_code);
            $optionCodes = json2array($oneQuestion->options_code);

            foreach ($questionCodes as $questionCode){
                foreach($optionCodes as $optionCode){
                    $empty = array(
                        "SubtopicID" => "0",
                        "QuestionID" => $questionCode,
                        "QuestionType" => $this->typeMapping[$oneQuestion->question_type],
                        "AnswerScore" => "",
                        "AnswerSn" => "1",
                        "OptionID" => ($optionCode === null)?"":$optionCode,
                        "ParentID" => (count(explode(".", $oneQuestion->question_number)) > 1)?explode(".", $oneQuestion->question_number)[0]:"",
                        "Checked" =>false,
                        "Value" =>"on"
                    );

                    $defaultCollection->push(collect($empty));
                }
            }
        }
        return $defaultCollection;
    }
}
