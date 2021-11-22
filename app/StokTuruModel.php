<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokTuruModel extends Model
{
  protected $table = 'stokTuru';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
