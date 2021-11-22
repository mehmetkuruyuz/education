<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeklifTalepModel extends Model
{

  protected $table = 'talepTeklifListeleri';
  protected $primaryKey='id';


    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
    }

    public function altelemaninbekleme()
    {
        return $this->hasMany('\App\TeklifTalepAltModel','teklifId', 'id')->where('status','=',"bekleme");
    }
    public function altelemanintedarik()
    {
        return $this->hasMany('\App\TeklifTalepAltModel','teklifId', 'id')->where('status','=',"tedarikedildi");
    }

}
