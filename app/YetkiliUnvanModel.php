<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YetkiliUnvanModel extends Model
{
  protected $table = 'yetkiliunvan';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
