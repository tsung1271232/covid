<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientUser extends Model
{
    //
    public function topicRecord()
    {
        return $this->hasMany('App\TopicRecord');
    }
}
