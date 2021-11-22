<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
  protected $table = 'groups';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
