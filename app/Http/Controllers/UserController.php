<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return "index not maded";
    }

    public function login()
    {

      if (Auth::check())
      {
          return redirect('/'); // gerekli olan alanı çözsün
      }
        return view('login');
    }

    public function checkLogin(Request $req)
    {



      if (\Auth::check())
      {
        return redirect('/');
      }else {
          $credentials = $req->only('email', 'password');

          if (\Auth::attempt($credentials, false, true))
          {
              return redirect('/');
          }else {
              return redirect("/login")->withErrors(["error"=>"Kullanıcı Adı ve/veya Şifre Hatalı"]);
          }
      }


    }

    public function welcome()
    {
      return view("welcome");
    }

    public function logout()
    {
      Auth::logout();
      return redirect('/login');
    }


    public function getAllUserExternalAction()
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
                $userModel->role="admin";
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

    public function recovermainstream()
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
