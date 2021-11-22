<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EArsivDosyaModel extends Model
{

  protected $table = 'EArsivDocuments';
  protected $primaryKey='id';
  protected $fillable=["arsivId","userId","name","mediaurl","deleted","created_at","updated_at"];

  public function newQuery($excludeDeleted = true)
  {
      return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
  }


}
