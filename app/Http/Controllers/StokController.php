<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ProductsCategoryModel;
use App\ProductsModel;

class StokController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function listProducts(Request $req)
    {
      $type=$req->input("type");
      $model=new ProductsModel();

      if (!empty($req->input("type")))
      {
          $model=$model->where("typeofproduct","=",$req->input("type"));
      }

      $MalzemeBirimiModel=new \App\MalzemeBirimiModel;
      $MalzemeBirimiList=$MalzemeBirimiModel->get();
      $MalzemeTipiModel=new \App\MalzemeTipiModel;
      $MalzemeTipiList=$MalzemeTipiModel->get();
      $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
      $MalzemeSinifiList=$MalzemeSinifiModel->get();
      $DepoTipiModel=new \App\DepoTipiModel;
      $DepoTipiList=$DepoTipiModel->get();
      $StokTuruModel=new \App\StokTuruModel;
      $StokTuruList=$StokTuruModel->get();






            if (!empty($req->input('stokkodu'))) { $stokkodu=$req->input('stokkodu'); $model=$model->where("malzemeKodu",'like','%'.$stokkodu.'%');}
            if (!empty($req->input('stoktanimi'))) { $stoktanimi=$req->input('stoktanimi'); $model=$model->where("malzemeAciklamasi",'like','%'.$stoktanimi.'%');}
            if (!empty($req->input('stokTurusearch'))) { $stokTurusearch=$req->input('stokTurusearch'); $model=$model->where("stokTuru",'=',$stokTurusearch);}
            if (!empty($req->input('malzemeTipisearch'))) { $malzemeTipisearch=$req->input('malzemeTipisearch'); $model=$model->where("malzemeTipi",'=',$malzemeTipisearch);}
            if (!empty($req->input('malzemeSinifisearch'))) { $malzemeSinifisearch=$req->input('malzemeSinifisearch'); $model=$model->where("malzemeSinifi",'=',$malzemeSinifisearch);}

      $list=$model->paginate(50);







      return view("stok.list",['list'=>$list,'type'=>$type,"MalzemeBirimiList"=>$MalzemeBirimiList,
                                "MalzemeTipiList"=>$MalzemeTipiList,"MalzemeSinifiList"=>$MalzemeSinifiList,"DepoTipiList"=>$DepoTipiList,
                                "StokTuruList"=>$StokTuruList]);
      return $list;
    }

    public function saveProducts(Request $req)
    {

      $model=new ProductsModel();

      $model->malzemeKodu=$req->input("malzemeKodu");
      $model->malzemeAciklamasi=$req->input("malzemeAciklamasi");
      $model->malzemeTipi=$req->input("malzemeTipi");
      $model->malzemeSinifi=$req->input("malzemeSinifi");
      $model->malzemeBirimi=$req->input("malzemeBirimi");
      $model->stokTuru=$req->input("stokTuru");

      $model->x=$req->input("x");
      $model->y=$req->input("y");
      $model->z=$req->input("z");
      $model->hacim=$req->input("hacim");
      $model->agirlik=$req->input("agirlik");
      $model->netagirlik=$req->input("netagirlik");
      $model->ozelurun1=$req->input("ozelurun1");
      $model->ozelurun2=$req->input("ozelurun2");
      $model->ozelurun3=$req->input("ozelurun3");
      $model->depolamaTipi=$req->input("depolamaTipi");
      $model->birimFiyat=$req->input("birimFiyat");
      $model->kullanimSuresi=$req->input("kullanimSuresi");
      $model->depoNumarasi=$req->input("depoNumarasi");
      $model->malzemeEmliyetStogu=$req->input("malzemeEmliyetStogu");
      $model->minDeger=$req->input("minDeger");
      $model->maxDeger=$req->input("maxDeger");
      $model->yenidenSiparis=$req->input("yenidenSiparis");
      $model->ambarKodu=$req->input("ambarKodu");
      $model->tedarikciKodu=$req->input("tedarikciKodu");
      $model->musteriKodu=$req->input("musteriKodu");

      $model->kdvOrani=$req->input("kdvOrani");
      $model->muhasebeKodu=$req->input("muhasebeKodu");
      $model->marka=$req->input("marka");
      $model->gtip=$req->input("gtip");


      $model->deleted="no";
      $model->save();
      return redirect()->back();
      return view("messages",["message"=>"Ürün Sisteme Kaydedildi."]);
    }


    public function deleteProducts($id)
    {
      $model=new ProductsModel();
      $model->where("id","=",$id)->update(["deleted"=>"yes"]);
      return redirect()->back();
    }

    public function editProducts($id)
    {
      $model=new ProductsModel();
      $data=$model->find($id);
      $MalzemeBirimiModel=new \App\MalzemeBirimiModel;
      $MalzemeBirimiList=$MalzemeBirimiModel->get();
      $MalzemeTipiModel=new \App\MalzemeTipiModel;
      $MalzemeTipiList=$MalzemeTipiModel->get();
      $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
      $MalzemeSinifiList=$MalzemeSinifiModel->get();

      $DepoTipiModel=new \App\DepoTipiModel;
      $DepoTipiList=$DepoTipiModel->get();

      return view("stok.edit",["MalzemeBirimiList"=>$MalzemeBirimiList,"MalzemeTipiList"=>$MalzemeTipiList,"MalzemeSinifiList"=>$MalzemeSinifiList,"DepoTipiList"=>$DepoTipiList,'data'=>$data]);
    }
    public function updateProducts(Request $req)
    {
      $ProductsModel=new ProductsModel();

      $model["malzemeKodu"]=$req->input("malzemeKodu");
      $model["malzemeAciklamasi"]=$req->input("malzemeAciklamasi");
      $model["malzemeTipi"]=$req->input("malzemeTipi");
      $model["malzemeSinifi"]=$req->input("malzemeSinifi");
      $model["malzemeBirimi"]=$req->input("malzemeBirimi");
      $model["x"]=$req->input("x");
      $model["y"]=$req->input("y");
      $model["z"]=$req->input("z");
      $model["hacim"]=$req->input("hacim");
      $model["agirlik"]=$req->input("agirlik");
      $model["netagirlik"]=$req->input("netagirlik");
      $model["ozelurun1"]=$req->input("ozelurun1");
      $model["ozelurun2"]=$req->input("ozelurun2");
      $model["ozelurun3"]=$req->input("ozelurun3");
      $model["depolamaTipi"]=$req->input("depolamaTipi");
      $model["birimFiyat"]=$req->input("birimFiyat");
      $model["kullanimSuresi"]=$req->input("kullanimSuresi");
      $model["depoNumarasi"]=$req->input("depoNumarasi");
      $model["malzemeEmliyetStogu"]=$req->input("malzemeEmliyetStogu");
      $model["minDeger"]=$req->input("minDeger");
      $model["maxDeger"]=$req->input("maxDeger");
      $model["yenidenSiparis"]=$req->input("yenidenSiparis");
      $model["ambarKodu"]=$req->input("ambarKodu");
      $model["tedarikciKodu"]=$req->input("tedarikciKodu");
      $model["musteriKodu"]=$req->input("musteriKodu");
      $model["kdvOrani"]=$req->input("kdvOrani");
      $model["muhasebeKodu"]=$req->input("muhasebeKodu");
      $model["marka"]=$req->input("marka");
      $model["gtip"]=$req->input("gtip");


      $ProductsModel->where("id","=",$req->input("id"))->update($model);
      return redirect()->back();
    }

    public function controlAltElemanlar($type)
    {


      switch ($type) {
        case 'tip':
            $MalzemeTipiModel=new \App\MalzemeTipiModel;
            $data=$MalzemeTipiModel->paginate(50);
            $title="Tipi";
            $type="tip";
        break;
        case 'birim':
            $MalzemeBirimiModel=new \App\MalzemeBirimiModel;
            $data=$MalzemeBirimiModel->paginate(50);
            $title="Birim";
            $type="birim";
        break;
        case 'sinif':
            $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
            $data=$MalzemeSinifiModel->paginate(50);
            $title="Sınıf";
            $type="sinif";
        break;
        case 'turu':
            $MalzemeSinifiModel=new \App\StokTuruModel;
            $data=$MalzemeSinifiModel->paginate(50);
            $title="Türü";
            $type="turu";
        break;
      }
      return view("stok.stoktumaltkontrol",["list"=>$data,"title"=>$title,"type"=>$type]);
      return $type;
    }

    public function saveStokReq(Request $req)
    {
      $type=$req->input("type");


      switch ($type) {
        case 'tip':
          $MalzemeTipiModel=new \App\MalzemeTipiModel;


          $MalzemeTipiModel->code=$req->input("birimKodu");
          $MalzemeTipiModel->title=$req->input("malzemeAciklamasi");
          $MalzemeTipiModel->deleted="no";
          $MalzemeTipiModel->save();
        break;
        case 'birim':
          $MalzemeBirimiModel=new \App\MalzemeBirimiModel;

          $MalzemeBirimiModel->code=$req->input("birimKodu");
          $MalzemeBirimiModel->title=$req->input("malzemeAciklamasi");
          $MalzemeBirimiModel->deleted="no";
          $MalzemeBirimiModel->save();

        break;
        case 'sinif':
            $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
            $MalzemeSinifiModel->code=$req->input("birimKodu");
            $MalzemeSinifiModel->title=$req->input("malzemeAciklamasi");
            $MalzemeSinifiModel->deleted="no";
            $MalzemeSinifiModel->save();
        break;
        case 'turu':
            $MalzemeSinifiModel=new \App\StokTuruModel;
            $MalzemeSinifiModel->code=$req->input("birimKodu");
            $MalzemeSinifiModel->title=$req->input("malzemeAciklamasi");
            $MalzemeSinifiModel->deleted="no";
            $MalzemeSinifiModel->save();
        break;
      }

      return redirect()->back();
      return $req;
    }

    public function stokDelete($type,$id)
    {
      switch ($type) {
        case 'tip':
            $MalzemeTipiModel=new \App\MalzemeTipiModel;
            $MalzemeTipiModel->where("id","=",$id)->update(["deleted"=>"yes"]);
        break;
        case 'birim':
            $MalzemeBirimiModel=new \App\MalzemeBirimiModel;
            $MalzemeBirimiModel->where("id","=",$id)->update(["deleted"=>"yes"]);

        break;
        case 'sinif':
            $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
            $MalzemeSinifiModel->where("id","=",$id)->update(["deleted"=>"yes"]);
        break;
        case 'turu':
            $MalzemeSinifiModel=new \App\StokTuruModel;
            $MalzemeSinifiModel->where("id","=",$id)->update(["deleted"=>"yes"]);
        break;
      }
            return redirect()->back();
    }


    public function altElemanEdit($type,$id)
    {


      switch ($type) {
        case 'tip':
            $MalzemeTipiModel=new \App\MalzemeTipiModel;
            $data=$MalzemeTipiModel->find($id);
            $title="Tipi";
            $type="tip";
        break;
        case 'birim':
            $MalzemeBirimiModel=new \App\MalzemeBirimiModel;
            $data=$MalzemeBirimiModel->find($id);
            $title="Birim";
            $type="birim";
        break;
        case 'sinif':
            $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
            $data=$MalzemeSinifiModel->find($id);
            $title="Sınıf";
            $type="sinif";
        break;
        case 'turu':
            $MalzemeSinifiModel=new \App\StokTuruModel;
            $data=$MalzemeSinifiModel->find($id);
            $title="Türü";
            $type="turu";
        break;
      }
      return view("stok.altislemedit",["data"=>$data,"title"=>$title,"type"=>$type]);
      return $type;
    }

    public function altElemanUpdate(Request $req)
    {
      $type=$req->input("type");
      $id=$req->input("id");
      $model["code"]=$req->input("birimKodu");
      $model["title"]=$req->input("malzemeAciklamasi");

      switch ($type) {
        case 'tip':
          $MalzemeTipiModel=new \App\MalzemeTipiModel;
          $MalzemeTipiModel->where("id","=",$id)->update($model);
        break;
        case 'birim':
          $MalzemeBirimiModel=new \App\MalzemeBirimiModel;

          $MalzemeBirimiModel->deleted="no";
          $MalzemeBirimiModel->where("id","=",$id)->update($model);

        break;
        case 'sinif':
            $MalzemeSinifiModel=new \App\MalzemeSinifiModel;
            $MalzemeSinifiModel->where("id","=",$id)->update($model);
        break;
        case 'turu':
            $MalzemeSinifiModel=new \App\StokTuruModel;
            $MalzemeSinifiModel->where("id","=",$id)->update($model);
        break;
      }

      return redirect()->back();
      return $req;
    }
}
