<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicRecord extends Model
{
    //
    public function questionRecord(){
        return $this->hasMany("App\QuestionRecord");
    }
}
