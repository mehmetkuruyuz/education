<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalzemeTipiModel extends Model
{
  protected $table = 'malzemeTipi';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
