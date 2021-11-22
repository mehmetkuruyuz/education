<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SinavAssingUser extends Model
{
      protected $table = 'SinavAssingUser';
      protected $primaryKey='id';
      protected $fillable=["pollId","usertype","userid","username","email","FirmaAdi","Gorevi","Bolumu","aciklama","deleted","tamamlandi","tamamlandiZaman"];

      public function newQuery($excludeDeleted = true)
      {
          return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
      }


      public function user()
      {
          return $this->hasOne('\App\User', 'id','userid');
      }

      public function poll()
      {
          return $this->hasOne('\App\SinavModel', 'id','pollId');
      }

      public function polldone()
      {
          return $this->hasOne('\App\SinavModel', 'id','pollId')->where("enddate","<",DB::raw("NOW()"));
      }

}
