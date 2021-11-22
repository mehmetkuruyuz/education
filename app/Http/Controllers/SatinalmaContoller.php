<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\SatinAlmaModel;
use App\SatinAlmaModelUserAccess;
use App\SatinTalepModel;
use App\SatinTalepAltModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\ProductsCategoryModel;

use Auth;

class SatinalmaContoller extends Controller
{
  public function __construct()
{     \Helper::loginWithUserCode();
    \Helper::loginWithUserCode();
  //   $this->middleware("auth");  // this will solve your problem
  }

  public function index(Request $req)
{     \Helper::loginWithUserCode();

    \Helper::loginWithUserCode();

    $userid=\Auth::user()->id;

    $userInTitle=DB::table("userTitles")->where("userId","=",$userid)->get();

    $arrayinsatinalmatitle=array();
    foreach($userInTitle as $key=>$value)
  {     \Helper::loginWithUserCode();
      $arrayinsatinalmatitle[]=$value->titleId;
    }

    $userAccessModel=new SatinAlmaModelUserAccess();


    $yapi=$userAccessModel->with(["anamasraf"])->whereIn("unit_id",$arrayinsatinalmatitle)->get();

    $urunAnaYapi=new ProductsCategoryModel();
    $urunler=$urunAnaYapi->get();

    $satinAlmaFormu=new SatinTalepModel();

    $role=\Auth::user()->role;
    if ($role!="admin")
  {     \Helper::loginWithUserCode();
      $satinAlmaFormu=$satinAlmaFormu->where("createdUser","=",$userid);
    }

    $talepno="";
    if (!empty($req->input("talepno"))) {$satinAlmaFormu=$satinAlmaFormu->where("talepNo","=",$req->input("talepno")); $talepno=$req->input("talepno");}
    $list = $satinAlmaFormu->with(["durumbeklemebul"])->orderBy("created_at","DESC")->paginate(20);

    return view("satinalma.satinalma",['satinalma'=>$yapi,'urunler'=>$urunler,'list'=>$list,"talepno"=>$talepno]);
  }
  public function SatinAlmaList()
{     \Helper::loginWithUserCode();
    \Helper::loginWithUserCode();
  }

  public function masrafyeri()
{     \Helper::loginWithUserCode();    \Helper::loginWithUserCode();
    $tumSatinAlmaModel=new SatinAlmaModel();
    $all=$tumSatinAlmaModel->with(['altdata'])->orderBy("created_at","DESC")->paginate(40);

    $userModel=new \App\User();
    $userList=$userModel->select("id","name","usercode")->get();
    $companylist = DB::table("companies")->get();
    //return $all;
    return view("satinalma.masrafyeri",["companyList"=>$companylist,'userList'=>$userList,"list"=>$all]);
  }

  public function masrafyerisave(Request $req)
{     \Helper::loginWithUserCode();
    \Helper::loginWithUserCode();
        $SatinAlmaModel=new SatinAlmaModel;
        $SatinAlmaModel->companyId=$req->input("firmCode");
        $SatinAlmaModel->parentId=$req->input("parentId");
        $SatinAlmaModel->code=$req->input("code");
        $SatinAlmaModel->title=$req->input("title");
        $SatinAlmaModel->description=$req->input("description");
        $SatinAlmaModel->deleted="no";
        $SatinAlmaModel->masterUserId=$req->input("masterUserId");
        $SatinAlmaModel->save();
        $parentid=$SatinAlmaModel->id;
        $arrayx=array();
        $now=\Carbon\Carbon::parse("now")->format("Y-m-d H:i:s");

        $onay=$req->input("onaytype");
        $masrafyeri=$req->input("masrafyeri");

        if (!empty($masrafyeri))
      {     \Helper::loginWithUserCode();
            foreach ($masrafyeri as $key => $value)
          {     \Helper::loginWithUserCode();
              $arrayx[$key]["companyId"]=$req->input("firmCode");
              $arrayx[$key]["SatinAlmaId"]=$parentid;
              $arrayx[$key]["onaysirasi"]=$key;
              $arrayx[$key]["type"]=$onay[$key];
              $arrayx[$key]["unit_id"]=$masrafyeri[$key];
              $arrayx[$key]["active"]="yes";
              $arrayx[$key]["passiveDate"]="2030-01-01";
              $arrayx[$key]["created_at"]=$now;
              $arrayx[$key]["updated_at"]=$now;
            }
        }
        $insertModel=new SatinAlmaModelUserAccess();
        $insertModel->insert($arrayx);
        $message="Satın Alma masraf yeri kaydedildi.";
        return redirect()->back();
        return view("messages",['message'=>$message]);

  }

  public function masrafyeriupdate(Request $req)
{     \Helper::loginWithUserCode();
        \Helper::loginWithUserCode();
        $SatinAlmaModel=new SatinAlmaModel;
        $model=array();
        $model["companyId"]=$req->input("firmCode");
        $model["parentId"]=$req->input("parentId");
        $model["code"]=$req->input("code");
        $model["title"]=$req->input("title");
        $model["description"]=$req->input("description");
        $model["masterUserId"]=$req->input("masterUserId");

        $SatinAlmaModel->where("id","=",$req->input("id"))->update($model);
        return redirect()->back();
        return $req;
  }




    public function masrafYeriSil($id)
  {     \Helper::loginWithUserCode();
          \Helper::loginWithUserCode();
      $SatinAlmaModel=new SatinAlmaModel;
      $SatinAlmaModel->where('id',"=",$id)->update(["deleted"=>"yes"]);
      $message="Satın Alma masraf yeri Silindi.";
      return redirect()->back();
      return view("messages",['message'=>$message]);
      return $id;
    }

    public function masrafYeriEdit($id)
  {     \Helper::loginWithUserCode();

      $SatinAlmaModel=new SatinAlmaModel;
      $data=$SatinAlmaModel->find($id);
  //    return $data;
      $userModel=new \App\User();
      $userList=$userModel->select("id","name","usercode")->get();
      $companylist = DB::table("companies")->get();
      return view("satinalma.masrafyerieditle",["companyList"=>$companylist,"data"=>$data,'userList'=>$userList]);
      return $id;
    }


  public function loadInformation(Request $req)
{     \Helper::loginWithUserCode();
        \Helper::loginWithUserCode();
    $firm=$req->input("firmcode");
    $code=$req->input("code");
    if (empty($code)) {$code=0;} // Bu saçma ama yapacak birşey yok

      $finder = $this->loadTreeData($code);

      foreach($finder as $key=>$value)
    {     \Helper::loginWithUserCode();
         $finder[$key]->subdata=$this->loadTreeData($value->id);
      }
    //  return $finder;
    return view("satinalma.masraftanimlari",["modallist"=>$finder]);
    return $listOfModel;

  }

  public function forselectalldepartments(Request $req)
{     \Helper::loginWithUserCode();
        \Helper::loginWithUserCode();
      $SatinAlmaModel=new SatinAlmaModel();
      $finder=$SatinAlmaModel->get();
      return view("satinalma.masraftanimlari",["modallist"=>$finder]);
  }

  public function nestedAllItems(Request $req)
{     \Helper::loginWithUserCode();
        \Helper::loginWithUserCode();
    $categories = SatinAlmaModel::with('childrenRecursive')->where('parentId',"=",0)->get();
    $project=$categories;
    return view('firstmulti',["projects"=>$project]);
  }
    public function loadTreeData($id)
  {     \Helper::loginWithUserCode();
          \Helper::loginWithUserCode();
      $SatinAlmaModel=new SatinAlmaModel();
      $listOfModel = $SatinAlmaModel->where("parentId","=",$id)->get();
      return $listOfModel;
    }

  public function getUserList(Request $req)
{     \Helper::loginWithUserCode();
    \Helper::loginWithUserCode();
      $userModel=new \App\User();
      $finder=$userModel->get();
      return view("satinalma.userlist",["modallist"=>$finder]);
      return $req;
  }

  public function getunvanlist()
{     \Helper::loginWithUserCode();
    $TitlesModel=new \App\TitlesModel();
    $finder=$TitlesModel->get();
      return view("satinalma.unvanlist",["modallist"=>$finder]);
  }

  public function onaylayiciEkle(Request $req)
{     \Helper::loginWithUserCode();
        \Helper::loginWithUserCode();
      $sira=$req->input("sira");
      return view("satinalma.onaylayicimekanizmasi",['sira'=>$sira]);
  }


  public function yeniUrun()
{     \Helper::loginWithUserCode();

    $urunAnaYapi=new \App\ProductsModel();
    $urunler=$urunAnaYapi->get();


    $externaldata=file_get_contents(env("API_MAIN_URL")."/QPMFirmalar");

    $externaldata=json_decode($externaldata);
//    $TedarikciModel=new \App\TedarikciModel();
//    $firmalist=$TedarikciModel->where("firmaturu","!=","Müşteri")->get();

    return view("satinalma.newurun",['urunler'=>$urunler,'firmalist'=>$externaldata]);
  }

  public function saveSatinAlmaForm(Request $req)
{     \Helper::loginWithUserCode();
//    return $req;
    $satinAlmaFormu=new SatinTalepModel();
    $satinAlmaFormu->createdUser=$req->input("userId");
    $userM=new \App\User();
    $user=$userM->find($req->input("userId"));
    $satinAlmaFormu->masrafYeri=$user->masrafYeri;
    $satinAlmaFormu->talepNo=$req->input("talepno");
    $satinAlmaFormu->genelaciklama=$req->input("genelaciklama");
    $satinAlmaFormu->status="islemde";
    $satinAlmaFormu->deleted="no";
    $satinAlmaFormu->save();
    $satinalmaid = $satinAlmaFormu->id;




    $stokkodu=$req->input("stokkodu");
    $urunadi=$req->input("urunadi");
    $stokturu=$req->input("stokturu");
    $stoksinifi=$req->input("stoksinifi");
    $stokbirimi=$req->input("stokbirimi");
    $stokadet=$req->input("stokadet");
    $stokaciklamasi=$req->input("stokaciklamasi");
    $onerilentedarikci=$req->input("onerilentedarikci");
    $birimfiyati=$req->input("birimfiyati");


    $arrayx=array();
    $now=\Carbon\Carbon::parse("now")->format("Y-m-d H:i:s");



    foreach($stokkodu as $key=>$value)
  {     \Helper::loginWithUserCode();
        $arrayx[$key]['talepId']=$satinalmaid;
        $arrayx[$key]['talepNo']=$req->input("talepno");


        $arrayx[$key]['stokkodu']=$stokkodu[$key];
        $arrayx[$key]['systemproductid']=$urunadi[$key];
        $arrayx[$key]['urunadi']=\Helper::findProductsName($urunadi[$key]);
        $arrayx[$key]['stokturu']=$stokturu[$key];
        $arrayx[$key]['stoksinifi']=$stoksinifi[$key];
        $arrayx[$key]['stokbirimi']=$stokbirimi[$key];
        $arrayx[$key]['stokadet']=$stokadet[$key];
        $arrayx[$key]['stokaciklamasi']=$stokaciklamasi[$key];
        $arrayx[$key]['onerilentedarikci']=$onerilentedarikci[$key];
        $arrayx[$key]['birimfiyati']=$birimfiyati[$key];



        $arrayx[$key]['deleted']="no";
        $arrayx[$key]['created_at']=$now;
        $arrayx[$key]['updated_at']=$now;
    }

    $SatinTalepAltModel=new SatinTalepAltModel();
    $SatinTalepAltModel->insert($arrayx);
    $message="Satın Alma Talep Oluşturudu";

    $insertModel=new \App\SatinAlmaModelUserAccess();
    $list=$insertModel->where("SatinAlmaId","=",$user->masrafYeri)->orderBy("onaysirasi","ASC")->get();

    $insertToControlModel=array();
    foreach ($list as $key => $value)
    {
      \Helper::loginWithUserCode();
      $insertToControlModel[$key]["talepId"]=$satinalmaid;
      $insertToControlModel[$key]["masrafYeriId"]=$value->unit_id;
      $insertToControlModel[$key]["masrafYeriTipi"]=$value->type;
      $insertToControlModel[$key]["masrafSiraId"]=$value->onaysirasi;
      $insertToControlModel[$key]["status"]="beklemede";
      $insertToControlModel[$key]["aciklama"]="";
      $insertToControlModel[$key]["created_at"]=$now;
      $insertToControlModel[$key]["updated_at"]=$now;
    }

    $SatinAlmaTalepDurumModel=new \App\SatinAlmaTalepDurumModel();
    $SatinAlmaTalepDurumModel->insert($insertToControlModel);


    if(!empty($req->file('file')))
  {     \Helper::loginWithUserCode();
        $fileforEvrakModel=new \App\SatinAlmaTalepDocumentModel();
        $files= $req->file('file');
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();

        $fileForEvr=array();

        foreach ($files as $key=>$value)
      {     \Helper::loginWithUserCode();
            $fileForEvr[$key]["talepId"]=$satinalmaid;
            $fileForEvr[$key]["userId"]=$req->input("userId");
            $fileForEvr[$key]["name"]=$value->getClientOriginalName();
            $fileForEvr[$key]["mediaurl"]=Storage::disk('public')->put('/', $value);
            $fileForEvr[$key]["deleted"]="no";
            $fileForEvr[$key]["created_at"]=$now;
            $fileForEvr[$key]["updated_at"]=$now;
        }

        $fileforEvrakModel->insert($fileForEvr);

    }

    return redirect()->back();
    return view("messages",['message'=>$message]);
    return $req;
  }


  public function talepEdit($id)
{     \Helper::loginWithUserCode();
    $satinAlmaFormu=new SatinTalepModel();
    $data=$satinAlmaFormu->with(["durumkontrol"])->find($id);

    $myuserid=\Auth::user()->id;
    $checkdugme["id"]="";
    $checkdugme["status"]="";
    $checkdugme["type"]="";
    $checkdugme["action_id"]=0;
    foreach ($data->durumkontrol	as $key => $value)
  {     \Helper::loginWithUserCode();
      if ($value->status=="iptal")
    {     \Helper::loginWithUserCode();
        $checkdugme["id"]=$value->masrafYeriId;
        $checkdugme["status"]=$value->status;
        $checkdugme["type"]=$value->masrafYeriTipi;
        $checkdugme["action_id"]=$value->id;
        break;
      }
      if ($value->status=="beklemede")
    {     \Helper::loginWithUserCode();
        $checkdugme["id"]=$value->masrafYeriId;
        $checkdugme["status"]=$value->status;
        $checkdugme["type"]=$value->masrafYeriTipi;
        $checkdugme["action_id"]=$value->id;
        break;
      }
    }

    $SatinTalepAltModel=new SatinTalepAltModel();
    $list =  $SatinTalepAltModel->where("talepId","=",$id)->get();
    $TedarikciModel=new \App\TedarikciModel();
    $allcompany=$TedarikciModel->get();

    return view("satinalma.findtalepalttalep",['list'=>$list,"allcompany"=>$allcompany,"data"=>$data,"checkdugme"=>$checkdugme]);
  }



  public function talepGoster($id)
{     \Helper::loginWithUserCode();
    $satinAlmaFormu=new SatinTalepModel();
    $data=$satinAlmaFormu->with(["durumkontrol"])->find($id);

    $myuserid=\Auth::user()->id;
    $checkdugme["id"]="";
    $checkdugme["status"]="";
    $checkdugme["type"]="";
    $checkdugme["action_id"]=0;
    foreach ($data->durumkontrol	as $key => $value)
  {     \Helper::loginWithUserCode();
      if ($value->status=="iptal")
    {     \Helper::loginWithUserCode();
        $checkdugme["id"]=$value->masrafYeriId;
        $checkdugme["status"]=$value->status;
        $checkdugme["type"]=$value->masrafYeriTipi;
        $checkdugme["action_id"]=$value->id;
        break;
      }
      if ($value->status=="beklemede")
    {     \Helper::loginWithUserCode();
        $checkdugme["id"]=$value->masrafYeriId;
        $checkdugme["status"]=$value->status;
        $checkdugme["type"]=$value->masrafYeriTipi;
        $checkdugme["action_id"]=$value->id;
        break;
      }
    }

    $SatinTalepAltModel=new SatinTalepAltModel();
    $list =  $SatinTalepAltModel->where("talepId","=",$id)->get();
    $TedarikciModel=new \App\TedarikciModel();
    $allcompany=$TedarikciModel->get();

    return view("satinalma.showtalepalttalep",['list'=>$list,"allcompany"=>$allcompany,"data"=>$data,"checkdugme"=>$checkdugme]);
  }


  public function akisOlustur(Request $req)
{     \Helper::loginWithUserCode();

      $companylist = DB::table("companies")->get();
      $tumSatinAlmaModel=new SatinAlmaModel();
      $arama="";
      if (!empty($req->input("masrafyeri")))
    {     \Helper::loginWithUserCode();
          $tumSatinAlmaModel=$tumSatinAlmaModel->where("title","like",DB::raw("UPPER('%".$req->input("masrafyeri")."%')"));
          $arama=$req->input("masrafyeri");
      }
      $all=$tumSatinAlmaModel->with(['altdata'])->paginate(40);

      $userModel=new \App\User();
      $userList=$userModel->select("id","name","usercode")->get();
      $companylist = DB::table("companies")->get();

      return view("satinalma.masrafsurec",  ["companyList"=>$companylist,'userList'=>$userList,"list"=>$all,"arama"=>$arama]);
  }

  public function surecSave(Request $req)
{     \Helper::loginWithUserCode();

    $parentid=$req->input("parentId");
    $onay=$req->input("onaytype");
    $masrafyeri=$req->input("masrafyeri");
    $now=\Carbon\Carbon::parse("now")->format("Y-m-d H:i:s");
    $arrayx=array();
    if (!empty($masrafyeri))
  {     \Helper::loginWithUserCode();
        foreach ($masrafyeri as $key => $value)
      {     \Helper::loginWithUserCode();
          $arrayx[$key]["companyId"]=$req->input("firmCode");
          $arrayx[$key]["SatinAlmaId"]=$parentid;
          $arrayx[$key]["onaysirasi"]=$key;
          $arrayx[$key]["type"]=$onay[$key];
          $arrayx[$key]["unit_id"]=$masrafyeri[$key];
          $arrayx[$key]["active"]="yes";
          $arrayx[$key]["passiveDate"]="2030-01-01";
          $arrayx[$key]["created_at"]=$now;
          $arrayx[$key]["updated_at"]=$now;
        }
    }
    $insertModel=new SatinAlmaModelUserAccess();
    $insertModel->insert($arrayx);
    $message="Satın Alma masraf yeri kaydedildi.";
    return view("messages",['message'=>$message]);
  }


  public function surecKontrol($id)
{     \Helper::loginWithUserCode();

      $categories = SatinAlmaModel::with('parentRecursive')->where("id","=",71)->get();
      return $categories;

      return view("satinalma.surecIzleme",["masrafyerlerilistesi"=>$masrafyerlerilistesi,'data'=>$startFirst]);
  }

  public function surecSil($id)
{     \Helper::loginWithUserCode();

  }


  public function genelSurecTanimlama()
{     \Helper::loginWithUserCode();
    $SatinAlmaGenelSurecModel=new \App\SatinAlmaGenelSurecModel();
    $list=$SatinAlmaGenelSurecModel->orderBy("onaysirasi","ASC")->get();
    return view("satinalma.genelsurec",["list"=>$list]);
  }


  public function findlastnumber()
{     \Helper::loginWithUserCode();
      $satinAlmaFormu=new SatinTalepModel();
      $id=$satinAlmaFormu->orderBy("id","DESC")->first();
      $total="";
      if (empty($id)) {return "TLP-00001";}
      for($i=5;$i>strlen($id->id);$i--)
    {     \Helper::loginWithUserCode();
          $total.="0";
      }

      return "TLP-".$total.$id->id;
  }

  public function genelsurecsave(Request $req)
{     \Helper::loginWithUserCode();

    $SatinAlmaGenelSurecModel=new \App\SatinAlmaGenelSurecModel();
    $SatinAlmaGenelSurecModel->where("id",">","0")->delete();
    $now=\Carbon\Carbon::parse("now")->format("Y-m-d H:i:s");
    $SatinAlmaGenelSurecModel=new \App\SatinAlmaGenelSurecModel();
    $onaytype=$req->input("onaytype");
    $masrafyeri=$req->input("masrafyeri");
    $model=array();


    foreach ($onaytype as $key => $value)
  {     \Helper::loginWithUserCode();
      $model[$key]["companyId"]=1;
      $model[$key]["onaysirasi"]=$key;
      $model[$key]["type"]=$onaytype[$key];
      $model[$key]["unit_id"]=$masrafyeri[$key];
      $model[$key]["active"]="yes";
      $model[$key]["passiveDate"]=$now;
      $model[$key]["created_at"]=$now;
      $model[$key]["updated_at"]=$now;
    }
    $SatinAlmaGenelSurecModel->insert($model);

    $SatinAlmaModel=new SatinAlmaModel;
    $listdata=$SatinAlmaModel->get();
  //  return $listdata;
    $insertModel=new SatinAlmaModelUserAccess();
    $insertModel->where("id",">","0")->delete();


    foreach ($listdata as $vey => $malue)
  {     \Helper::loginWithUserCode();
      $arrayx=array();
      foreach ($onaytype as $key => $value)
    {     \Helper::loginWithUserCode();
        $arrayx[$key]["companyId"]=1;
        $arrayx[$key]["SatinAlmaId"]=$malue->id;
        $arrayx[$key]["onaysirasi"]=$key;
        $arrayx[$key]["type"]=$onaytype[$key];
        if ($onaytype[$key]=="ustdepartman")
      {     \Helper::loginWithUserCode();
          $masrafyerix=$malue->parentId; // $masrafyeri[$key]
        }else {
          $masrafyerix=$masrafyeri[$key];
        }
        $arrayx[$key]["unit_id"]=$masrafyerix;
        $arrayx[$key]["active"]="yes";
        $arrayx[$key]["passiveDate"]=$now;
        $arrayx[$key]["created_at"]=$now;
        $arrayx[$key]["updated_at"]=$now;
      }
      $insertModel->insert($arrayx);
    }

    return redirect()->back();


  }

  public function satinalmaonay(Request $req)
{     \Helper::loginWithUserCode();
      $SatinAlmaModel=new \App\SatinAlmaModel();

      $masrafyeri = \Auth::user()->id;
      $data=$SatinAlmaModel->where("masterUserId","=",$masrafyeri)->get();

      $masrafyeriYoneticisi=0;

      if (!empty($data)){     \Helper::loginWithUserCode();
        $masrafyeriYoneticisi=array();
        foreach ($data as $key => $value)
      {     \Helper::loginWithUserCode();
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
    {     \Helper::loginWithUserCode();
        $checkPlease=$SatinAlmaTalepDurumModel->where("talepId","=",$value->talepId)->where("masrafSiraId","<",$value->masrafSiraId)->where('status', '=', "beklemede")->first();
        if (empty($checkPlease))
      {     \Helper::loginWithUserCode();
          $arrayInTalep[]=$value->talepId;
        }
      }

      $SatinTalepModel=new \App\SatinTalepModel();

      $talepno="";
      if (!empty($req->input("talepno"))) {$SatinTalepModel=$SatinTalepModel->where("talepNo","=",$req->input("talepno")); $talepno=$req->input("talepno");}
      $tumTalepler=$SatinTalepModel->with(["durumkontrol"])->whereIn("id",$arrayInTalep)->where("status","islemde")->get();
      return view("satinalma.satinalmaonaymekanizma",['list'=>$tumTalepler,"userid"=>$userId,"unvandid"=>$unvanId,"masrafyeri"=>$masrafyeriYoneticisi,"talepno"=>$talepno]);

  }

  public function satinalmaislem(Request $req)
{     \Helper::loginWithUserCode();
      $SatinAlmaModel=new \App\SatinAlmaModel();

      $masrafyeri = \Auth::user()->id;
      $data=$SatinAlmaModel->where("masterUserId","=",$masrafyeri)->get();

      $masrafyeriYoneticisi=0;

      if (!empty($data)){     \Helper::loginWithUserCode();
        $masrafyeriYoneticisi=array();
        foreach ($data as $key => $value)
      {     \Helper::loginWithUserCode();
            $masrafyeriYoneticisi[]=$value->id;
        }
      }
      $userId = \Auth::user()->id;
      $unvanId =  \Auth::user()->gorevtanimi;
      $SatinAlmaTalepDurumModel=new \App\SatinAlmaTalepDurumModel();
      $actionData = $SatinAlmaTalepDurumModel->where(function($query) {
                                          $query->where('masrafYeriTipi', '=', "departman");
                                          $query->orWhere('masrafYeriTipi', '=', "ustdepartman");
                                        })->whereIn("masrafYeriId",$masrafyeriYoneticisi)->where('status', '!=', "beklemede")->orderBy("masrafSiraId","ASC")->get();



      $actionDataUser = $SatinAlmaTalepDurumModel->where(function($query) {
                                          $query->where('masrafYeriTipi', '=', "birey");
                                        })->where("masrafYeriId","=",$userId)->where('status', '!=', "beklemede")->orderBy("masrafSiraId","ASC")->get();

      $actionDataUnvan = $SatinAlmaTalepDurumModel->where(function($query) {
                                          $query->where('masrafYeriTipi', '=', "unvan");
                                        })->where("masrafYeriId","=",$unvanId)->where('status', '!=', "beklemede")->orderBy("masrafSiraId","ASC")->get();


      $merged = $actionData->merge($actionDataUser)->merge($actionDataUnvan);

      $arrayInTalep=array();
      foreach($merged as $key=>$value)
    {     \Helper::loginWithUserCode();
        $checkPlease=$SatinAlmaTalepDurumModel->where("talepId","=",$value->talepId)->where("masrafSiraId","<",$value->masrafSiraId)->where('status', '!=', "beklemede")->first();
        if (empty($checkPlease))
      {     \Helper::loginWithUserCode();
          $arrayInTalep[]=$value->talepId;
        }
      }

      $SatinTalepModel=new \App\SatinTalepModel();

      $tumTalepler=$SatinTalepModel->with(["durumkontrol"])->whereIn("id",$arrayInTalep)->get();
      return view("satinalma.satinalmaislem",['list'=>$tumTalepler,"userid"=>$userId,"unvandid"=>$unvanId,"masrafyeri"=>$masrafyeriYoneticisi]);

  }

  public function satinalmaTalepOnay(Request $req)
{     \Helper::loginWithUserCode();

    if(!empty($req->file('file')))
  {     \Helper::loginWithUserCode();
        $fileforEvrakModel=new \App\SatinAlmaTalepDocumentModel();
        $files= $req->file('file');
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();

        $fileForEvr=array();

        foreach ($files as $key=>$value)
      {     \Helper::loginWithUserCode();
            $fileForEvr[$key]["talepId"]=$req->input("talepId");
            $fileForEvr[$key]["userId"]=\Auth::user()->id;
            $fileForEvr[$key]["name"]=$value->getClientOriginalName();
            $fileForEvr[$key]["mediaurl"]=Storage::disk('public')->put('/', $value);
            $fileForEvr[$key]["deleted"]="no";
            $fileForEvr[$key]["created_at"]=$now;
            $fileForEvr[$key]["updated_at"]=$now;
        }

        $fileforEvrakModel->insert($fileForEvr);

    }

    if ($req->input("durum")=="red")
  {     \Helper::loginWithUserCode();
      $SatinTalepModel=new \App\SatinTalepModel();
      $SatinAlmaTalepDurumModel=new \App\SatinAlmaTalepDurumModel();
      $SatinTalepModel->where("id","=",$req->input("talepId"))->update(["status"=>"iptal"]);
      $SatinAlmaTalepDurumModel->where("id","=",$req->input("id"))->update(["status"=>"iptal","aciklama"=>$req->input("aciklama")]);

    }
    if ($req->input("durum")=="onay")
  {     \Helper::loginWithUserCode();
      $SatinAlmaTalepDurumModel=new \App\SatinAlmaTalepDurumModel();

      $SatinAlmaTalepDurumModel->where("id","=",$req->input("id"))->update(["status"=>"onaylandi","aciklama"=>$req->input("aciklama")]);

      $checker=\Helper::satinAlmaDurumuKontrol($req->input("talepId"));
      $sendanotherplace=true;
      foreach ($checker as $key => $value)
    {     \Helper::loginWithUserCode();
        if ($value["status"]=="beklemede" || $value["status"]=="iptal")
      {     \Helper::loginWithUserCode();
          $sendanotherplace=false;
        }
      }
      if ($sendanotherplace==true)
    {     \Helper::loginWithUserCode();
          // Artık Teklif Oluşturma Zamanı. Ve Ana yapıdan oluşan teklifleri siktir etme zamanı

          $SatinTalepModel=new \App\SatinTalepModel();
          $bilgi=$SatinTalepModel->find($req->input("talepId"));
          $TeklifTalepModel=new \App\TeklifTalepModel();
          $TeklifTalepModel->talepNo=$bilgi->talepNo;
          $TeklifTalepModel->talepId=$bilgi->id;
          $TeklifTalepModel->createdUser=$bilgi->createdUser;
          $TeklifTalepModel->masrafYeriId=$bilgi->masrafYeri;
          $TeklifTalepModel->status="beklemede";
          $TeklifTalepModel->aciklama="";
          $TeklifTalepModel->deleted="no";
          $TeklifTalepModel->save();
          $teklifid=$TeklifTalepModel->id;
          $SatinTalepAltModel=new SatinTalepAltModel();
          $urunler = $SatinTalepAltModel->where("status","=","onay")->get();
          $arrayx=array();
          $now=date("Y-m-d H:i:s");
          foreach($urunler as  $key=>$value)
        {     \Helper::loginWithUserCode();
              $arrayx[$key]['teklifId']=$teklifid;
              $arrayx[$key]['systemproductid']=$value->systemproductid;
              $arrayx[$key]['talepNo']=$value->talepNo;
              $arrayx[$key]['stokkodu']=$value->stokkodu;
              $arrayx[$key]['urunadi']=$value->urunadi;
              $arrayx[$key]['stokturu']=$value->stokturu;
              $arrayx[$key]['stoksinifi']=$value->stoksinifi;
              $arrayx[$key]['stokbirimi']=$value->stokbirimi;
              $arrayx[$key]['stokadet']=$value->stokadet;
              $arrayx[$key]['stokaciklamasi']=$value->stokaciklamasi;
              $arrayx[$key]['onerilentedarikci']=$value->onerilentedarikci;
              $arrayx[$key]['birimfiyati']=$value->birimfiyati;
              $arrayx[$key]['status']="bekleme";
              $arrayx[$key]['deleted']="no";
              $arrayx[$key]['created_at']=$now;
              $arrayx[$key]['updated_at']=$now;

          }
          $TeklifTalepAltModel=new \App\TeklifTalepAltModel();
          $TeklifTalepAltModel->insert($arrayx);
          $SatinTalepModel->where("id","=",$req->input("talepId"))->update(["status"=>"teklifolustu"]);
          return view("satinalma.talepolusturmasecimi");

      } // Hey man this is action to go
      return redirect()->back();
    }


    return redirect()->back();
  }

  public function birimRed($id)
{     \Helper::loginWithUserCode();
    $SatinTalepAltModel=new SatinTalepAltModel();
    $SatinTalepAltModel->where("id","=",$id)->update(["status"=>"iptal","redUser"=>\Auth::user()->id]);
    return "ok";
  }

}
