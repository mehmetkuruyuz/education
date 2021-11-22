<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\SinavTypeModel;

class SinavController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index($type,Request $req)
    {

      $PollsModel=new \App\SinavModel();
      $categoryname="";
      if (!empty($req->input('categoryname'))) { $categoryname=$req->input('categoryname'); $PollsModel=$PollsModel->where("title",'like','%'.$categoryname.'%');}
      $list=$PollsModel->where("polltype","=",$type)->get();

      return view("sinav.poll_list",["list"=>$list,"polltype"=>$type,"categoryname"=>$categoryname]);
    }


    public function savePoll(Request $req)
    {

      $bitissuresi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("bitissuresi"))->format("Y-m-d");
      $baslangicsuresi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("baslangicsuresi"))->format("Y-m-d");

      $PollsModel=new \App\SinavModel();
      $PollsModel->anketCode=$req->input("anketCode");
      $PollsModel->title=$req->input("title");
      $PollsModel->description=$req->input("description");
      $PollsModel->polltype=$req->input("type");
      $PollsModel->startdate=$baslangicsuresi;
      $PollsModel->enddate=$bitissuresi;
      $PollsModel->MakerId=\Auth::user()->id;
      $PollsModel->deleted="no";
      $PollsModel->save();
      return redirect()->back();
      return $req;
    }


    public function deletePoll($id)
    {
        $PollsModel=new \App\SinavModel();
        $PollsModel->where("id","=",$id)->update(["deleted"=>"yes"]);
        return redirect()->back();
    }

    public function editPoll($id)
    {
        $PollsModel=new \App\SinavModel();
        $data=$PollsModel->find($id);
        return view("sinav.poll_edit",["data"=>$data]);
    }


    public function addNewQuestion($id)
    {
        $Poll=$PollsModel=new \App\SinavModel();
        $bilgi=$PollsModel->find($id);
        $PollQuestionModel=new \App\SinavQuestionModel();
        $PollsTypeModel=new \App\SinavTypeModel();
        $kategoritype=$PollsTypeModel->get();
        $allquestion=$PollQuestionModel->with(["answers","kategoriname"])->where("pollsId","=",$id)->get();
 //return $allquestion;
        return view("sinav.question_list",["id"=>$id,'bilgi'=>$bilgi,"list"=>$allquestion,"kategoritype"=>$kategoritype]);
    }


    public function saveQuestionAndAnswers(Request $req,$id)
    {

      $orderLast=$req->input("ordernum");



      $PollQuestionModel=new \App\SinavQuestionModel();

  //    $PollQuestionModel->where("pollsId","=",$id)->where("ordernum",">=",$orderLast)->update(["ordernum"]);
      $PollQuestionModel->where("pollsId","=",$id)->where("ordernum",">=",$orderLast)->update(["ordernum"=>DB::raw("ordernum+1")]);

      $PollQuestionModel->question=$req->input("title");
      $PollQuestionModel->description=$req->input("description");
      $PollQuestionModel->kategori=$req->input("kategori");
      $PollQuestionModel->ordernum=$req->input("ordernum");
      $PollQuestionModel->pollsId=$id;
      $PollQuestionModel->deleted="no";
      $PollQuestionModel->save();
      $questionid=$PollQuestionModel->id;
      $cevap=$req->input("cevap");
      $iscorrect=$req->input("isCorrect");
      $puans=$req->input("puan");
      $PollAnswerModel=new \App\SinavAnswerModel();
      $arraydata=array();
      $now = \Carbon\Carbon::now('utc')->toDateTimeString();
      foreach ($cevap as $key => $value)
      {
          $arraydata[$key]["answer"]=$value;
          $arraydata[$key]["puan"]=$puans[$key];
          $arraydata[$key]["iscorrect"]=$iscorrect[$key];
          $arraydata[$key]["questionid"]=$questionid;
          $arraydata[$key]["created_at"]=$now;
          $arraydata[$key]["updated_at"]=$now;
      }

      $PollAnswerModel->insert($arraydata);
      return redirect()->back();
      return $PollQuestionModel->with(["answers"])->get();

    }


    public function updatePoll(Request $req)
    {

      $bitissuresi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("bitissuresi"))->format("Y-m-d");
      $baslangicsuresi=\Carbon\Carbon::createFromFormat("m/d/Y",$req->input("baslangicsuresi"))->format("Y-m-d");
      $PollsModel=new \App\SinavModel();
      $Poll["anketCode"]=$req->input("anketCode");
      $Poll["title"]=$req->input("title");
      $Poll["description"]=$req->input("description");
      $Poll["polltype"]=$req->input("type");
      $Poll["startdate"]=$baslangicsuresi;
      $Poll["enddate"]=$bitissuresi;
      $Poll["deleted"]="no";
      $PollsModel->where("id","=",$req->input("id"))->update($Poll);
      return redirect()->back();
      return $req;
    }

    public function deleteQuestion($id)
    {
      $PollQuestionModel=new \App\SinavQuestionModel();

      $PollAnswerModel=new \App\SinavAnswerModel();
      $PollAnswerModel->where("questionid","=",$id)->update(["deleted"=>"yes"]);
      $PollQuestionModel->where("id","=",$id)->update(["deleted"=>"yes"]);
      return redirect()->back();
    }


    public function editQuestion($id)
    {
      $Poll=$PollsModel=new \App\SinavModel();
      $bilgi=$PollsModel->find($id);
      $PollQuestionModel=new \App\SinavQuestionModel();
      $PollsTypeModel=new \App\SinavTypeModel();
      $kategoritype=$PollsTypeModel->get();
      $allquestion=$PollQuestionModel->with(["answers","kategoriname"])->where("id","=",$id)->first();

      return view("sinav.question_edit",["id"=>$id,"bilgi"=>$allquestion,"kategoritype"=>$kategoritype]);
    }


    public function updateQuestion(Request $req,$id)
    {

      $PollQuestion=new \App\SinavQuestionModel();
      $orderLast=$req->input("ordernum");


    // $PollQuestion->where("pollsId","=",$id)->where("ordernum",">=",$orderLast)->update(["ordernum"=>DB::raw("ordernum+1")]);
    // DB::select("SET @rownumber = 0; update pollsquestions set ordernum = (@rownumber:=@rownumber+1) ");

      $PollQuestionModel["question"]=$req->input("title");
      $PollQuestionModel["kategori"]=$req->input("kategori");
      $PollQuestionModel["ordernum"]=$req->input("ordernum");
      $iscorrect=$req->input("isCorrect");
      $puans=$req->input("puan");
      $PollQuestionModel["deleted"]="no";
      $cevap=$req->input("cevap");
      $PollQuestion->where("id","=",$req->input("id"))->update($PollQuestionModel);


      $PollAnswerModel=new \App\SinavAnswerModel();
      $PollAnswerModel->where("questionid","=",$req->input("id"))->update(["deleted"=>"yes"]);
      $now = \Carbon\Carbon::now('utc')->toDateTimeString();
      foreach ($cevap as $key => $value)
      {
          $arraydata[$key]["answer"]=$value;
          $arraydata[$key]["puan"]=$puans[$key];
          $arraydata[$key]["iscorrect"]=$iscorrect[$key];
          $arraydata[$key]["questionid"]=$req->input("id");
          $arraydata[$key]["created_at"]=$now;
          $arraydata[$key]["updated_at"]=$now;
      }

      $PollAnswerModel->insert($arraydata);
      return redirect()->back();
      return $req;
    }


    public function assignUserToPoll($id)
    {
      $Poll=$PollsModel=new \App\SinavModel();
      $polldata=$Poll->find($id);
      $PollAssingUser=new \App\SinavAssingUser();

      if ($polldata->polltype=="outside")
      {
        $userlist=$PollAssingUser->where("pollId","=",$id)->get();
        return view("sinav.outside",["polldata"=>$polldata,"type"=>"outside","userlist"=>$userlist]);
      }else {
        /*
        $usermodel=new \App\User();
        $userlist=$usermodel->get();
        $useratananlist=$PollAssingUser->with(["user"])->where("pollId","=",$id)->get();
      //  return $useratananlist;
      */
          $usermodel=new \App\User();
          $userlist=$usermodel->get();
          $useratananlist=$PollAssingUser->with(["user"])->where("pollId","=",$id)->get();


          $SatinAlmaModel=new \App\SatinAlmaModel();
          $masrafyerilist=$SatinAlmaModel->get();


        return view("sinav.inside",["polldata"=>$polldata,"userlist"=>$userlist,"type"=>"inside","useratananlist"=>$useratananlist,"masrafyerilist"=>$masrafyerilist]);
      }
    }





    public function savePollAssing(Request $req)
    {
    //  return $req;
      $PollAssingUser=new \App\SinavAssingUser();

            if ($req->input("type")=="outside")
            {
              $userid=0;
              $username=$req->input("name");
              $email=$req->input("email");

              $FirmaAdi=$req->input("FirmaAdi");
              $Gorevi=$req->input("Gorevi");
              $Bolumu=$req->input("Bolumu");
              $PollAssingUser->pollId=$req->input("id");
              $PollAssingUser->userid=$userid;
              $PollAssingUser->username=$username;
              $PollAssingUser->email=$email;
              $PollAssingUser->FirmaAdi=$FirmaAdi;
              $PollAssingUser->Gorevi=$Gorevi;
              $PollAssingUser->Bolumu=$Bolumu;

              $PollAssingUser->usertype=$req->input("type");
              $PollAssingUser->aciklama=$req->input("aciklama");
              $PollAssingUser->deleted="no";
              $PollAssingUser->save();

            }else {

              $user=$req->input("user");
              $PollAssingUser=new \App\SinavAssingUser();
              $PollAssingUser->where("pollId","=",$req->input("id"))->delete();
              foreach ($user as $key => $value)
              {

                $userModel=new \App\User();
                $user=$userModel->find($value);
                $userid=$user->id;
                $username=$user->name;

                $FirmaAdi=\Helper::findCompanyName(1);
                $Gorevi=$user->unvan;
                $Bolumu=\Helper::findMasrafYeriAdi($user->masrafYeri);
                $email=$user->email;

                $PollAssingUser=new \App\SinavAssingUser();
                $PollAssingUser->pollId=$req->input("id");
                $PollAssingUser->userid=$userid;
                $PollAssingUser->username=$username;
                $PollAssingUser->email=$email;
                $PollAssingUser->FirmaAdi=$FirmaAdi;
                $PollAssingUser->Gorevi=$Gorevi;
                $PollAssingUser->Bolumu=$Bolumu;

                $PollAssingUser->usertype=$req->input("type");
                $PollAssingUser->aciklama=$req->input("aciklama");
                $PollAssingUser->deleted="no";
                $PollAssingUser->save();
              }

            }

      return redirect()->back();
    }

    public function deleteAssing($pollid,$id)
    {
        $PollAssingUser=new \App\SinavAssingUser();
        $PollAssingUser->where("id","=",$id)->where("pollId","=",$pollid)->update(["deleted"=>"yes"]);
        return redirect()->back();
    }

    public function assingToMe()
    {
      $userid = \Auth::user()->id;
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll"])->where("userid","=",$userid)->where("tamamlandi","=","no")->get();

      return view("sinav.my_poll",["list"=>$list,"ty"=>"active"]);
    }


    public function doneToMe()
    {
      $userid = \Auth::user()->id;
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll"])->where("userid","=",$userid)->where("tamamlandi","=","yes")->get();

      return view("sinav.my_poll",["list"=>$list,"ty"=>"done"]);
    }

    public function timerPollsMe()
    {
      $userid = \Auth::user()->id;
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["polldone"])->has("polldone",">",0)->where("userid","=",$userid)->where("tamamlandi","=","no")->get();

      return view("sinav.timer_poll",["list"=>$list,"ty"=>"timer"]);
    }


    public function startPoll($id)
    {
      $userid = \Auth::user()->id;
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll.questions.answers"])->where("pollId","=",$id)->where("tamamlandi","=","no")->first();

      return view("sinav.poll_question_start",["list"=>$list]);

    }


    public function startOutSidePoll($id)
    {
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll.questions.answers"])->where(DB::raw("md5(id)"),"=",$id)->where("tamamlandi","=","no")->first();

      return view("sinav.poll_question_start",["list"=>$list]);

    }

    public function showMyPoll($id)
    {
      $userid = \Auth::user()->id;
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll.questions.answers"])->where("pollId","=",$id)->where("userid","=",$userid)->first();
      return view("sinav.poll_question_show",["list"=>$list]);

    }


    public function saveUserAnswersPoll(Request $req)
    {

      $PollAnswerModel=new \App\SinavAnswerModel();
      $datax=$PollAnswerModel->whereIn("id",$req->input("question"))->get();
      $arrayforaction=array();
      foreach ($datax as $key => $value)
      {
          $arrayforaction[$key]["questionid"]=$value->questionid;
          $arrayforaction[$key]["userid"]=\Auth::user()->id;
          $arrayforaction[$key]["answerid"]=$value->id;
          $arrayforaction[$key]["puan"]=$value->puan;
          $correct=($value->iscorrect=="yes") ? "correct" : "incorrect";
          $arrayforaction[$key]["status"]=$correct;
          $arrayforaction[$key]["deleted"]="no";
      }
      $PollUserAnswerData=new \App\SinavUserAnswerData();
      $PollUserAnswerData->insert($arrayforaction);

      $PollAssingUser=new \App\SinavAssingUser();
      $PollAssingUser->where("pollId","=",$req->input("pollid"))->where("userid","=",\Auth::user()->id)->update(["tamamlandi"=>"yes","tamamlandiZaman"=>date("Y-m-d H:i:s")]);
      return view("error",["message"=>"Sınav Katılımınız Tamamlanmıştır. Teşekkür ederiz."]);
    }

    public function continuePolls()
    {
      $PollsModel=new \App\SinavModel();
      $list=$PollsModel->where("enddate","<=",DB::raw("NOW()"))->get();
      return view("sinav.poll_status_continue",["list"=>$list]);
    }


    public function donePolls()
    {
      $PollsModel=new \App\SinavModel();
      $list=$PollsModel->where("enddate",">",DB::raw("NOW()"))->get();
      return view("sinav.poll_status_end",["list"=>$list]);
    }


    public function showPollAnswers($id)
    {
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll.questions.answers"])->where("pollId","=",$id)->first();
      //return $list;

    //  return \Helper::findSinavAnswerByUser(1,17);
      return view("sinav.poll_question_statistic",["list"=>$list]);
      return $id;
    }

    public function showPuanUsers($id)
    {
      $PollAssingUser=new \App\SinavAssingUser();
      $list = $PollAssingUser->with(["poll.questions.answers"])->where("pollId","=",$id)->get();
    // return $list;
      return view("sinav.poll_question_puans",["list"=>$list]);
      return $id;
    }



    public function pollquestionAdd()
    {
      $list=DB::table("companies")->get();
      return view("sinav.sorugrubu.add",["list"=>$list]);
    }


    public function questionpolllist()
    {
        $SektorModel=new \App\SinavTypeModel();
        $list=$SektorModel->paginate(40);
        return view("sinav.sorugrubu.list",["list"=>$list]);
    }

    public function  questionpollsave(Request $req)
    {
        $SektorModel=new \App\SinavTypeModel();
        $SektorModel->code=$req->input("birimKodu");
        $SektorModel->title=$req->input("malzemeAciklamasi");
        $SektorModel->deleted="no";
        $SektorModel->save();
        return redirect()->back();
    }

    public function questionpolldelete($id)
    {

        $SektorModel=new \App\SinavTypeModel();
        $SektorModel->where("id","=",$id)->update(["deleted"=>"yes"]);
        return redirect()->back();
    }


    public function  questionpolledit($id)
    {

      $list=DB::table("companies")->get();

        $SektorModel=new \App\SinavTypeModel();
        $data=$SektorModel->find($id);
        return view("sinav.sorugrubu.edit",["data"=>$data,"list"=>$list]);
        return $type;
    }

    public function  questionpollupdate(Request $req)
    {
      $SektorModel=new \App\SinavTypeModel();
      $id=$req->input("id");
      $model["code"]=$req->input("birimKodu");
      $model["title"]=$req->input("malzemeAciklamasi");
      $SektorModel->where("id","=",$id)->update($model);

      return redirect()->back();
    }



}
