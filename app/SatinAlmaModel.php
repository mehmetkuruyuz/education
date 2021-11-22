<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatinAlmaModel extends Model
{

  protected $table = 'departments';
  protected $primaryKey='id';


    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where("deleted", '=', "no");
    }

  public function ust()
  {
      return $this->hasOne('App\SatinAlmaModel', 'code','mastercode');
  }
  public function alt()
  {
      return $this->hasMany('App\SatinAlmaModel','mastercode', 'code');
  }
  public function altdata()
  {
      return $this->hasOne('App\SatinAlmaModel','id','parentId');
  }

  public function altmanydata()
  {
      return $this->hasMany('App\SatinAlmaModel','parentId','id');
  }

  public function sorumlu()
  {
          return $this->hasOne('App\User','id', 'masrafyerisorumlusu');
  }


  public function ustsorumlu()
  {
          return $this->hasOne('App\User','id', 'masrafustsorumlusu');
  }
  public function onaylayici()
  {
          return $this->hasOne('App\User','id', 'masrafonaylayicisi');
  }


  public function parent()
  {
      return $this->belongsTo('App\SatinAlmaModel', 'parentId');
  }

  public function children()
  {
      return $this->hasMany('App\SatinAlmaModel', 'parentId');
  }

  public function childrenRecursive()
  {
     return $this->children()->with('childrenRecursive');
  }

  public function parentRecursive()
  {
      return $this->parent()->with('parentRecursive');
  }

}
