<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepoTipiModel extends Model
{
  protected $table = 'depoTipi';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
