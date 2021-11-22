<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EArsivModel extends Model
{

  protected $table = 'earsiv';
  protected $primaryKey='id';

  public function dosyalama()
  {
      return $this->hasMany('App\EArsivDosyaModel','arsivId', 'id');
  }

}
