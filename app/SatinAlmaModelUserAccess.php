<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SatinAlmaModelUserAccess extends Model
{

  protected $table = 'purchasing_units_user';
  protected $primaryKey='id';
  protected $fillable=['companyId','SatinAlmaId','type','onaysirasi','unit_id','active','passiveDate','created_at','updated_at'];

  public function anamasraf()
  {
      return $this->hasOne('App\SatinAlmaModel', 'id','SatinAlmaId');
  }
  public function upmasraf()
  {
      return $this->hasOne('App\SatinAlmaModel', 'id','unit_id');
  }
}
