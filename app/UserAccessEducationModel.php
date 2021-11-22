<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserAccessEducationModel extends Model
{

  protected $table = 'educationToUser';
  protected $primaryKey='id';
  protected $fillable=["userId","egitimId","permissionType","created_at","updated_at"];

  public function category()
  {
      return $this->hasOne('App\EducationCategoriesModel', 'id','categoryId');
  }

  public function education()
  {
    return $this->hasOne('App\EducationModel', 'id','egitimId');
  }

  public function educationBiten()
  {
    return $this->hasOne('App\EducationModel', 'id','egitimId')->where("tamamlanmaTarihi","<=",DB::raw("NOW()"));
  }

  public function educationDevam()
  {
    return $this->hasOne('App\EducationModel', 'id','egitimId')->where("tamamlanmaTarihi",">",DB::raw("NOW()"));
  }


  public function user()
  {
      return $this->hasOne('App\User', 'id','userId');
  }
}
