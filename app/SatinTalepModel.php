<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SatinAlmaModel;

class SatinTalepModel extends Model
{

  protected $table = 'satinAlmaFormu';
  protected $primaryKey='id';


    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
    }

    public function durumkontrol()
    {
        return $this->hasMany('\App\SatinAlmaTalepDurumModel','talepId', 'id');
    }

    public function durumbeklemebul()
    {
        return $this->hasOne('\App\SatinAlmaTalepDurumModel','talepId', 'id')->where("status","=","beklemede")->orderBy("masrafSiraId","ASC");
    }

}
