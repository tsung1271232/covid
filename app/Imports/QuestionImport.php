<?php

namespace App\Imports;

use App\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToArray;

use Maatwebsite\Excel\Concerns\Importable;

class QuestionImport implements ToCollection
{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
    use Importable;
    public function model(array $row)
    {
//        Log::debug($row["題號"]);
//        return new Question([
//            "question_number" => $row["題號"] ?? 'None',
//            "question" => $row["題目"] ?? 'None',
//            "question_en" => $row["英文題目"] ?? 'None',
//            "required" => $row["必答"] ?? 'None'
//        ]);
    }
//
//    /**
//     * @inheritDoc
//     */
    public function collection(Collection $rows)
    {
        // TODO: Implement collection() method.
        foreach($rows as $row){
            Question::create([
                "question_number" => $row[0] ?? 'None',
            ]);
        }

    }
}
