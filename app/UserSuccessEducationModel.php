<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSuccessEducationModel extends Model
{

  protected $table = 'educationLog';
  protected $primaryKey='id';
  protected $fillable=["userId","educationId","educationTime","isSuccess","created_at","updated_at"];


  public function education()
  {
    return $this->hasOne('App\EducationModel', 'id','educationId');
  }

  public function user()
  {
      return $this->hasOne('App\User', 'id','userId');
  }

}
