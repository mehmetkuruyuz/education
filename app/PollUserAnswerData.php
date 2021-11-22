<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollUserAnswerData extends Model
{
      protected $table = 'PollUserAnswerData';
      protected $primaryKey='id';
      protected $fillable=["questionid","userid","answerid","puan","status","deleted"];

      public function newQuery($excludeDeleted = true)
      {
          return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
      }




}
