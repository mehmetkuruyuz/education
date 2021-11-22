<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class EArsivController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
    //    $this->middleware("auth");  // this will solve your problem
     }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $req)
    {
        $protokol_no="";
        $tc_kimlik="";
        $EArsivModel=new \App\EArsivModel();
        if (!empty($req->input('protokol_no'))) { $protokol_no=$req->input('protokol_no'); $EArsivModel=$EArsivModel->where("protokol_no",'like','%'.$protokol_no.'%');}
        if (!empty($req->input('tc_kimlik'))) { $tc_kimlik=$req->input('tc_kimlik'); $EArsivModel=$EArsivModel->where("tc_kimlik",'like','%'.$tc_kimlik.'%');}


        $list=$EArsivModel->get();
        return view("earsiv.list",["list"=>$list,"protokol_no"=>$protokol_no,"tc_kimlik"=>$tc_kimlik]);
    }

    public function save(Request $req)
    {
      $EArsivModel=new \App\EArsivModel();
      $EArsivModel->protokol_no=$req->input("protokol_no");
      $EArsivModel->tc_kimlik=$req->input("tckimlik_no");
      $EArsivModel->userId=\Auth::user()->id;
      $EArsivModel->deleted="no";
      $EArsivModel->save();
      $id=$EArsivModel->id;

      $EArsivDosyaModel=new \App\EArsivDosyaModel();
      $files= $req->file('file');
      $now = \Carbon\Carbon::now('utc')->toDateTimeString();

      $fileForEvr=array();

      foreach ($files as $key=>$value)
      {
          $fileForEvr[$key]["arsivId"]=$id;
          $fileForEvr[$key]["userId"]=\Auth::user()->id;
          $fileForEvr[$key]["name"]=$value->getClientOriginalName();
          $fileForEvr[$key]["mediaurl"]=Storage::disk('public')->put('/', $value);
          $fileForEvr[$key]["deleted"]="no";
          $fileForEvr[$key]["created_at"]=$now;
          $fileForEvr[$key]["updated_at"]=$now;
      }

      $EArsivDosyaModel->insert($fileForEvr);
      return redirect()->back();

    }


    public function queue(Request $req)
    {
        $EArsivModel=new \App\EArsivModel();
        $protokol_no="";
        $tc_kimlik="";
        $raf="";
        $sira="";
        $dosya="";

        $EArsivModel=new \App\EArsivModel();
        if (!empty($req->input('protokol_no'))) { $protokol_no=$req->input('protokol_no'); $EArsivModel=$EArsivModel->where("protokol_no",'like','%'.$protokol_no.'%');}
        if (!empty($req->input('tc_kimlik'))) { $tc_kimlik=$req->input('tc_kimlik'); $EArsivModel=$EArsivModel->where("tc_kimlik",'like','%'.$tc_kimlik.'%');}
        if (!empty($req->input('raf'))) { $raf=$req->input('raf'); $EArsivModel=$EArsivModel->where("raf",'like','%'.$raf.'%');}
        if (!empty($req->input('sira'))) { $sira=$req->input('sira'); $EArsivModel=$EArsivModel->where("sira",'like','%'.$sira.'%');}
        if (!empty($req->input('dosya'))) { $dosya=$req->input('dosya'); $EArsivModel=$EArsivModel->where("dosya",'like','%'.$dosya.'%');}

        $list=$EArsivModel->where("adresleme_tarihi","=",NULL)->get();
        return view("earsiv.queue",["list"=>$list,"protokol_no"=>$protokol_no,"tc_kimlik"=>$tc_kimlik,"raf"=>$raf,"sira"=>$sira,"dosya"=>$dosya]);
        return $list;

    }


    public function update(Request $req)
    {
      $EArsivModel=new \App\EArsivModel();
      $array["raf"]=$req->input("raf");
      $array["sira"]=$req->input("sira");
      $array["dosya"]=$req->input("dosya");
      $array["adresleme_tarihi"]= \Carbon\Carbon::now('utc')->toDateTimeString();

      $EArsivModel->where("id","=",$req->input("id"))->update($array);
      return redirect()->back();
      return $req;

    }


    public function show($id)
    {

        $EArsivModel=new \App\EArsivModel();
        $data=$EArsivModel->with(["dosyalama"])->find($id);
        return view("earsiv.show",["data"=>$data]);

    }


}
