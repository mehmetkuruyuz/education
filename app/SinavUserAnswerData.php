<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinavUserAnswerData extends Model
{
      protected $table = 'SinavUserAnswerData';
      protected $primaryKey='id';
      protected $fillable=["questionid","userid","answerid","puan","status","deleted"];

      public function newQuery($excludeDeleted = true)
      {
          return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
      }

      public function user()
      {
          return $this->hasOne('\App\User', 'id','userid');
      }


}
