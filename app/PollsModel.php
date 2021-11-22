<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollsModel extends Model
{
      protected $table = 'polls';
      protected $primaryKey='id';


      public function newQuery($excludeDeleted = true)
      {
          return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
      }

      public function questions()
      {
          return $this->hasMany('App\PollQuestionModel','pollsId', 'id');
      }

}
