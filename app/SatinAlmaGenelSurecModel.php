<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SatinAlmaGenelSurecModel extends Model
{

  protected $table = 'satinalma_genel_surec';
  protected $primaryKey='id';
  protected $fillable=['companyId','type','onaysirasi','unit_id','active','passiveDate','created_at','updated_at'];


}
