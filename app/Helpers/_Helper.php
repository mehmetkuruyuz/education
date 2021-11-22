<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class _Helper
{


    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function  helpme()
    {
        return "Helper is Working";
    }

    public static function getMenuItemsForAction()
    {
      $controllers = [];
      $i=0;

      $routeCollection=(array) app('router')->getRoutes();
      $allRoute=$routeCollection["\x00*\x00nameList"];
      $menuarray=array();
      foreach ($allRoute as $key => $value)
      {
          $dt=array();
          $dt=explode(".",$key);
          if ($dt[0]=="menu")
          {
              if (!empty($dt[3]))
              {
                $menuarray[$dt[1]][$dt[2]][$dt[3]]=$value->uri;
              }else {
                $menuarray[$dt[1]][$dt[2]]=$value->uri;
              }

          }
      }
      return $menuarray;
    }

    public static function getNewMessage()
    {


    }


    public static function getAllNotification()
    {

    }




}

?>
