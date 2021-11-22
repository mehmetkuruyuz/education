<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ProductsCategoryModel;
use App\ProductsModel;
use Illuminate\Support\Facades\DB;

class TedarikciController extends Controller
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

      $TedarikciModel=new \App\TedarikciModel();

      if (!empty($req->input('firmakodu'))) { $firmakodu=$req->input('firmakodu'); $TedarikciModel=$TedarikciModel->where("firmakodu",'like','%'.$firmakodu.'%');}
      if (!empty($req->input('firmaadi'))) { $firmaadi=$req->input('firmaadi'); $TedarikciModel=$TedarikciModel->where("firmaadi",'like','%'.$firmaadi.'%');}
      if (!empty($req->input('sehir'))) { $searchsehir=$req->input('sehir'); $TedarikciModel=$TedarikciModel->where("sehir",'like','%'.$searchsehir.'%');}
      if (!empty($req->input('searchilce'))) { $searchilce=$req->input('searchilce'); $TedarikciModel=$TedarikciModel->where("ilce",'like','%'.$searchilce.'%');}


      $sehir=DB::table("sehir")->orderBy("sehir_title","ASC")->get();
      $SektorModel=new \App\SektorModel();
      $sektor=$SektorModel->get();
      $list=$TedarikciModel->paginate(40);

      return view("tedarikci.list",["list"=>$list,"sehir"=>$sehir,"sektor"=>$sektor]);
    }



    public function save(Request $req)
    {

      $TedarikciModel=new \App\TedarikciModel();
      $TedarikciModel->firmakodu=$req->input("firmakodu");
      $TedarikciModel->firmaturu=$req->input("firmaturu");
      $TedarikciModel->firmaadi=$req->input("firmaadi");
      $TedarikciModel->firmaticariunvani=$req->input("firmaticariunvani");
      $TedarikciModel->adres=$req->input("adres");
      $TedarikciModel->sehir=$req->input("sehir");
      $TedarikciModel->ilce=$req->input("ilce");
      $TedarikciModel->telefon=$req->input("telefon");
      $TedarikciModel->fax=$req->input("fax");
      $TedarikciModel->email=$req->input("email");
      $TedarikciModel->webadresi=$req->input("webadresi");
      $TedarikciModel->sektor=$req->input("sektor");
      $TedarikciModel->vergidairesi=$req->input("vergidairesi");
      $TedarikciModel->vergino=$req->input("vergino");
      $TedarikciModel->deleted="no";
      $TedarikciModel->save();
      return redirect()->back();
      return $req;
    }


    public function edit($id)
    {
      $sehir=DB::table("sehir")->orderBy("sehir_title","ASC")->get();
      $SektorModel=new \App\SektorModel();
      $sektor=$SektorModel->get();
      $TedarikciModel=new \App\TedarikciModel();
      $data=$TedarikciModel->find($id);
      return view("tedarikci.edit",["data"=>$data,"sehir"=>$sehir,"sektor"=>$sektor]);
      return $data;
    }

    public function update(Request $req)
    {

        $TedarikciModel=new \App\TedarikciModel();
        $model["firmakodu"]=$req->input("firmakodu");
        $model["firmaturu"]=$req->input("firmaturu");
        $model["firmaadi"]=$req->input("firmaadi");
        $model["firmaticariunvani"]=$req->input("firmaticariunvani");
        $model["adres"]=$req->input("adres");
        $model["sehir"]=$req->input("sehir");
        $model["ilce"]=$req->input("ilce");
        $model["telefon"]=$req->input("telefon");
        $model["fax"]=$req->input("fax");
        $model["email"]=$req->input("email");
        $model["webadresi"]=$req->input("webadresi");
        $model["sektor"]=$req->input("sektor");
        $model["vergidairesi"]=$req->input("vergidairesi");
        $model["vergino"]=$req->input("vergino");

        $TedarikciModel->where("id","=",$req->input("id"))->update($model);
        return redirect()->back();
        return $req;

    }

    public function delete($id)
    {
      $TedarikciModel=new \App\TedarikciModel();
      $data=$TedarikciModel->where("id","=",$id)->update(["deleted"=>"yes"]);
      return redirect()->back();
    }


    public  function yetkili($id)
    {

        $sehir=DB::table("sehir")->orderBy("sehir_title","ASC")->get();
        $SektorModel=new \App\SektorModel();
        $sektor=$SektorModel->get();
        $TedarikciModel=new \App\TedarikciModel();
        $data=$TedarikciModel->find($id);
        $YetkiliUnvanModel=new \App\YetkiliUnvanModel();
        $allunvan=$YetkiliUnvanModel->get();
        $YetkiliModel=new \App\YetkiliModel();
        $allylist=$YetkiliModel->where("firmaid","=",$id)->get();
        return view("tedarikci.yetkili",["data"=>$data,"sehir"=>$sehir,"sektor"=>$sektor,"allunvan"=>$allunvan,"allylist"=>$allylist]);
        return $data;

    }

    public function yetkilisave(Request $req)
    {
      $YetkiliModel=new \App\YetkiliModel();
      $YetkiliModel->firmaid=$req->input("firmaid");
      $YetkiliModel->kullanicikodu=$req->input("kullanicikodu");
      $YetkiliModel->adisoyadi=$req->input("adisoyadi");
      $YetkiliModel->unvan=$req->input("unvan");
      $YetkiliModel->telefon=$req->input("telefon");
      $YetkiliModel->email=$req->input("email");
      $YetkiliModel->deleted="no";
      $YetkiliModel->save();
      return redirect()->back();
      return $req;
    }

    public function yetkilidelete($id)
    {
      $YetkiliModel=new \App\YetkiliModel();
      $YetkiliModel->where("id","=",$id)->update(["deleted"=>"yes"]);
      return redirect()->back();
      return $id;
    }

    public function yetkiliedit($id)
    {
      $sehir=DB::table("sehir")->orderBy("sehir_title","ASC")->get();
      $SektorModel=new \App\SektorModel();
      $sektor=$SektorModel->get();
      $TedarikciModel=new \App\TedarikciModel();
      $data=$TedarikciModel->find($id);
      $YetkiliUnvanModel=new \App\YetkiliUnvanModel();
      $allunvan=$YetkiliUnvanModel->get();
      $YetkiliModel=new \App\YetkiliModel();
      $data = $YetkiliModel->find($id);
      return view("tedarikci.yetkiliedit",["data"=>$data,"sehir"=>$sehir,"sektor"=>$sektor,"allunvan"=>$allunvan]);
    }

    public function yetkiliupdate(Request $req)
    {
      $YetkiliModel=new \App\YetkiliModel();
      $model["firmaid"]=$req->input("firmaid");
      $model["kullanicikodu"]=$req->input("kullanicikodu");
      $model["adisoyadi"]=$req->input("adisoyadi");
      $model["unvan"]=$req->input("unvan");
      $model["telefon"]=$req->input("telefon");
      $model["email"]=$req->input("email");
      $YetkiliModel->where("id","=",$req->input("id"))->update($model);
      return redirect()->back();
    }




        public function unvanlist()
        {
            $SektorModel=new \App\YetkiliUnvanModel();
            $list=$SektorModel->paginate(40);
            return view("unvan.list",["list"=>$list]);
        }

        public function unvansave(Request $req)
        {
            $SektorModel=new \App\YetkiliUnvanModel();
            $SektorModel->code=$req->input("birimKodu");
            $SektorModel->title=$req->input("malzemeAciklamasi");
            $SektorModel->deleted="no";
            $SektorModel->save();
            return redirect()->back();
        }

        public function unvandelete($id)
        {

            $SektorModel=new \App\YetkiliUnvanModel();
            $SektorModel->where("id","=",$id)->update(["deleted"=>"yes"]);
            return redirect()->back();
        }


        public function unvanedit($id)
        {

            $SektorModel=new \App\YetkiliUnvanModel();
            $data=$SektorModel->find($id);
            return view("unvan.edit",["data"=>$data]);
            return $type;
        }

        public function unvanupdate(Request $req)
        {
          $SektorModel=new \App\YetkiliUnvanModel();
          $id=$req->input("id");
          $model["code"]=$req->input("birimKodu");
          $model["title"]=$req->input("malzemeAciklamasi");
          $SektorModel->where("id","=",$id)->update($model);

          return redirect()->back();
        }
}
