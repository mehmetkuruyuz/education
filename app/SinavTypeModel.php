<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinavTypeModel extends Model
{
  protected $table = 'sinavType';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
