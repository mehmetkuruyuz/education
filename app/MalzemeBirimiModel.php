<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MalzemeBirimiModel extends Model
{
  protected $table = 'malzemeBirimi';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
