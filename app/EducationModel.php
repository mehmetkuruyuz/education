<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EducationCategoriesModel;

use App\UserAnswerModel;
use App\ExamModel;
use App\QuestionModel;
use App\AnswerModel;

class EducationModel extends Model
{

  protected $table = 'education';
  protected $primaryKey='id';

  public function category()
  {
      return $this->belongsTo('App\EducationCategoriesModel','categoryId', 'id');
  }

  public function parent()
  {
      return $this->hasOne('App\EducationModel', 'id','egitimId')->where("tamamlanmaTarihi","<=",DB::raw("NOW()"));
  }
}
