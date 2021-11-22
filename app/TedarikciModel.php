<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TedarikciModel extends Model
{
  protected $table = 'tedarikci';
  protected $primaryKey='id';


  


  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

}
