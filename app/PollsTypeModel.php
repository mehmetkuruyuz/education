<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollsTypeModel extends Model
{
  protected $table = 'pollType';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
