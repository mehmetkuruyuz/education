<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatinAlmaTalepDurumModel extends Model
{

    protected $table = 'satinAlmaTalepOnayDurumu';
    protected $primaryKey='id';
    protected $fillable=["talepId","masrafYeriId","masrafSiraId","masrafYeriTipi","parcaId","status","aciklama","created_at","updated_at"];

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
    }



}
