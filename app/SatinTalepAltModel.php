<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SatinAlmaModel;

class SatinTalepAltModel extends Model
{

  protected $table = 'satinAlmaAltParcalar';
  protected $primaryKey='id';
  protected $fillable=['talepId','talepNo',
    'stokkodu',
    'systemproductid',
    'urunadi',
    'stokturu',
    'stoksinifi',
    'stokbirimi',
    'stokadet',
    'stokaciklamasi',
    'onerilentedarikci',
    'birimfiyati',
  'deleted','created_at','updated_at'];




}
