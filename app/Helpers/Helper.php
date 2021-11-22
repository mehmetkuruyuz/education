<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\UserSuccessEducationModel;
use App\UserAccessEducationModel;

use App\TitlesModel;
use App\GroupModel;


class Helper
{


    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function  helpme()
    {
        return "Helper is Working";
    }

    public static function getCompanyCode()
    {
      return  DB::table("companies")->first();
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
              if (!empty($dt[2]))
              {
                if (!empty($dt[3]))
                {
                  $menuarray[$dt[1]][$dt[2]][$dt[3]]=$value->uri;
                }else {
                  $menuarray[$dt[1]][$dt[2]]=$value->uri;
                }
              }else {
                $menuarray[$dt[1]]=$value->uri;
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

    public static function shotername($string)
    {
        return substr($string,0,8)." ...";
    }

    public static function findProductsType($id)
    {
      $data=DB::table("birimType")->find($id);
      if (!empty($data)) {return $data->birimAdi;}
      return "";
    }
    public static function findProductsName($id)
    {
      $data=DB::table("products")->find($id);
      if (!empty($data)) {return $data->malzemeAciklamasi;}
      return "";
    }

    public static function isSuccessEducationVideo($videoid,$userid="")
    {
      if ($userid=="")
      {
        $userid=\Auth::user()->id;
      }

      $array["success"]=false;
      $array["time"]="00:00:00";

      $accessLog=new UserSuccessEducationModel();

      $videostatus=$accessLog->where("userId","=",$userid)->where("educationId","=",$videoid)->first();
      if (empty($videostatus))
      {
        $array["success"]=false;
        $array["time"]="00:00:00";

      }else {
          if ($videostatus->isSuccess=="yes")
          {
            $array["success"]=true;
            $array["time"]=$videostatus->educationTime;
          }else {
            $array["success"]=false;
            $array["time"]=$videostatus->educationTime;
          }
    }
    return $array;
    }


    public static function findUserCategory($userid)
    {
         $userlog=new UserAccessEducationModel();
         $t=$userlog->with(["category"])->where("userId","=",$userid)->first();
         return $t;
         print_r($t);

    }

    public static function generateUniquieNumber($size=32)
    {
        $returnedkey="";
        $alphas = array_merge(range('A', 'Z'),range(1,9));
        for($i=0;$i<$size;$i++)
        {
          $returnedkey.=$alphas[rand(0,count($alphas)-1)];
        }
        return $returnedkey;
    }


    public static function findUserName($id)
    {
      $username=DB::table("users")->find($id);
      if (empty($username)) {return "";}
      return $username->name;
    }

    public static function findUserNameWithCode($id)
    {
      $username=DB::table("users")->find($id);
      if (empty($username)) {return "";}
      return $username->usercode." ".$username->name;
    }

    public static function findUserCode($id)
    {
      $username=DB::table("users")->find($id);
      if (empty($username)) {return "";}
      return $username->usercode;
    }

    public static function findMasrafYeriAdi($id)
    {
      $username=DB::table("departments")->select("title","code")->find($id);
      if (empty($username)) {return "Bağlanmamış";}
      return $username->code. " - ".$username->title;
    }

    public static function findMasrafYeriAdiWithUser($id)
    {
      $username=DB::table("departments")->select("title","code","masterUserId")->find($id);
      if (empty($username)) {return "Bağlanmamış";}
      return $username->code. " - ".$username->title." (".\Helper::findUserNameWithCode($username->masterUserId).")";
    }

    public static function findMasrafFromUserId($id)
    {
      $masrafyeri=DB::table("departments")->where("deleted","=","no")->where("masterUserId","=",$id)->first();
    //  print_r($masrafyeri);
      if (!empty($masrafyeri)) {


        return $masrafyeri->code." - ".$masrafyeri->title;
      }
      else {return "Bağlanmamış";}

      return "";
    }

    public static function ustMasrafYeriBul($id)
    {
      $masrafyeri=DB::table("departments")->where("deleted","=","no")->select("title","parentId","id")->find($id);
      if (!empty($masrafyeri->parentId))
      {
        $namer="";
        $masrafyeriparent=DB::table("departments")->where("id","=",$masrafyeri->parentId)->first();
        if (!empty($masrafyeriparent->masterUserId)) {    $namer=" (".Helper::findUserName($masrafyeriparent->masterUserId).") ";}


        return $masrafyeriparent->code." - ".$masrafyeriparent->title.$namer;
      }

      return "Bağlı Masrafyeri Yok";
    }


    public static function REVIZEustMasrafYeriBul($id,$userid=0)
    {
      $masrafyeri=DB::table("departments")->where("deleted","=","no")->select("title","parentId","id")->find($id);

      if (!empty($masrafyeri->id))
      {
        $namer="";
        $masrafyeriparent=DB::table("departments")->where("id","=",$masrafyeri->id)->first();

        if (!empty($masrafyeriparent->masterUserId))
        {

            if ($userid==$masrafyeriparent->masterUserId)
            {

                $masrafyeriparentXXX=DB::table("departments")->where("id","=",$masrafyeriparent->parentId)->first();
                if (!empty($masrafyeriparentXXX))
                {

                    $insallahbulacaz=DB::table("departments")->where("id","=",$masrafyeriparentXXX->id)->first();
                    $namer=" (".Helper::findUserName($insallahbulacaz->masterUserId).") ";
                    return $insallahbulacaz->code." - ".$insallahbulacaz->title.$namer;
                }else {
                  return "Bağlı Masrafyeri Yok";
                }
            }
            $namer="  (".Helper::findUserName($masrafyeriparent->masterUserId).") ";
            return $masrafyeriparent->code." - ".$masrafyeriparent->title.$namer;
        }


      }

      return "Bağlı Masrafyeri Yok";
    }

    public static function PowerMasrafYeriBul($id)
    {

    }

    public static function findUstMasrafFromUserId($id)
    {
      $masrafyeri=DB::table("departments")->where("deleted","=","no")->where("masterUserId","=",$id)->first();
      //print_r($masrafyeri);
      if (!empty($masrafyeri->parentId))
      {
        $namer="";
        $masrafyeriparent=DB::table("departments")->where("id","=",$masrafyeri->parentId)->first();
        if (!empty($masrafyeriparent->masterUserId)) {    $namer=" (".Helper::findUserName($masrafyeriparent->masterUserId).") ";}


        return $masrafyeriparent->code." - ".$masrafyeriparent->title.$namer;
      }

      return "Bağlı Masrafyeri Yok";
    }

    public static function findCompanyName($id)
    {
      $com=DB::table("companies")->find($id);
      return $com->companyCode." ".$com->title;

    }

    public static function findTitle($id)
    {
      $TitlesModel=new TitlesModel();
      $data=$TitlesModel->find($id);
      if (empty($data)) {return "";}
      return $data->title;
    }

    public static function findGroup($id)
    {
      $GroupModel=new GroupModel();
      $data=$GroupModel->find($id);
      if (empty($data)) {return "";}
      return $data->title;
    }




    public static function findUrunTipi($id)
    {
      $TitlesModel=new \App\MalzemeTipiModel();
      $data=$TitlesModel->find($id);
      if (empty($data)) {return "";}
      return $data->title;
    }
    public static function findUrunSinifi($id)
    {
      $TitlesModel=new \App\MalzemeSinifiModel();
      $data=$TitlesModel->find($id);
      if (empty($data)) {return "";}
      return $data->title;
    }
    public static function findUrunBirimi($id)
    {
      $TitlesModel=new \App\MalzemeBirimiModel();
      $data=$TitlesModel->find($id);
      if (empty($data)) {return "";}
      return $data->title;
    }
    public static function findStokTuru($id)
    {
      $TitlesModel=new \App\StokTuruModel();
      $data=$TitlesModel->find($id);
      if (empty($data)) {return "";}
      return $data->title;
    }
    public static function  SehirBul($id)
    {
        $sehir=DB::table("sehir")->where("sehir_key","=",$id)->first();
        if (empty($sehir)) {return "";}
        return  $sehir->sehir_title;
    }

    public static function IlceBul($id)
    {
      $sehir=DB::table("ilce")->where("ilce_id","=",$id)->first();
      if (empty($sehir)) {return "";}
      return  $sehir->ilce_title;
    }
    public static function findSektor($id)
    {
      $SektorModel=new \App\SektorModel();
      $t=$SektorModel->find($id);
      if (empty($t)) {return "";}
      return $t->title;
    }

    public static function findUnvan($id)
    {
      $SektorModel=new \App\YetkiliUnvanModel();
      $t=$SektorModel->find($id);
      if (empty($t)) {return "";}
      return $t->title;
    }

    public static function findUnvanWithCode($id)
    {
      $SektorModel=new \App\TitlesModel();
      $t=$SektorModel->find($id);
      if (empty($t)) {return "";}
      return $t->code." ".$t->title;
    }

    public static function masrafyerlerilistesi($id)
    {
      $insertModel=new \App\SatinAlmaModelUserAccess();
      $list=$insertModel->where("SatinAlmaId","=",$id)->orderBy("onaysirasi","ASC")->get();
      $arraydata=array();
      foreach ($list as $key => $value)
      {
        switch($value->type)
        {
          case "departman":
              $arraydata[$key]=\Helper::findMasrafYeriAdiWithUser($value->unit_id);
          break;
          case "birey":
            $arraydata[$key]=\Helper::findUserNameWithCode($value->unit_id);
          break;
          case "ustdepartman":
              $arraydata[$key]=\Helper::findMasrafYeriAdiWithUser($value->unit_id);
          break;
          case "unvan":
            $arraydata[$key]=\Helper::findUnvanWithCode($value->unit_id);
          break;
        }
      }
      return $arraydata;
    }

    public static function lookStatus($r)
    {
      $array['islemde']="İşlemde";
      $array['beklemede']="İşlem Bekliyor";
      $array['onaylandi']="Onaylandı";
      $array['iptal']="Red Edildi";
      $array['teklifolustu']="Satınalma Aşamasında";
      $array['tamamlandi']="Tedarik Edildi";
      return $array[$r];
    }

    public static function findColorForStatus($r)
    {
      $array['islemde']="";
      $array['beklemede']="bg-warning";
      $array['onaylandi']="bg-success";
      $array['iptal']="bg-danger";
        return $array[$r];
    }

    public static function satinAlmaDurumuKontrol($id)
    {
        $SatinAlmaTalepDurumModel=new \App\SatinAlmaTalepDurumModel();
        $listofaction=$SatinAlmaTalepDurumModel->where("talepId","=",$id)->orderBy("masrafSiraId","ASC")->get();
        $arrayOfStation=array();
        foreach ($listofaction as $key => $value)
        {
          $arrayOfStation[$key]["status"]   = $value->status;
          $arrayOfStation[$key]["aciklama"] = $value->aciklama;
          $arrayOfStation[$key]["tarih"] ="";
          $arrayOfStation[$key]["bg-color"] ="";
          switch ($value->status) {
            case 'beklemede':
              $arrayOfStation[$key]["bg-color"] ="bg-warning";
            break;
            case 'onaylandi':
              $arrayOfStation[$key]["bg-color"] ="bg-success";
            break;
            case 'iptal':
              $arrayOfStation[$key]["bg-color"] ="bg-danger";          // code...
            break;

          }
          if ($value->status=="onaylandi" || $value->status=="iptal") {$arrayOfStation[$key]["tarih"] = $value->updated_at;}
        }
        return $arrayOfStation;
    }


    public static function satinAlmaEvrakListesi($id)
    {
      $fileforEvrakModel=new \App\SatinAlmaTalepDocumentModel();
      $list=$fileforEvrakModel->where("talepId","=",$id)->get();
      return $list;
    }


    public static function findMyInformationForTalep()
    {
        $userInfo=\Auth::user();
        $array["id"]=$userInfo->id;
        $array["gorevtanimi"]=$userInfo->gorevtanimi;
        $SatinAlmaModel=new \App\SatinAlmaModel();
        $SatinAlmaList=$SatinAlmaModel->where("masterUserId","=",$userInfo->id)->get();
      //  print_r($SatinAlmaList);
        $array["sorumlumasrafyeri"]=array();
        if (!empty($SatinAlmaList))
        {
          $arx=array();
          foreach ($SatinAlmaList as $key => $value)
          {
              $arx[]=$value->id;
          }
          $array["sorumlumasrafyeri"]=$arx;
        }
        return $array;
    }


    public static function countForWelcomeBekleyenTalepler()
    {
      $SatinAlmaModel=new \App\SatinAlmaModel();

      $masrafyeri = \Auth::user()->id;
      $data=$SatinAlmaModel->where("masterUserId","=",$masrafyeri)->get();

      $masrafyeriYoneticisi=0;

      if (!empty($data))  {
        $masrafyeriYoneticisi=array();
        foreach ($data as $key => $value)
        {
            $masrafyeriYoneticisi[]=$value->id;
        }
      }
      $userId = \Auth::user()->id;
      $unvanId =  \Auth::user()->gorevtanimi;
      $SatinAlmaTalepDurumModel=new \App\SatinAlmaTalepDurumModel();
      $actionData = $SatinAlmaTalepDurumModel->where(function($query) {
                                          $query->where('masrafYeriTipi', '=', "departman");
                                          $query->orWhere('masrafYeriTipi', '=', "ustdepartman");
                                        })->whereIn("masrafYeriId",$masrafyeriYoneticisi)->where('status', '=', "beklemede")->orderBy("masrafSiraId","ASC")->get();


      $actionDataUser = $SatinAlmaTalepDurumModel->where(function($query) {
                                          $query->where('masrafYeriTipi', '=', "birey");
                                        })->where("masrafYeriId","=",$userId)->where('status', '=', "beklemede")->orderBy("masrafSiraId","ASC")->get();

      $actionDataUnvan = $SatinAlmaTalepDurumModel->where(function($query) {
                                          $query->where('masrafYeriTipi', '=', "unvan");
                                        })->where("masrafYeriId","=",$unvanId)->where('status', '=', "beklemede")->orderBy("masrafSiraId","ASC")->get();


      $merged = $actionData->merge($actionDataUser)->merge($actionDataUnvan);

      $arrayInTalep=array();
      foreach($merged as $key=>$value)
      {
        $checkPlease=$SatinAlmaTalepDurumModel->where("talepId","=",$value->talepId)->where("masrafSiraId","<",$value->masrafSiraId)->where('status', '=', "beklemede")->first();
        if (empty($checkPlease))
        {
          $arrayInTalep[]=$value->talepId;
        }
      }

      $SatinTalepModel=new \App\SatinTalepModel();

      $tumTalepler=$SatinTalepModel->with(["durumkontrol"])->whereIn("id",$arrayInTalep)->where("status","islemde")->count();
      return $tumTalepler;
    }


    public static function EgitimAtanmaControl($check="no")
    {
      $UserAccessEducationModel=new \App\UserAccessEducationModel();

      $db=DB::select("SELECT * FROM `educationToUser` as eu,educationLog as el,education as e WHERE e.id=eu.egitimId and e.tamamlanmaTarihi > NOW() and eu.`egitimId`=el.educationId and eu.userId=el.userId and el.userId='".\Auth::user()->id."' ");

      $arrayEducationIn=array();

     foreach ($db as $key => $value)
     {
       if ($value->isSuccess==$check)
       {
         $arrayEducationIn[]=$value->educationId;
       }
     }

      $list=$UserAccessEducationModel->with(["education"])->where("userId","=",\Auth::user()->id)->whereIn("egitimId",$arrayEducationIn)->count();
      echo $list;
    }

    public static function egitimDurumBilgisiGetir($egitimId,$userId)
    {
       $UserAccessEducationModel=new \App\UserSuccessEducationModel();
       $data=$UserAccessEducationModel->with(["education"])->where("userId","=",$userId)->where("educationId","=",$egitimId)->first();
       return $data;


    }


    public static function FindMyLastSeconds($videoid,$t=false)
    {
        $userid = \Auth::user()->id;
        $UserSuccessEducationModel=new \App\UserSuccessEducationModel();
        $data=$UserSuccessEducationModel->where("userId","=",$userid)->where("educationId","=",$videoid)->first();

        if (empty($data)) {return 0;}

        if ($t==false)
        {
          $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $data->educationTime);
          sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
          $hiperx = $hours * 3600 + $minutes * 60 + $seconds;

          return $hiperx;
        }else {
          return $data->educationTime;
      }
    }


    public static function AnketAtanmaKontrol()
    {
        $userid = \Auth::user()->id;
        $PollAssingUser=new \App\PollAssingUser();
        $say=$PollAssingUser->where("userid","=",$userid)->where("tamamlandi","=","no")->count();
        return $say;
    }

    public static function findPollAnswer($questionid,$userid)
    {
        $PollUserAnswerData=new \App\PollUserAnswerData();
        $ac=$PollUserAnswerData->where("questionid","=",$questionid)->where("userid","=",$userid)->first();
        if (!empty($ac))
        {
          return $ac->answerid;
        }else {
          return "bos";
        }

    }

        public static function findPollAnswerCount($questionid,$answerid)
        {
            $PollUserAnswerData=new \App\PollUserAnswerData();
            $ac=$PollUserAnswerData->where("questionid","=",$questionid)->where("answerid","=",$answerid)->count();
            return $ac;
            if (!empty($ac))
            {
              return $ac->answerid;
            }else {
              return "bos";
            }

        }
        public static function findSinavAnswerCount($questionid,$answerid)
        {
            $PollUserAnswerData=new \App\SinavUserAnswerData();
            $ac=$PollUserAnswerData->where("questionid","=",$questionid)->where("answerid","=",$answerid)->count();
            return $ac;
            if (!empty($ac))
            {
              return $ac->answerid;
            }else {
              return "bos";
            }

        }
        public static function findSinavAnswerByUser($questionid,$answerid)
        {


            $PollUserAnswerData=new \App\SinavUserAnswerData();
            $ac=$PollUserAnswerData->with(["user"])->where("questionid","=",$questionid)->where("answerid","=",$answerid)->get();
            return $ac;
            if (!empty($ac))
            {
              return $ac->answerid;
            }else {
              return "bos";
            }

        }

        public static function findSinavAnswer($questionid,$userid)
        {
            $PollUserAnswerData=new \App\SinavUserAnswerData();
            $ac=$PollUserAnswerData->where("questionid","=",$questionid)->where("userid","=",$userid)->first();
            if (!empty($ac))
            {
              return $ac->answerid;
            }else {
              return "bos";
            }

        }


        public static function findSinavAnswerByMasrafyeri($questionid,$answerid)
        {
            $PollUserAnswerData=new \App\SinavUserAnswerData();
            $ac=$PollUserAnswerData->with(["user"])->where("questionid","=",$questionid)->where("answerid","=",$answerid)->get();

            $array=array();
            if(empty($ac)) {return "";}
            foreach ($ac as $m => $d)
            {
              if (empty($array[$d->user->masrafYeri])) {$array[$d->user->masrafYeri]=0;}
              $array[$d->user->masrafYeri]+=1;
            }

            return $array;


        }


      public static function loginWithUserCode()
      {
        //  $req=new \Request;
          $usercode=request("hash_token");
          if (!empty($usercode))
          {

            $User=new \App\User();
            $returned=$User->where("usercode","=",$usercode)->first();
        //    return $returned;
            if (!empty($returned)) { \Auth::loginUsingId($returned->id); }
          }
          return false;
      }


      public static function getFirmList()
      {
        $externaldata=file_get_contents(env("API_MAIN_URL")."/QPMAnaFirma");
        $externaldata=json_decode($externaldata);

        return $externaldata;

      }

      public static function getAllUserExternalAction()
      {
        $xml_string=file_get_contents(env("API_MAIN_URL")."/QPMKullanici");
        $array = json_decode($xml_string,TRUE);
        foreach ($array as $key => $value)
        {

              $userModel=new \App\User();
              $dtx=$userModel->where("usercode","=",$value["kullaniciKodu"])->first();
              if (empty($dtx))
              {
                  $userModel->name=$value["ad"]." ".$value["soyAd"];
                  $userModel->usercode=$value["kullaniciKodu"];
                  $userModel->email=$value["mail"];
                  $userModel->password=$value["kullaniciKodu"];
                  $userModel->remember_token=$value["kullaniciKodu"];
                  $userModel->role="user";
                  $userModel->brans=$value["gorevAd"];
                  $userModel->unvan=$value["gorevKod"];
                  $userModel->telefon="";
                  $userModel->groupId=$value["kullaniciKodu"];
                  $userModel->companyId=$value["firmaKodu"];
                  $userModel->masrafYeri=$value["masrafMerkezi"];
                  $userModel->groupYetki=$value["kullaniciKodu"];
                  $userModel->groupname=$value["bolumKod"];
                  $userModel->gorevtanimi=$value["bolumAd"];
                  $userModel->trycount=0;
                  $userModel->deleted="no";
                  $userModel->satinalmasorumlusu="no";
                  $userModel->save();

                  $userid=$userModel->id;
                  $SatinAlmaModel=new \App\SatinAlmaModel();



                  $finder=$SatinAlmaModel->where("code","=",$value["bolumKod"])->first();
                  if (empty($finder)){
                    $masteruserfind=$userModel->where("unvan","=",$value["yoneticiGorevKod"])->first();
                    if (empty($masteruserfind)){
                      $masterUserId=0;
                    }else {
                      $masterUserId=$masteruserfind->id;
                    }

                    $mastersatinfind=$SatinAlmaModel->where("code","=",$value["bagliMasrafYeri"])->first();
                    if (empty($mastersatinfind)){
                      $baglimasrafyeri=0;
                    }else {
                      $baglimasrafyeri=$mastersatinfind->id;
                    }

                    $SatinAlmaModel->parentId=$baglimasrafyeri;
                    $SatinAlmaModel->powerUp="yes";
                    $SatinAlmaModel->code=$value["bolumKod"];
                    $SatinAlmaModel->companyId=1;
                    $SatinAlmaModel->title=$value["bolumAd"];
                    $SatinAlmaModel->description=$value["bolumAd"];
                    $SatinAlmaModel->masterUserId=$userid;
                    $SatinAlmaModel->deleted="no";
                    $SatinAlmaModel->created_at=date("Y-m-d H:i:s");
                    $SatinAlmaModel->updated_at=date("Y-m-d H:i:s");
                    $SatinAlmaModel->save();
                  }



              }
        }
        return $array;
      }

      public static function recovermainstream()
      {
        $xml_string=file_get_contents(env("API_MAIN_URL")."/QPMKullanici");
        $array = json_decode($xml_string,TRUE);
        foreach ($array as $key => $value)
        {
            $userModel=new \App\User();
            $SatinAlmaModel=new \App\SatinAlmaModel();
            $cali=$SatinAlmaModel->where("code","=",$value["bolumKod"])->first();
            $userModel->where("usercode","=",$value["kullaniciKodu"])->update(["masrafYeri"=>$cali->id]);
        }


      }




}


?>
