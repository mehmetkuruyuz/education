<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinavModel extends Model
{
      protected $table = 'sinavs';
      protected $primaryKey='id';


      public function newQuery($excludeDeleted = true)
      {
          return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
      }

      public function questions()
      {
          return $this->hasMany('App\SinavQuestionModel','pollsId', 'id');
      }


}
