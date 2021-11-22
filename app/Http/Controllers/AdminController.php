<?php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\EducationModel;
use App\EducationCategoriesModel;
use App\UserAccessEducationModel;
use App\ExamModel;
use App\QuestionModel;
use App\UserAnswerModel;
use App\AnswerModel;
use App\TitlesModel;
use App\GroupModel;
use App\ProductsModel;
use App\SatinAlmaModel;


use App\Mail\MailForAction;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {

    //  $this->checkAdmin();

  }


  public function checkAdmin()
  {
    if (\Auth::check() && \Auth::user()->role!="admin")
    {
        return redirect("/");
    }

  }

  public function index()
  {
    return view('admin.index');
  }


    public function userdelete($id)
    {
      $userModel=new \App\User();
      $userModel->where("id","=",$id)->update(["deleted"=>"yes"]);
      return redirect()->back();
    }

  public function userlist(Request $req)
  {

    $isim="";
    $kurum="";
    $brans="";
    $email="";
    $usercode="";
    $companyList = DB::table("companies")->get();
    $userModel=new \App\User();
    $TitlesModel=new TitlesModel;
    $alltitle=  $TitlesModel->get();


    $GroupModel=new GroupModel;
    $allGroups=  $GroupModel->get();

    if (!empty($req->input('isim'))) { $isim=$req->input('isim'); $userModel=$userModel->where("name",'like','%'.$isim.'%');}
    if (!empty($req->input('email'))) { $email=$req->input('email'); $userModel=$userModel->where("email",'like','%'.$email.'%');}
    if (!empty($req->input('usercode'))) { $usercode=$req->input('usercode'); $userModel=$userModel->where("usercode",'like','%'.$usercode.'%');}

    $userlist=$userModel->orderBy("created_at","DESC")->paginate(50);
    return view("admin.user.list",['user'=>$userlist,'isim'=>$isim,'usercode'=>$usercode,"email"=>$email,"companyList"=>$companyList,"alltitle"=>$alltitle,"allGroups"=>$allGroups]);
  }

  public function userregister()
  {

      $companyList = DB::table("companies")->get();
      return view("admin.user.register",["companyList"=>$companyList]);
      return redirect()->back();
  }


  public function useredit($id)
  {
    $userModel=new \App\User();
    $user=$userModel->find($id);
    $companyList = DB::table("companies")->get();
    $SatinAlmaModel=new SatinAlmaModel();

    $TitlesModel=new TitlesModel;
    $alltitle=$TitlesModel->get();
    $GroupModel=new GroupModel;
    $allGroups=$GroupModel->get();

//    $masrafyerlerilistesi=$tumSatinAlmaModel->where("parentId","=",0)->with(['altmanydata'])->get();

    //$masterId=$SatinAlmaModel->where("masterUserId","=",$id)->first();
    //$masterXid=0;
    //if (!empty($masterId->id)) {$masterXid=$masterId->id;}


    return view("admin.user.edit",['user'=>$user,"companyList"=>$companyList,"alltitle"=>$alltitle,"allGroups"=>$allGroups]);

  }

  public function userupdate(Request $req)
  {



    $id=$req->input("id");

    $array["name"]=$req->input("name");
    $array["email"]=$req->input("email");
    $array["usercode"]=$req->input("slug");
    $array["companyId"]=$req->input("companyCode");
    $array["gorevtanimi"]=$req->input("gorevtanimi");
    $array["groupId"]=$req->input("groupid");
    $array["telefon"]=$req->input("telefon");
    $array["masrafYeri"]=$req->input("parentId");

    $tumSatinAlmaModel=new SatinAlmaModel();

  //  $tumSatinAlmaModel->where("masterUserId","=",$id)->update(["masterUserId"=>0]);
  //  $tumSatinAlmaModel->where("id","=",$masrafyeri)->update(["masterUserId"=>$id]);

    $userModel=new \App\User();
    $userModel->where("id","=",$id)->update($array);
    return redirect()->back();
    return view("admin.success",["message"=>"Kullanıcı Düzenlendi."]);

  }


  public function usersave(Request $req)
  {
    $userModel=new \App\User();
    $data = $userModel->where("usercode","=",$req->input("slug"))->first();
    if (!empty($data)) {    return view("admin.success",["message"=>"Kullanıcı Kodu Kullanılmış. Lütfen Tekrar Deneyiniz."]);}

    $userModel->name=$req->input("name");
    $userModel->email=$req->input("email");
    $userModel->usercode=$req->input("slug");

    $userModel->companyId=$req->input("companyCode");

    $userModel->gorevtanimi=$req->input("gorevtanimi");
    $userModel->groupId=$req->input("groupid");

    $userModel->role="user";

    $userModel->telefon=$req->input("telefon");
    $userModel->groupYetki="";
    $userModel->deleted="no";
    $userModel->password=bcrypt($req->input("password"));
    $userModel->save();

  //$view = (string) \View::make('email.kullanici_kayit',["passw"=>$req->input("password"),"user"=>$userModel]);
//    $returnredirectpage="/admin/user/list";
    return redirect()->back();
    return view("admin.success",["message"=>"Kullanıcı Kaydedildi.",'redirect'=>$returnredirectpage]);
    return $req;
  }



  public function educationcategorylist()
  {

    $findCategory=new EducationCategoriesModel;

    $categoryList=$findCategory->get();

    return view("admin.education.category_list",['list'=>$categoryList]);
  }


  public function educationcategorynew()
  {
    return view("admin.education.category_new");
  }

  public function educationcategorysave(Request $req)
  {
      $modelCategory=new EducationCategoriesModel;
      $modelCategory->title=$req->input("title");
      $modelCategory->description=$req->input("description");
      $modelCategory->save();
      return view("admin.success",["message"=>"Kategori Kaydedildi. Kullanıcılarınızı kategoriye aktarmayı unutmayın"]);
  }


  public function educationcategoryedit($id)
  {
    $modelCategory=new EducationCategoriesModel();
    $model=$modelCategory->find($id);
    return view("admin.education.category_edit",['data'=>$model]);

  }


  public function educationcategoryupdate(Request $req)
  {
    $modelCategory=new EducationCategoriesModel();
    $id=$req->input("id");
    $category["title"]=$req->input("title");
    $category["description"]=$req->input("description");

    $modelCategory->where("id","=",$id)->update($category);
    return view("admin.success",["message"=>"Kategori Güncellendi."]);
  }


  public function educationvideonew()
  {
    $modelCategory=new EducationCategoriesModel();
    $list=$modelCategory->get();

    return view("admin.video.video_add",["category"=>$list]);
  }


  public function educationvideolist()
  {
    $educationModel=new EducationModel;
    $data=$educationModel->with(["category"])->get();
    //return $data;
    return view("admin.video.video_index",["list"=>$data]);
  }


  public function educationvideosave(Request $req)
  {
    //return $req;
      // bunu okuyan tosun kodlamacı sana kosun hahhaha
      $educationOrder=1;
      $educationModel=new EducationModel;
      $educat=$educationModel->select("educationOrder")->where("categoryId","=",$req->input("categoryId"))->orderBy("educationOrder","DESC")->first();

      if (!empty($educat->educationOrder))
      {
        $educationOrder=intval($educat->educationOrder+1);
      }


      $videoname=Storage::disk('public')->put('video', $req->file("video"));
      $imagename=Storage::disk('public')->put('image', $req->file("thumb"));

      $modelCategory=new EducationCategoriesModel;
      $educationModel->title=$req->input("title");
      $educationModel->description=$req->input("description");


     $educationModel->media=$videoname;
     $educationModel->mediaType="video";
     $educationModel->thumb=$imagename;
     $educationModel->educationOrder=$educationOrder; //
     $educationModel->accessType="ordered";
     $educationModel->successType="videotime";
     $educationModel->successTime=$req->input("successTime");
     $educationModel->deleted="no";
     $educationModel->active="yes";
     $educationModel->maxtry=$req->input("maximumtry");
      $educationModel->categoryId=$req->input("categoryId");



     $educationModel->save();

     $kategoriid=$req->input("categoryId");

     $UserAccessEducationModel=new UserAccessEducationModel();
     $userlist=$UserAccessEducationModel->where("categoryId","=",$kategoriid)->get();
     $userModel=new \App\User();

     foreach ($userlist as $key => $value)
     {
       $user=$userModel->find($value->userId);
       $view = (string) \View::make('email.yenivideo',["user"=>$user]);
       \Mail::to($req->input("email"))->bcc("mehmetk@turkiyeklinikleri.com")->send(new MailForAction("Yeni Video Eklendi",$view));
     }


      return view("admin.success",["message"=>"Video Kaydedildi. Tüm sistem kullanıcılarına mail gönderildi"]);
  }


  public function educationvideoedit($id)
  {

    $educationModel=new EducationModel;
    $model=$educationModel->find($id);
    $modelCategory=new EducationCategoriesModel();
    $list=$modelCategory->get();

    return view("admin.video.video_edit",['data'=>$model,"category"=>$list]);

  }


  public function educationvideoupdate(Request $req)
  {

    $EducationModel=new EducationModel();
    $id=$req->input("id");

    $model["title"]=$req->input("title");
    $model["description"]=$req->input("description");
    $model["categoryId"]=$req->input("categoryId");
    $model["successTime"]=$req->input("successTime");
    $model["maxtry"]=$req->input("maximumtry");


    if (!empty($req->file("video")))
    {
      $model["media"]=Storage::disk('public')->put('video/', $req->file("video"));
    }

    if (!empty($req->file("thumb")))
    {
      $model["thumb"]=Storage::disk('public')->put('image/', $req->file("thumb"));
    }

    $EducationModel->where("id","=",$id)->update($model);
    return view("admin.success",["message"=>"Video Güncellendi."]);
  }

  public function examlist()
  {
    $educationModel=new ExamModel();
    $data=$educationModel->with(["exam"])->withCount(["questions"])->get();

    return view("admin.exam.exam_list",["list"=>$data]);
    return $data;
  }


  public function examnew()
  {
    //  $modelCategory=new EducationCategoriesModel();
    //  $list=$modelCategory->get();

      $educationModel=new \App\EducationModel;
      $list=$educationModel->get();

      return view("admin.exam.exam_new",["category"=>$list]);
  }

  public function examsave(Request $req)
  {
        $educationModel=new ExamModel();
        $educationModel->title=$req->input("title");
        $educationModel->description=$req->input("description");
        $educationModel->successRate=$req->input("successRate");
        $educationModel->educationCategory=$req->input("categoryId");
        $educationModel->maximumTime=$req->input("maximumTime");
        $educationModel->maxTry =$req->input("maxTry");
        $educationModel->sira=$req->input("sira");
        $educationModel->save();
        return redirect('/admin/sinav/list');

  }

  public function editexam($id)
  {
    $educationModel=new ExamModel();
    $alldata = $educationModel->find($id);
    $educationModel=new \App\EducationModel;
    $list=$educationModel->get();
    return view("admin.exam.exam_edit",["category"=>$list,"data"=>$alldata]);

  }

  public function examupdate(Request $req)
  {
    $model=new ExamModel();
    $id=$req->input("id");
    $educationModel["title"]=$req->input("title");
    $educationModel["description"]=$req->input("description");
    $educationModel["successRate"]=$req->input("successRate");
    $educationModel["educationCategory"]=$req->input("categoryId");
    $educationModel["maximumTime"]=$req->input("maximumTime");
    $educationModel["maxTry"]=$req->input("maxTry");
    $educationModel["sira"]=$req->input("sira");
    $model->where('id',"=",$id)->update($educationModel);
    return redirect("/admin/sinav/list");

  }

  public function questionlist($id)
  {
    $questionModel=new QuestionModel();
    $data=$questionModel->with(["questions"])->where("examId","=",$id)->get();
    return view("admin.exam.question_list",["list"=>$data,"id"=>$id]);
  }

  public function questionnew($id)
  {
    $modelCategory=new ExamModel();
    $soruKategori=$modelCategory->with(["category"])->find($id);

  //  return $soruKategori;
    return view("admin.exam.new_question",["id"=>$id,"category"=>$soruKategori]);
  }

  public function setUserCategory($id)
  {
    $userModel=new \App\User();
    $userInf=$userModel->find($id);
    $modelCategory=new EducationCategoriesModel();
    $categoryList=$modelCategory->get();


    return view("admin.user.setcategory",["userInf"=>$userInf,"categoryList"=>$categoryList]);
    return $id;
  }

  public  function saveCategoryUser(Request $req)
  {

    $UserAccessEducationModel=new UserAccessEducationModel();
    $data=$UserAccessEducationModel->where("userId","=",$req->input("userid"))->first();
    if (!empty($data))
    {
      $UserAccessEducationModel->where("id","=",$data->id)->delete();
    }

    $UserAccessEducationModel->userId=$req->input("userid");
    $UserAccessEducationModel->categoryId=$req->input("kategoriid");
    $UserAccessEducationModel->videoId=0;
    $UserAccessEducationModel->permissionType="category";
    $UserAccessEducationModel->save();

    $userModel=new \App\User();
    $user=$userModel->find($req->input("userid"));
    $view = (string) \View::make('email.kullanici_videoatama',["user"=>$user]);

    return redirect("/admin/user/list");

  }

  public function questionadd(Request $req)
  {
      $questionModel=new QuestionModel();
      $questionModel->question=$req->input("title");
      $questionModel->description=$req->input("description");
      $questionModel->examId=$req->input("soruCategoryId");
      $questionModel->deleted="no";
      $questionModel->save();
      $id=$questionModel->id;

      $answers=$req->input("answer");
      $puan=$req->input("puan");
      $correct=$req->input("isCorrect");
      $hiperarray=array();
      $now = \Carbon\Carbon::now('utc')->toDateTimeString();

      foreach ($answers as $key => $value)
      {
            $hiperarray[$key]["answer"]=$answers[$key];
            $hiperarray[$key]["puan"]=$puan[$key];
            $hiperarray[$key]["iscorrect"]=$correct[$key];
            $hiperarray[$key]["questionid"]=$id;
            $hiperarray[$key]["created_at"]=$now;
            $hiperarray[$key]["updated_at"]=$now;
      }

      $AnswerModel=new AnswerModel();
      $AnswerModel->insert($hiperarray);

      return redirect("/admin/sinav/questions/list/".$id);
  }

  public function questionedit($id)
  {
    $questionModel=new QuestionModel();
    $data = $questionModel->with(["answers"])->find($id);

    return view("admin.exam.edit_question",["data"=>$data]);
  }

  public function questionupdate(Request $req)
  {
      $questionModel=new QuestionModel();
      $array['question']=$req->input("title");
      $array['description']=$req->input("description");
      $questionModel->where("id","=",$req->input("id"))->update($array);
      $AnswerModel=new AnswerModel();
      $AnswerModel->where("questionid","=",$req->input("id"))->delete();


      $answers=$req->input("answer");
      $puan=$req->input("puan");
      $correct=$req->input("isCorrect");

      $hiperarray=array();
      $now = \Carbon\Carbon::now('utc')->toDateTimeString();
      foreach ($answers as $key => $value)
      {
            $hiperarray[$key]["answer"]=$answers[$key];
            $hiperarray[$key]["puan"]=$puan[$key];
            $hiperarray[$key]["iscorrect"]=$correct[$key];
            $hiperarray[$key]["questionid"]=$req->input("id");
            $hiperarray[$key]["created_at"]=$now;
            $hiperarray[$key]["updated_at"]=$now;
      }


      $AnswerModel->insert($hiperarray);

      return redirect("/admin/sinav/list");
  }

  public function durumlisteleri()
  {
        $userModel=new \App\User();
        $userlist=$userModel->get();//where("role","=","user")->get();
        $userlistDurum=array();
        foreach ($userlist as $key => $value)
        {
          $userlistDurum[$key]["isim"]=$value->name;
          $userlistDurum[$key]["email"]=$value->email;
          $userlistDurum[$key]["id"]=$value->id;
          $userlistDurum[$key]["durum"]=true;
          $littleuserkategori=\Helper::findUserCategory($value->id);

          if (!empty($littleuserkategori->category))
          {
            $userlistDurum[$key]["atanmiskategori"]=$littleuserkategori->category->title;

            $userAccessToLogin=new UserAccessEducationModel;
            $userId=$value->id;

            $listofeducation=$userAccessToLogin->where("userId","=",$userId)->get();
            foreach ($listofeducation as $zalm => $zaluem)
            {

                  $findCategory=new EducationCategoriesModel;
                  $subvideoData=$findCategory->with(["education"])->where("id","=",$zaluem->categoryId)->first();
                //  return $subvideoData;
                  if (empty($subvideoData->education) || $subvideoData->education->count()<1)
                  {
                    $userlistDurum[$key]["videoseyretme"]="Kategoride video bulunmamaktadır.";

                    $userlistDurum[$key]["sinav"]="Kategoride video bulunmamaktadır.";
                    $userlistDurum[$key]["durum"]=false;

                  }
                  else {
                      $access="Tüm Videolar Seyredilmiş";
                      foreach ($subvideoData->education as $t => $my)
                      {
                        $axess=\Helper::isSuccessEducationVideo($my->id);
                        if ($axess["success"]==false)
                        {
                          $access="Seyredilmeyen Videolar Var";
                          $userlistDurum[$key]["durum"]=false;
                         }

                      }
                        $userlistDurum[$key]["videoseyretme"]=$access;

                        if ($userlistDurum[$key]["durum"]==true)
                        {


                          $newAction=new UserAnswerModel();
                          $educationModel=new ExamModel();
                          $xdata=$educationModel->with(["category"])->withCount(["questions"])->find($zaluem->categoryId);
                          $total=$xdata->questions_count;
                          if ($total > 10)  {$total=10;}
                          $allanswers=$newAction->where("userid","=",$userId)->get();

                          $countforsuccess=0;
                          foreach ($allanswers as $tara => $vara)
                          {
                            if ($vara->status=="correct")
                            {
                              $countforsuccess++;
                            }
                          }
                          if ($total==0) {$total=1;}
                          $successRate = Round(($countforsuccess/$total)*100) ;
                          if ($successRate<70)
                          {
                            $userlistDurum[$key]["durum"]=false;
                            $userlistDurum[$key]["sinav"]="Sınav Başarısız";
                          }else {
                            $userlistDurum[$key]["sinav"]="Sınav Başarılı / %".$successRate." Doğru Cevap Sayısı";
                          }


                      }else {
                          $userlistDurum[$key]["durum"]=false;
                          $userlistDurum[$key]["sinav"]="Video Listesi Seyredilmemiş";
                      }


                  }


            }

          }else {
            $userlistDurum[$key]["atanmiskategori"]="Atanmamış";
            $userlistDurum[$key]["videoseyretme"]="Kategori Atanmamış";
            $userlistDurum[$key]["sinav"]="Kategori Atanmamış";
            $userlistDurum[$key]["durum"]=false;
          }

        }

        return view("admin.durum.durum",["list"=>$userlistDurum]);

  }

  public function emailYolla($type,$id)
  {

      $userModel=new \App\User();
      $user= $userModel->find($id);
      switch ($type) {
        case 'yenivideo':
          $view = (string) \View::make('email.yenivideo',["user"=>$user]);
          $konu =  "Yeni Bir Video Eklendi";
        break;
        case 'sinavagir':
          $view = (string) \View::make('email.sinavagir',["user"=>$user]);
          $konu =  "Sınava Giriş Hakkınız Bulunmaktadır.";
        break;
        case 'sinavbelgesi':
          $konu =  "Katılım ve Başarı Formunuuz";
          $view = (string) \View::make('email.sinavbelgesi',["user"=>$user]);
        break;
      }

      return view("messages",["message"=>"Mail Kullanıcıya Gönderildi"]);
  }



  public function groupList()
  {
    $TitlesModel=new GroupModel();
    $list = $TitlesModel->paginate(50);
    return view("admin.group.list",["list"=>$list]);
  }

  public function groupAdd()
  {
    $list=DB::table("companies")->get();
    return view("admin.group.add",["list"=>$list]);
  }

  public function groupSave(Request $req)
  {
     $TitlesModel=new GroupModel();
     $TitlesModel->title=$req->input("title");
     $TitlesModel->companyId=$req->input("companyId");
     $TitlesModel->description=$req->input("description");
     $TitlesModel->save();
     return redirect()->back();
    return view("messages",["message"=>"Kullanıcı Grup Tanımı Sisteme Kaydedildi."]);
  }


    public function groupEdit($id)
    {
      $list=DB::table("companies")->get();
      $TitlesModel=new GroupModel();
      $data=$TitlesModel->find($id);
      return view("admin.group.edit",["data"=>$data,"list"=>$list]);
    }

    public function groupUpdate(Request $req)
    {
      $TitlesModel=new GroupModel();
      $Titles["title"]=$req->input("title");
      $Titles["companyId"]=$req->input("companyId");
      $Titles["description"]=$req->input("description");
      $id=$req->input("id");
      $TitlesModel->where("id","=",$id)->update($Titles);
       return redirect()->back();
      return view("messages",["message"=>"Kullanıcı Grup Tanımı Sistemde Güncellendi."]);
    }

    public function groupDelete($id)
    {
      $TitlesModel=new GroupModel();
      $TitlesModel->where("id","=",$id)->update(["deleted"=>"yes"]);
     return redirect()->back();
      return view("messages",["message"=>"Kullanıcı Grup Tanımı Sistemden Silindi."]);
    }


/**********************************************************************************************************************/


  public function titlesList()
  {
    $TitlesModel=new TitlesModel();
    $list = $TitlesModel->get();
    return view("admin.titles.list",["list"=>$list]);
  }

  public function titlesAdd()
  {
    $list=DB::table("companies")->get();
    return view("admin.titles.add",["list"=>$list]);
  }

  public function titleSave(Request $req)
  {

     $TitlesModel=new TitlesModel();
     $TitlesModel->title=$req->input("title");
     $TitlesModel->companyId=$req->input("companyId");
     $TitlesModel->description=$req->input("description");
     $TitlesModel->save();
     return redirect()->back();
    return view("messages",["message"=>"Kullanıcı Görev Tanımı Sisteme Kaydedildi."]);
  }


    public function titlesEdit($id)
    {
      $list=DB::table("companies")->get();
      $TitlesModel=new TitlesModel();
      $data=$TitlesModel->find($id);
      return view("admin.titles.edit",["data"=>$data,"list"=>$list]);
    }

    public function titleUpdate(Request $req)
    {
      $TitlesModel=new TitlesModel();
      $Titles["title"]=$req->input("title");
      $Titles["companyId"]=$req->input("companyId");
      $Titles["description"]=$req->input("description");
      $id=$req->input("id");
      $TitlesModel->where("id","=",$id)->update($Titles);
       return redirect()->back();
      return view("messages",["message"=>"Kullanıcı Görev Tanımı Sistemde Güncellendi."]);
    }

    public function titleDelete($id)
    {
      $TitlesModel=new TitlesModel();
      $TitlesModel->where("id","=",$id)->update(["deleted"=>"yes"]);
     return redirect()->back();
      return view("messages",["message"=>"Kullanıcı Görev Tanımı Sistemden Silindi."]);
    }



    public function masrafyeriatama(Request $req)
    {
      $companyList = DB::table("companies")->get();
      $isim="";
      $kurum="";
      $brans="";
      $email="";
      $userModel=new \App\User();
      if (!empty($req->input('isim'))) { $isim=$req->input('isim'); $userModel=$userModel->where("name",'like','%'.$isim.'%');}
      if (!empty($req->input('email'))) { $email=$req->input('email'); $userModel=$userModel->where("email",'like','%'.$email.'%');}
      if (!empty($req->input('usercode'))) { $usercode=$req->input('usercode'); $userModel=$userModel->where("usercode",'like','%'.$usercode.'%');}

      $userlist=$userModel->orderBy("created_at","DESC")->paginate(50);
      //return $userlist;
      return view("admin.user.masrafyeriatama",["companyList"=>$companyList,'user'=>$userlist]);
    }

    public function masrafyeriatamasave(Request $req)
    {

        $userid=$req->input("userid");
        $masrafyeri=$req->input("parentId");
        $userModel=new \App\User();
        $userModel->where("id","=",$userid)->update(["masrafYeri"=>$masrafyeri]);
        return redirect()->back();

        return view("messages",["message"=>"Masraf Yeri Ataması Yapıldı"]);
    }

    public function findIlce($id)
    {
      $sehir=DB::table("ilce")->where("ilce_sehirkey","=",$id)->get();
      return view("ilceler",["ilce"=>$sehir]);
      return $sehir;

    }

    public function sektorlist()
    {
        $SektorModel=new \App\SektorModel();
        $list=$SektorModel->paginate(40);
        return view("sektor.list",["list"=>$list]);
    }

    public function sektorsave(Request $req)
    {
        $SektorModel=new \App\SektorModel();
        $SektorModel->code=$req->input("birimKodu");
        $SektorModel->title=$req->input("malzemeAciklamasi");
        $SektorModel->deleted="no";
        $SektorModel->save();
        return redirect()->back();
    }

    public function sektordelete($id)
    {

        $SektorModel=new \App\SektorModel();
        $SektorModel->where("id","=",$id)->update(["deleted"=>"yes"]);
        return redirect()->back();
    }


    public function sektoredit($id)
    {

        $SektorModel=new \App\SektorModel();
        $data=$SektorModel->find($id);
        return view("sektor.edit",["data"=>$data]);
        return $type;
    }

    public function sektorupdate(Request $req)
    {
      $SektorModel=new \App\SektorModel();
      $id=$req->input("id");
      $model["code"]=$req->input("birimKodu");
      $model["title"]=$req->input("malzemeAciklamasi");
      $SektorModel->where("id","=",$id)->update($model);

      return redirect()->back();
    }
}
