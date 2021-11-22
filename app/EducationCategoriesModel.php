<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EducationModel;


class EducationCategoriesModel extends Model
{

  protected $table = 'educationCategories';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }


  public function education()
  {
      return $this->hasMany('App\EducationModel','egitimId', 'id');
  }

}
