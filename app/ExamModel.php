<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{

  protected $table = 'exam';
  protected $primaryKey='id';

  public function category()
  {
      return $this->belongsTo('\App\EducationCategoriesModel','educationCategory', 'id');
  }
  public function exam()
  {
      return $this->belongsTo('\App\EducationModel','educationCategory', 'id');
  }
    public function questions()
    {
      return $this->hasMany('\App\QuestionModel','examId', 'id');
    }
}
