<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinavAnswerModel extends Model
{


  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted","=", "no");
  }

  protected $table = 'sinavanswer';
  protected $primaryKey='id';
  protected $fillable=["answer","puan","iscorrect","questionid","created_at","updated_at"];

}
