<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatinAlmaTalepDocumentModel extends Model
{

    protected $table = 'satinAlmaTalepDocuments';
    protected $primaryKey='id';
    protected $fillable=["talepId","userId","name","mediaurl","deleted","created_at","updated_at"];

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
    }



}
