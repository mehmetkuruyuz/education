<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PollQuestionModel extends Model
{

  protected $table = 'pollsquestions';
  protected $primaryKey='id';


  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no")->orderBy("ordernum", "asc");
  }



  public function answers()
  {
      return $this->hasMany('\App\PollAnswerModel','questionid', 'id');
  }

  public function kategoriname()
  {
      return $this->hasOne('\App\PollsTypeModel', 'id','kategori');
  }

}
