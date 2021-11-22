<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SektorModel extends Model
{
  protected $table = 'sektor';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
