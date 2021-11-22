<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OnlineSinavModel;


class OnlineSinavKategoriModel extends Model
{

  protected $table = 'educationCategories';
  protected $primaryKey='id';

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }



}
