<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalzemeSinifiModel extends Model
{
  protected $table = 'malzemeSinifi';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
