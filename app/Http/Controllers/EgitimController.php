<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class EgitimController extends Controller
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

    public function index()
    {

        $userAccessToLogin=new \App\UserAccessEducationModel;
        $userId=\Auth::user()->id;
        $listofeducation=$userAccessToLogin->where("userId","=",$userId)->get();
        foreach ($listofeducation as $key => $value)
        {
            if ($value->permissionType=='category')
            {
              $findCategory=new \App\EducationCategoriesModel;
              $value->subvideoData=$findCategory->with(["education"])->where("id","=",$value->categoryId)->first();

            }else {
              $value->subvideoData="";
            }
        }
        return view('egitim.education_category',['educationList'=>$listofeducation]);
    }

    public function watchvideo($id)
    {
        if (empty($id) || $id<1)  {  abort(404);  }

        $educationModel=new \App\EducationModel;
        $data=$educationModel->find($id);


      //  return $data;

        return view('egitim.education_watch',['education'=>$id,'educationData'=>$data]);
    }




    public function educationcategorylist(Request $req)
    {

  //    return $req;

      $findCategory=new \App\EducationCategoriesModel;
      $categoryname="";
      if (!empty($req->input('categoryname'))) { $categoryname=$req->input('categoryname'); $findCategory=$findCategory->where("title",'like','%'.$categoryname.'%');}
      $categoryList=$findCategory->get();
      return view("education.category_list",['list'=>$categoryList,"categoryname"=>$categoryname]);
    }

    public function educationCategorySave(Request $req)
    {
      $findCategory=new \App\EducationCategoriesModel;


      $findCategory->title=$req->input("title");
      $findCategory->description=$req->input("description");
      $findCategory->deleted="no";
      $findCategory->save();
      return redirect()->back();
      return $req;
    }

    public function educationEdit($id)
    {
        $findCategory=new \App\EducationCategoriesModel;
        $data=$findCategory->find($id);
        return view("education.category_edit",["data"=>$data]);
    }

    public function educationCategoryUpdate(Request $req)
    {
      $ModalCategory=new \App\EducationCategoriesModel;
      $findCategory["title"]=$req->input("title");
      $findCategory["description"]=$req->input("description");
      $ModalCategory->where("id","=",$req->input("id"))->update($findCategory);
      return redirect()->back();
    }

    public function educationCategoryDelete($id)
    {
      $ModalCategory=new \App\EducationCategoriesModel;
      $ModalCategory->where("id","=",$id)->update(["deleted"=>"yes"]);
      return redirect()->back();
    }



    public function educationLessons(Request $req,$id)
    {

        $findCategory=new \App\EducationCategoriesModel;
        $categoryList=$findCategory->find($id);
        $title = $categoryList->title;

        $SinavModel=new \App\SinavModel();
        $sinavList=$SinavModel->where("enddate",">=",date("Y-m-d"))->get();

        $PollsModel=new \App\PollsModel();
        $pollsList=$PollsModel->where("enddate",">=",date("Y-m-d"))->get();


        $EducationModel=new \App\EducationModel();
        $teacherName="";
        $egitimTitle="";
        $egitimCode="";
        if (!empty($req->input('egitimCode'))) { $egitimCode=$req->input('egitimCode'); $EducationModel=$EducationModel->where("egitimCode",'like','%'.$egitimCode.'%');}
        if (!empty($req->input('egitimTitle'))) { $egitimTitle=$req->input('egitimTitle'); $EducationModel=$EducationModel->where("title",'like','%'.$egitimTitle.'%');}
        if (!empty($req->input('teacherName'))) { $teacherName=$req->input('teacherName'); $EducationModel=$EducationModel->where("teacherName",'like','%'.$teacherName.'%');}
        $data = $EducationModel->where("categoryId","=",$id)->get();
        return view("education.education_list",["categoryid"=>$id,"list"=>$data,"title"=>$title,'egitimid'=>$id,"egitimCode"=>$egitimCode,"egitimTitle"=>$egitimTitle,"teacherName"=>$teacherName,
        "sinavList"=>$sinavList,
        "pollsList"=>$pollsList
      ]);
    }


    public function educationSave(Request $req)
    {
      $bitissuresi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("bitissuresi"))->format("Y-m-d");
      $baslangictarihi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("baslangictarihi"))->format("Y-m-d");
      $bitistarihi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("bitistarihi"))->format("Y-m-d");
  //    return $bitissuresi;
      $EducationModel=new \App\EducationModel();

      $videoname=Storage::disk('public')->put('video', $req->file("video"));
//      $imagename=Storage::disk('public')->put('image', $req->file("thumb"));


      $EducationModel->egitimCode=$req->input("egitimCode");
      $EducationModel->title=$req->input("title");
      $EducationModel->description=$req->input("description");
      $EducationModel->categoryId=$req->input("category");


      $EducationModel->videoTime=$req->input("videoTime");
      $EducationModel->successTime=$req->input("successTime");


      $EducationModel->media=$videoname;
      $EducationModel->thumb="";//$imagename;
      $EducationModel->tamamlanmaTarihi=$bitissuresi." 23:59:00";
      $EducationModel->baslangictarihi=$baslangictarihi." 00:00:00";
      $EducationModel->bitistarihi=$bitistarihi." 23:59:00";

      $EducationModel->teacherName=$req->input("teacherName");
      $EducationModel->egitimKurumu=$req->input("egitimKurumu");

      $EducationModel->educationsfrontexam=$req->input("educationsfrontexam");
      $EducationModel->educationsendexam=$req->input("educationsendexam");
      $EducationModel->educationsforntanket=$req->input("educationsforntanket");
      $EducationModel->educationsendanket=$req->input("educationsendanket");

      $EducationModel->deleted="no";
      $EducationModel->active="yes";
      $EducationModel->save();
      return redirect()->back();

    }


    public function educationFind($id)
    {
      $EducationModel=new \App\EducationModel();
      $data=$EducationModel->find($id);
      $SinavModel=new \App\SinavModel();
      $sinavList=$SinavModel->where("enddate",">=",date("Y-m-d"))->get();

      $PollsModel=new \App\PollsModel();
      $pollsList=$PollsModel->where("enddate",">=",date("Y-m-d"))->get();
      return view("education.education_edit",["data"=>$data,"sinavList"=>$sinavList,"pollsList"=>$pollsList]);
      return $data;
    }

    public function educationUpdate(Request $req)
    {
  //  return $req;

      $arraymodel=array();
      $arraymodel["tamamlanmaTarihi"]=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("bitissuresi"))->format("Y-m-d")." 23:59:00";
      $arraymodel["baslangictarihi"]=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("baslangictarihi"))->format("Y-m-d");
      $arraymodel["bitistarihi"]=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("bitistarihi"))->format("Y-m-d");

      $EducationModel=new \App\EducationModel();

      if (!empty($req->file("video")))
      {
          $videoname=Storage::disk('public')->put('video', $req->file("video"));
          $arraymodel["media"]=$videoname;
      }

      if (!empty($req->file("thumb")))
      {
          $imagename=Storage::disk('public')->put('image', $req->file("thumb"));
          $arraymodel["thumb"]=$videoname;
      }

      $arraymodel["egitimCode"]=$req->input("egitimCode");
      $arraymodel["teacherName"]=$req->input("teacherName");
      $arraymodel["egitimKurumu"]=$req->input("egitimKurumu");
      $arraymodel["title"]=$req->input("title");
      $arraymodel["description"]=$req->input("description");
      $arraymodel["categoryId"]=$req->input("category");

      $arraymodel["videoTime"]=$req->input("videoTime");
      $arraymodel["successTime"]=$req->input("successTime");
      $arraymodel["educationsfrontexam"]=$req->input("educationsfrontexam");
      $arraymodel["educationsendexam"]=$req->input("educationsendexam");
      $arraymodel["educationsforntanket"]=$req->input("educationsforntanket");
      $arraymodel["educationsendanket"]=$req->input("educationsendanket");


      $EducationModel->where("id","=",$req->input("id"))->update($arraymodel);
      return redirect()->back();
    }


    public function educationUserFind($id)
    {
    //  $SatinAlmaModel=new \App\SatinAlmaModel();
      $UserModel=new \App\User();
      $userlist=$UserModel->get();

      $SatinAlmaModel=new \App\SatinAlmaModel();
      $masrafyerilist=$SatinAlmaModel->get();

     $UserAccessEducationModel=new \App\UserAccessEducationModel();
     $userInEducationList = $UserAccessEducationModel->with(["user"])->where("egitimId","=",$id)->get();

      return view("education.education_user",["userlist"=>$userlist,"masrafyerilist"=>$masrafyerilist,"egitimid"=>$id,"userInEducationList"=>$userInEducationList]);
    }

    public function educationUserUpdate(Request $req)
    {
       $UserAccessEducationModel=new \App\UserAccessEducationModel();
       $arrayModel=array();

        $now=date("Y-m-d H:i:s");
         foreach ($req->input("user") as $key => $value)
         {
            $arrayModel[$key]["userId"]=$value;
            $arrayModel[$key]["egitimId"]=$req->input("egitimid");
            $arrayModel[$key]["permissionType"]="video";
            $arrayModel[$key]["created_at"]=$now;
            $arrayModel[$key]["updated_at"]=$now;
         }

         $UserAccessEducationModel->where("egitimId","=",$req->input("egitimid"))->delete();
         $UserAccessEducationModel->insert($arrayModel);

         $UserSuccessEducationModel=new \App\UserSuccessEducationModel();

         $forarrayeducation=array();
         foreach ($req->input("user") as $key => $value)
         {
            $forarrayeducation[$key]["userId"]=$value;
            $forarrayeducation[$key]["educationId"]=$req->input("egitimid");
            $forarrayeducation[$key]["educationTime"]="00:00:00";
            $forarrayeducation[$key]["isSuccess"]="no";
            $forarrayeducation[$key]["created_at"]=$now;
            $forarrayeducation[$key]["updated_at"]=$now;
         }

         $UserSuccessEducationModel->where("educationId","=",$req->input("egitimid"))->delete();
         $UserSuccessEducationModel->insert($forarrayeducation);

         return redirect()->back();
    }

    public function educationList(Request $req)
    {
       $UserAccessEducationModel=new \App\UserAccessEducationModel();

       $db=DB::select("SELECT * FROM `educationToUser` as eu,educationLog as el WHERE eu.`egitimId`=el.educationId and eu.userId=el.userId and el.userId='".\Auth::user()->id."'  ");

       $arrayEducationIn=array();

      foreach ($db as $key => $value)
      {
        if ($value->isSuccess!="yes")
        {
          $arrayEducationIn[]=$value->educationId;
        }
      }

      $teacherName="";
      $egitimTitle="";
      $egitimCode="";
      if (!empty($req->input('egitimCode'))) { $egitimCode=$req->input('egitimCode');}
      if (!empty($req->input('egitimTitle'))) { $egitimTitle=$req->input('egitimTitle'); }
      if (!empty($req->input('teacherName'))) { $teacherName=$req->input('teacherName');}


       $list=$UserAccessEducationModel->with(["educationDevam"=> function($q) use($req) {
           if (!empty($req->input('egitimCode'))) { $q=$q->where("egitimCode",'like','%'.$req->input('egitimCode').'%');}
           if (!empty($req->input('egitimTitle'))) {$q=$q->where("title",'like','%'.$req->input('egitimTitle').'%');}
           if (!empty($req->input('teacherName'))) { $q=$q->where("teacherName",'like','%'.$req->input('teacherName').'%');}
           $q=$q->where("tamamlanmaTarihi",">=",DB::raw("NOW()"));
       }])->has('educationdevam', '>' , 0)->where("userId","=",\Auth::user()->id)->whereIn("egitimId",$arrayEducationIn)->get();

    //   return $list;

       return view("education.user_education_list",["list"=>$list,"egitimCode"=>$egitimCode,"egitimTitle"=>$egitimTitle,"teacherName"=>$teacherName]);
    }


    public function educationTimerList(Request $req)
    {
       $UserAccessEducationModel=new \App\UserAccessEducationModel();

       $db=DB::select("SELECT * FROM `educationToUser` as eu,educationLog as el WHERE eu.`egitimId`=el.educationId and eu.userId=el.userId and el.userId='".\Auth::user()->id."'  ");
       $arrayEducationIn=array();

      foreach ($db as $key => $value)
      {
        if ($value->isSuccess!="yes")
        {
          $arrayEducationIn[]=$value->educationId;
        }
      }

      $teacherName="";
      $egitimTitle="";
      $egitimCode="";
      if (!empty($req->input('egitimCode'))) { $egitimCode=$req->input('egitimCode');}
      if (!empty($req->input('egitimTitle'))) { $egitimTitle=$req->input('egitimTitle'); }
      if (!empty($req->input('teacherName'))) { $teacherName=$req->input('teacherName');}


       $list=$UserAccessEducationModel->with(["educationBiten"=> function($q) use($req) {
           if (!empty($req->input('egitimCode'))) { $q=$q->where("egitimCode",'like','%'.$req->input('egitimCode').'%');}
           if (!empty($req->input('egitimTitle'))) {$q=$q->where("title",'like','%'.$req->input('egitimTitle').'%');}
           if (!empty($req->input('teacherName'))) { $q=$q->where("teacherName",'like','%'.$req->input('teacherName').'%');}
       }])->has('educationbiten', '>' , 0)->where("userId","=",\Auth::user()->id)->whereIn("egitimId",$arrayEducationIn)->get();


//       return $list;
       return view("education.user_education_list",["list"=>$list,"egitimCode"=>$egitimCode,"egitimTitle"=>$egitimTitle,"teacherName"=>$teacherName]);
    }


    public function educationDoneList(Request $req)
    {
       $UserAccessEducationModel=new \App\UserAccessEducationModel();


       $db=DB::select("SELECT * FROM `educationToUser` as eu,educationLog as el WHERE eu.`egitimId`=el.educationId and eu.userId=el.userId and el.userId='".\Auth::user()->id."'  ");
       $arrayEducationIn=array();

      foreach ($db as $key => $value)
      {
        if ($value->isSuccess=="yes")
        {
          $arrayEducationIn[]=$value->educationId;
        }
      }

      $teacherName="";
      $egitimTitle="";
      $egitimCode="";
      if (!empty($req->input('egitimCode'))) { $egitimCode=$req->input('egitimCode');}
      if (!empty($req->input('egitimTitle'))) { $egitimTitle=$req->input('egitimTitle'); }
      if (!empty($req->input('teacherName'))) { $teacherName=$req->input('teacherName');}

       $list=$UserAccessEducationModel->with(["education"=> function($q) use($req){
           if (!empty($req->input('egitimCode'))) { $q=$q->where("egitimCode",'like','%'.$req->input('egitimCode').'%');}
           if (!empty($req->input('egitimTitle'))) {$q=$q->where("title",'like','%'.$req->input('egitimTitle').'%');}
           if (!empty($req->input('teacherName'))) { $q=$q->where("teacherName",'like','%'.$req->input('teacherName').'%');}

       },])->where("userId","=",\Auth::user()->id)->whereIn("egitimId",$arrayEducationIn)->get();//get();




       return view("education.user_done_education_list",["list"=>$list,"egitimCode"=>$egitimCode,"egitimTitle"=>$egitimTitle,"teacherName"=>$teacherName]);
    }

    public function educationWatch($id)
    {
      $EducationModel=new \App\EducationModel();



      $finddata=$EducationModel->find($id);

      return view("education.watch",["educationData"=>$finddata]);
    }
    public function saveEducationTime(Request $req)
    {

      $userid=$req->input("u_id");
      $videoid=$req->input("v_id");
      $time=$req->input("time");

      $UserSuccessEducationModel=new \App\UserSuccessEducationModel();
      $hours = floor($time / 3600);
      $mins = floor($time / 60 % 60);
      $secs = floor($time % 60);
      $timeformat=$hours.":".$mins.":".$secs;

      $educationModel=new \App\EducationModel;
      $edudata=$educationModel->find($videoid);

      $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $edudata->successTime);
      sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
      $hiperx = $hours * 3600 + $minutes * 60 + $seconds;

      $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $edudata->videoTime);
      sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
      $alltime = $hours * 3600 + $minutes * 60 + $seconds;


      $data=$UserSuccessEducationModel->where("userId","=",$userid)->where("educationId","=",$videoid)->first();
      if (empty($data))
      {
        $UserSuccessEducationModel->userId=$userid;
        $UserSuccessEducationModel->educationId=$videoid;
        $UserSuccessEducationModel->educationTime=$timeformat;
        $UserSuccessEducationModel->isSuccess ="no";
        $UserSuccessEducationModel->save();
      }else {

        if ($data->isSuccess=="no")
        {
          if ($time>$hiperx) {$updatearray['isSuccess']='yes';}
          $updatearray["educationTime"]=$timeformat;
          $UserSuccessEducationModel->where("id","=",$data->id)->update($updatearray);
        }else {
          if ($time>$hiperx)
          {
                $updatearray["educationTime"]=$timeformat;
                $UserSuccessEducationModel->where("id","=",$data->id)->update($updatearray);
          }
        }
      }
      $lastdata=$UserSuccessEducationModel->where("userId","=",$userid)->where("educationId","=",$videoid)->first();
      $videoaktifizlenme['sure']=$lastdata->educationTime;
      $videoaktifizlenme['success']=$lastdata->isSuccess;
      if ($lastdata->isSuccess=="yes")
      {
        $timerx=strtotime($lastdata->educationTime) - strtotime('TODAY');
        $videoaktifizlenme['oran']=round(($timerx/$alltime)*100);
      }else {
        $videoaktifizlenme['oran']=round(($time/$alltime)*100);
      }


      return $videoaktifizlenme;
    }


    public function educationContinueStatus(Request $req)
    {
      $EducationModel=new \App\EducationModel();
      $teacherName="";
      $egitimTitle="";
      $egitimCode="";
      if (!empty($req->input('egitimCode'))) { $egitimCode=$req->input('egitimCode'); $EducationModel=$EducationModel->where("egitimCode",'like','%'.$egitimCode.'%');}
      if (!empty($req->input('egitimTitle'))) { $egitimTitle=$req->input('egitimTitle'); $EducationModel=$EducationModel->where("title",'like','%'.$egitimTitle.'%');}
      if (!empty($req->input('teacherName'))) { $teacherName=$req->input('teacherName'); $EducationModel=$EducationModel->where("teacherName",'like','%'.$teacherName.'%');}

      $alleducationlist=$EducationModel->where("tamamlanmaTarihi",">",DB::raw("NOW()"))->get();
      return view("education.all_education_list",["list"=>$alleducationlist,"typer"=>"continue","egitimCode"=>$egitimCode,"egitimTitle"=>$egitimTitle,"teacherName"=>$teacherName]);

      return $alleducationlist;
      return "gogo";
    }

    public function educationStatusForAllUser($id)
    {
      $UserSuccessEducationModel=new \App\UserSuccessEducationModel();
      $data=$UserSuccessEducationModel->with(["user","education"])->where("educationId","=",$id)->get();

      return view("education.education_user_info",["list"=>$data]);
      return $data;
    }

    public function educationDoneStatus(Request $req)
    {
      $EducationModel=new \App\EducationModel();
      $teacherName="";
      $egitimTitle="";
      $egitimCode="";
      if (!empty($req->input('egitimCode'))) { $egitimCode=$req->input('egitimCode'); $EducationModel=$EducationModel->where("egitimCode",'like','%'.$egitimCode.'%');}
      if (!empty($req->input('egitimTitle'))) { $egitimTitle=$req->input('egitimTitle'); $EducationModel=$EducationModel->where("title",'like','%'.$egitimTitle.'%');}
      if (!empty($req->input('teacherName'))) { $teacherName=$req->input('teacherName'); $EducationModel=$EducationModel->where("teacherName",'like','%'.$teacherName.'%');}
      $alleducationlist=$EducationModel->where("tamamlanmaTarihi","<",DB::raw("NOW()"))->get();
      return view("education.all_education_list",["list"=>$alleducationlist,"typer"=>"done","egitimCode"=>$egitimCode,"egitimTitle"=>$egitimTitle,"teacherName"=>$teacherName]);
    }



}
