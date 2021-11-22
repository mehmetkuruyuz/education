<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SinavQuestionModel extends Model
{

  protected $table = 'sinavquestions';
  protected $primaryKey='id';


  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no")->orderBy("ordernum", "asc");
  }



  public function answers()
  {
      return $this->hasMany('\App\SinavAnswerModel','questionid', 'id');
  }

  public function kategoriname()
  {
      return $this->hasOne('\App\SinavTypeModel', 'id','kategori');
  }

}
