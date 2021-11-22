<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YetkiliModel extends Model
{
  protected $table = 'yetkililer';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
