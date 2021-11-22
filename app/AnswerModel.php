<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{

  protected $table = 'examAnswer';
  protected $primaryKey='id';
  protected $fillable=["answer","puan","iscorrect","questionid","created_at","updated_at"];

}
