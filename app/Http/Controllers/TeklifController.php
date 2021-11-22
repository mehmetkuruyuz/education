<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeklifController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $req)
    {
      //$TeklifTalepModel=new \App\TeklifTalepModel();
      $TeklifTalepAltModel=new \App\TeklifTalepAltModel();

      $stokkodu="";
      if (!empty($req->input("stokkodu"))) {$TeklifTalepAltModel=$TeklifTalepAltModel->where("stokkodu","=",$req->input("stokkodu")); $stokkodu=$req->input("stokkodu");}


      $list=$TeklifTalepAltModel->with(["teklifurun.teklifdurum"])->where("status","=","bekleme")->select([DB::raw("*"),DB::raw("SUM(stokAdet) as total_debit")])->groupBy('systemproductid')->get();
      $TedarikciModel=new \App\TedarikciModel();


      $allcompany=$TedarikciModel->get();

      return view("teklif.list",['list'=>$list,'firmalist'=>$allcompany,"stokkodu"=>$stokkodu]);
    }

    public function siparis(Request $req)
    {

      $TeklifTalepAltModel=new \App\TeklifTalepAltModel();
      $stokkodu="";
      if (!empty($req->input("stokkodu"))) {$TeklifTalepAltModel=$TeklifTalepAltModel->where("stokkodu","=",$req->input("stokkodu")); $stokkodu=$req->input("stokkodu");}

      $list=$TeklifTalepAltModel->with(["teklifsiparis"])->where("status","=","siparisedildi")->select([DB::raw("*"),DB::raw("SUM(stokAdet) as total_debit")])->groupBy('satinAlmaKodu')->get();

      return view("teklif.siparislist",['list'=>$list,"stokkodu"=>$stokkodu]);
    }


    public function tamamlanmis(Request $req)
    {

      $TeklifTalepAltModel=new \App\TeklifTalepAltModel();
      $stokkodu="";
      if (!empty($req->input("stokkodu"))) {$TeklifTalepAltModel=$TeklifTalepAltModel->where("stokkodu","=",$req->input("stokkodu")); $stokkodu=$req->input("stokkodu");}

      $list=$TeklifTalepAltModel->with(["tekliftamamlandi"])->where("status","=","tedarikedildi")->select([DB::raw("*"),DB::raw("SUM(stokAdet) as total_debit")])->groupBy('satinAlmaKodu')->get();

      return view("teklif.tamamlandilist",['list'=>$list,"stokkodu"=>$stokkodu]);
    }

    public function onayla(Request $req)
    {

      $satinalmakodu=$req->input("satinalmakodu");
      $onerilentedarikci=$req->input("onerilentedarikci")."";
      $TeklifTalepAltModel=new \App\TeklifTalepAltModel();
      $alttalepno=$req->input("alttalepno");
      $siparistarihi=date("Y-m-d H:i:s");

      $TeklifTalepAltModel->whereIn("id",$alttalepno)->update(["status"=>'siparisedildi','satinAlmaKodu'=>$satinalmakodu,'tedarikci'=>$onerilentedarikci,'siparistarihi'=>$siparistarihi]);

/*
      $TeklifTalepModel=new \App\TeklifTalepModel();

      $list=$TeklifTalepModel->with(["altelemaninbekleme"])->withCount('altelemaninbekleme')->having('altelemaninbekleme_count', '=', 0)->get();
      $tumteklifler=array();
      foreach ($list as $key => $value)
      {
        $tumteklifler[]=$value->id;
      }
      if (!empty($tumteklifler))
      $TeklifTalepModel=new \App\TeklifTalepModel();
      $TeklifTalepModel->whereIn("id",$tumteklifler)->update(['status'=>'tamamlandi']);
      */
      return redirect()->back();;
    }


    public function tedarik(Request $req)
    {
      $teminedildi=date("Y-m-d H:i:s");
      $TeklifTalepAltModel=new \App\TeklifTalepAltModel();
      $alttalepno=$req->input("alttalepno");
      $TeklifTalepAltModel->whereIn("id",$alttalepno)->update(["status"=>'tedarikedildi','teminedildi'=>$teminedildi]);
      $TeklifTalepModel=new \App\TeklifTalepModel();
      $list=$TeklifTalepModel->with(["altelemaninbekleme"])->withCount('altelemaninbekleme')->having('altelemaninbekleme_count', '=', 0)->get();
      $tumteklifler=array();
      foreach ($list as $key => $value)
      {
        $tumteklifler[]=$value->id;
      }
      if (!empty($tumteklifler))
      $TeklifTalepModel=new \App\TeklifTalepModel();
      $TeklifTalepModel->whereIn("id",$tumteklifler)->update(['status'=>'tamamlandi']);
      return redirect()->back();;
    }



}
