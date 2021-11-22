<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserAnswerModel;
use App\ExamModel;
use App\QuestionModel;
use App\AnswerModel;

class QuestionModel extends Model
{

  protected $table = 'examQuestions';
  protected $primaryKey='id';

  public function questions()
  {
    return $this->hasMany('\App\AnswerModel','questionid', 'id');
  }

  public function answers()
  {
      return $this->hasMany('\App\AnswerModel','questionid', 'id');
  }


}
