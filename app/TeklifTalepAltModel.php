<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeklifTalepAltModel extends Model
{

  protected $table = 'talepTeklifAltParcalar';
  protected $primaryKey='id';
  protected $fillable=['teklifId','talepNo',
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
    'deleted',
    'created_at',
    'updated_at'];


      public function teklifurun()
      {
          return $this->hasMany('\App\TeklifTalepAltModel','systemproductid', 'systemproductid')->where("status","=","bekleme");
      }

      public function teklifdurum()
      {
        return $this->hasOne('\App\TeklifTalepModel', 'id','teklifId');
      }

      public function teklifsiparis()
      {
          return $this->hasMany('\App\TeklifTalepAltModel','satinAlmaKodu', 'satinAlmaKodu')->where("status","=","siparisedildi");
      }

      public function tekliftamamlandi()
      {
          return $this->hasMany('\App\TeklifTalepAltModel','satinAlmaKodu', 'satinAlmaKodu')->where("status","=","tedarikedildi");
      }

}
