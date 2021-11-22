<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductsModel;

class ProductsCategoryModel extends Model
{
  protected $table = 'urungrup';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }

  public function alt()
  {
      return $this->hasMany('App\ProductsModel','urungrup', 'id');
  }

}
