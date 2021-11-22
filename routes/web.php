<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|    Yapıda aldığım radikal değişikliğin sebebi Nursel Hanımdır . Mutli routes lu full dinamik yapı bu şirkete uymuyor kafaya göre devamm edeceğiz demektir bu
|
*/


\Helper::loginWithUserCode();




Route::get("/get/user/action/data","UserController@getAllUserExternalAction");
Route::get("/recovermainstream","UserController@recovermainstream");



Route::get('/', 'UserController@welcome')->middleware("auth");;

Route::group(['prefix' => ''], function () {

  Route::get('/login', 'UserController@login')->name("login");
  Route::post("/login-controller",'UserController@checkLogin')->name("user-login");


Route::post('/logout',"UserController@logout")->middleware("auth");;


});

  Route::group(['prefix' => '/admin'], function () {

  Route::get('/', 'AdminController@index');//->name("adminlogin");
  Route::any('/user/list', 'AdminController@userlist')->name("menu.admin.kullanicitanimlama.userlist");
  Route::any('/user/masrafyeriatama', 'AdminController@masrafyeriatama')->name("menu.admin.kullanicitanimlama.kullaniciyeritanimlama");

  Route::post('/user/masrafyeriatama/save', 'AdminController@masrafyeriatamasave');

  Route::get('/user/new', 'AdminController@userregister');//->name("menu.admin.usernew");;
  Route::post('/user/save', 'AdminController@usersave');
  Route::post('/user/update', 'AdminController@userupdate');

  Route::get('/user/edit/{id}', 'AdminController@useredit');
  Route::get('/user/delete/{id}', 'AdminController@userdelete');

  Route::get('/kategori/list', 'AdminController@educationcategorylist');
  Route::get('/kategori/new', 'AdminController@educationcategorynew');
  Route::post('/kategori/save', 'AdminController@educationcategorysave');
  Route::get('/kategori/edit/{id}', 'AdminController@educationcategoryedit');
  Route::post('/kategori/update', 'AdminController@educationcategoryupdate');


  Route::get('/video/new', 'AdminController@educationvideonew');
  Route::get('/video/list','AdminController@educationvideolist');

  Route::post('/video/save', 'AdminController@educationvideosave');
  Route::get('/video/edit/{id}', 'AdminController@educationvideoedit');
  Route::post('/video/update', 'AdminController@educationvideoupdate');


  Route::get('/sinav/list', 'AdminController@examlist');
  Route::get('/sinav/questions/list/{id}', 'AdminController@questionlist');
  Route::get('/question/{id}/new', 'AdminController@questionnew');
  Route::post('/question/add', 'AdminController@questionadd');
  Route::get('/question/edit/{id}', 'AdminController@questionedit');

  Route::post('/question/update', 'AdminController@questionupdate');
  Route::get('/sinav/new', 'AdminController@examnew');
  Route::post('/sinav/save', 'AdminController@examsave');
  Route::get('/sinav/edit/{id}', 'AdminController@editexam');
  Route::post('/sinav/update', 'AdminController@examupdate');





  Route::get("/user/setvideokategori/{id}",'AdminController@setUserCategory');
  Route::post('/user/savecategory', 'AdminController@saveCategoryUser');


  Route::get('/durum', 'AdminController@durumlisteleri');

  Route::get("send/email/{type}/{uid}", 'AdminController@emailYolla');


  Route::get("/parametreler/satinalma/titles","AdminController@titlesList")->name("menu.admin.kullanicitanimlama.titles");;
  Route::get("/parametreler/satinalma/titles/add","AdminController@titlesAdd");
  Route::post('/parametreler/satinalma/titles/save', 'AdminController@titleSave');
  Route::get("/parametreler/satinalma/titles/edit/{id}","AdminController@titlesEdit");
  Route::post('/parametreler/satinalma/titles/update', 'AdminController@titleUpdate');
  Route::get('/parametreler/satinalma/titles/delete/{id}', 'AdminController@titleDelete');



  Route::get("/parametreler/satinalma/group","AdminController@groupList")->name("menu.admin.kullanicitanimlama.group");;
  Route::get("/parametreler/satinalma/group/add","AdminController@groupAdd");
  Route::post('/parametreler/satinalma/group/save', 'AdminController@groupSave');
  Route::get("/parametreler/satinalma/group/edit/{id}","AdminController@groupEdit");
  Route::post('/parametreler/satinalma/group/update', 'AdminController@groupUpdate');
  Route::get('/parametreler/satinalma/group/delete/{id}', 'AdminController@groupDelete');

});


Route::group(['prefix' => ''], function () {

  /******************************Satın Alma Parametreleri*****************************************/
    Route::any('/satinalma', 'SatinalmaContoller@index')->name("menu.entegre.satinalma");
    Route::any('/satinalma-onay', 'SatinalmaContoller@satinalmaonay')->name("men");

    Route::get('/satinalma-islem', 'SatinalmaContoller@satinalmaislem')->name("");


    Route::get('/tanimlama/masrafyeri', 'SatinalmaContoller@masrafyeri')->name("menu.admin.masrafyeri");
    Route::post('/tanimlama/masrafyeri/save', 'SatinalmaContoller@masrafyerisave');
    Route::post('/tanimlama/masrafyeri/update', 'SatinalmaContoller@masrafyeriupdate');

    Route::post("/satinalma/loadInformation",'SatinalmaContoller@loadInformation'); // firma ana tanımlamalarını çek
    Route::post("/satinalma/forselectalldepartments",'SatinalmaContoller@forselectalldepartments');

    Route::any("/satinalma/tummasrafyerleri",'SatinalmaContoller@nestedAllItems'); // firma ana tanımlamalarını çek

    Route::post("/satinalma/yenionaylayici",'SatinalmaContoller@onaylayiciEkle');
    Route::post("/satinalma/userlist","SatinalmaContoller@getUserList");
    Route::post("/satinalma/unvanlist","SatinalmaContoller@getunvanlist");
    Route::get("/satinalma/yeniurun","SatinalmaContoller@yeniUrun");
    Route::get("/satinalma/findlastnumber/","SatinalmaContoller@findlastnumber");

    Route::post("/satinalma/talep/onay","SatinalmaContoller@satinalmaTalepOnay");
    Route::get("/satinalma/talep/red/birim/{id}","SatinalmaContoller@birimRed");

    Route::post("/save/satinalmaform","SatinalmaContoller@saveSatinAlmaForm");

    Route::get("/satinalma/findtalep/{id}","SatinalmaContoller@talepEdit");
    Route::get("/satinalma/showtalep/{id}","SatinalmaContoller@talepGoster");

    Route::any("/satinalma/surec/akis","SatinalmaContoller@akisOlustur")->name("menu.admin.satinalmasurec");

    Route::get("/satinalma/masrafyeri/delete/{id}","SatinalmaContoller@masrafYeriSil");
    Route::get("/satinalma/masrafyeri/edit/{id}","SatinalmaContoller@masrafYeriEdit");

    Route::post("/tanimlama/masraf/surec/save","SatinalmaContoller@surecSave");
    Route::get("/tanimlama/masraf/surec/izleme/{id}","SatinalmaContoller@surecKontrol");

    Route::get("/tanimlama/masraf/sablon","SatinalmaContoller@genelSurecTanimlama");
    Route::post("/genelsurec/kaydet","SatinalmaContoller@genelsurecsave");

    Route::get("/sektor/list","AdminController@sektorlist");
    Route::get("/sektor/edit/{id}","AdminController@sektoredit");
    Route::get("/sektor/delete/{id}","AdminController@sektordelete");
    Route::post("/sektor/save","AdminController@sektorsave");
    Route::post("/sektor/update","AdminController@sektorupdate");


});

Route::group(['prefix' => ''], function () {

  Route::any("/products/list",'StokController@listProducts')->name("menu.admin.stoktanimlamalari.productslist");;
  Route::post('/products/save', 'StokController@saveProducts');
  Route::get("/products/delete/{id}","StokController@deleteProducts");
  Route::get("/products/edit/{id}","StokController@editProducts");
  Route::post('/products/update', 'StokController@updateProducts');

  /******************************Stok Tanımlama Parametreleri*****************************************/

  /***************************************************************************************************/

    Route::get("/stok/list/{type}",'StokController@controlAltElemanlar')->name("menu.admin.stoktanimlamalari.birimlist");;
    Route::post('/stok/save', 'StokController@saveStokReq');
    Route::get("/stok/delete/{type}/{id}",'StokController@stokDelete');
    Route::get("/stok/edit/{type}/{id}",'StokController@altElemanEdit');
    Route::post('/stok/update', 'StokController@altElemanUpdate');


    Route::any("/tedarikci/list","TedarikciController@index");
    Route::post("/tedarikci/save","TedarikciController@save");
    Route::get("/sehir/{id}","AdminController@findIlce");

    Route::get("/tedarikci/edit/{id}",'TedarikciController@edit');
    Route::get("/tedarikci/delete/{id}",'TedarikciController@delete');
    Route::post('/tedarikci/update', 'TedarikciController@update');


    Route::get("/tedarikci/yetkili/{id}",'TedarikciController@yetkili');

    Route::post('/tedarikci/yetkili/save', 'TedarikciController@yetkilisave');
    Route::get("/tedarikci/yetkili/delete/{id}",'TedarikciController@yetkilidelete');
    Route::get("/tedarikci/yetkili/edit/{id}",'TedarikciController@yetkiliedit');
    Route::post('/tedarikci/yetkili/update', 'TedarikciController@yetkiliupdate');


    Route::get("/unvan/list","TedarikciController@unvanlist");
    Route::get("/unvan/edit/{id}","TedarikciController@unvanedit");
    Route::get("/unvan/delete/{id}","TedarikciController@unvandelete");
    Route::post("/unvan/save","TedarikciController@unvansave");
    Route::post("/unvan/update","TedarikciController@unvanupdate");
});



Route::group(['prefix' => ''], function () {

  Route::any("/teklif/index","TeklifController@index");
  Route::post("/teklif/onayla","TeklifController@onayla");
  Route::any("/teklif/siparis","TeklifController@siparis");
  Route::any("/teklif/tamamlanmis","TeklifController@tamamlanmis");
  Route::post("/teklif/tedarikedildi","TeklifController@tedarik");

});



Route::group(['prefix' => ''], function () {

  Route::any("/education/category","EgitimController@educationcategorylist");
  Route::post("/save/education/category","EgitimController@educationCategorySave");
  Route::get("/egitim/category/find/{id}","EgitimController@educationEdit");
  Route::post("/update/education/category","EgitimController@educationCategoryUpdate");
  Route::get("/delete/education/category/{id}","EgitimController@educationCategoryDelete");


  Route::any("/education/lessons/{id}","EgitimController@educationLessons");
  Route::post("/education/save","EgitimController@educationSave");
  Route::post("/education/update","EgitimController@educationUpdate");
  Route::get("/education/find/{id}","EgitimController@educationFind");

  Route::get("/education/users/{id}","EgitimController@educationUserFind");
  Route::post("/education/user/save","EgitimController@educationUserUpdate");

  Route::any("user/education","EgitimController@educationList");
  Route::any("user/education/done","EgitimController@educationDoneList");
  Route::any("user/education/timer","EgitimController@educationTimerList");


  Route::get("/education/watch/{id}","EgitimController@educationWatch");

  Route::post("/saveUserEducationTime",'EgitimController@saveEducationTime')->middleware("web");



  Route::any("/education/continue/list","EgitimController@educationContinueStatus");
  Route::any("/education/done/list","EgitimController@educationDoneStatus");
  Route::any("/education/timer/list","EgitimController@educationTimerStatus");

  Route::get("/education/status/{id}","EgitimController@educationStatusForAllUser");

});



Route::group(['prefix' => ''], function () {

  Route::any("/poll/{type}","PollController@index");
  Route::post("/save/poll","PollController@savePoll");
  Route::get("/delete/poll/{id}","PollController@deletePoll");
  Route::get("/poll/edit/{id}","PollController@editPoll");
  Route::post("/update/poll","PollController@updatePoll");
  Route::get("/poll/question/{id}","PollController@addNewQuestion");
  Route::post("/poll/save/answer/{id}","PollController@saveQuestionAndAnswers");
  Route::get("/delete/poll/question/{id}","PollController@deleteQuestion");
  Route::get("/poll/question/edit/{id}","PollController@editQuestion");
  Route::post("/poll/edit/answer/{id}","PollController@updateQuestion");
  Route::get("/poll/user/assign/{id}","PollController@assignUserToPoll");
  Route::post("/poll/assing/user","PollController@savePollAssing");
  Route::get("/poll/delete/user/{pollid}/{id}","PollController@deleteAssing");

  Route::get("/user/poll","PollController@assingToMe");

  Route::get("/user/poll/done","PollController@doneToMe");


    Route::get("/user/poll/timer","PollController@timerPollsMe");

  Route::get("/poll/start/user/{id}","PollController@startPoll");
  Route::post("/poll/save/useranswer","PollController@saveUserAnswersPoll");

  Route::get("/poll/show/user/{id}","PollController@showMyPoll");


  Route::any("/poll/continue/list","PollController@continuePolls");
  Route::get("/poll/done/list","PollController@donePolls");



  Route::get("/poll/show/allanswers/{id}","PollController@showPollAnswers");



    Route::get("/parametreler/anket/soru","PollController@questionpolllist")->name("menu.admin.kullanicitanimlama.titles");;
    Route::get("/parametreler/anket/soru/add","PollController@pollquestionAdd");
    Route::post('/parametreler/anket/soru/save', 'PollController@questionpollsave');
    Route::get("/parametreler/anket/soru/edit/{id}","PollController@questionpolledit");
    Route::post('/parametreler/anket/soru/update', 'PollController@questionpollupdate');
    Route::get('/parametreler/anket/soru/delete/{id}', 'PollController@questionpolldelete');


});





  Route::get("/poll/start/user/outside/{id}","PollController@startOutSidePoll");




Route::group(['middleware' => ['auth']], function () {

  Route::any("/earsiv/list","EArsivController@index");
  Route::post("/earsiv/save","EArsivController@save");
  Route::any("/earsiv/queue","EArsivController@queue");
  Route::post("/earsiv/update","EArsivController@update");

  Route::get("/earsiv/show/{id}","EArsivController@show");

});

Route::group(['prefix' => ''], function () {

  Route::any("/sinav/{type}","SinavController@index");
  Route::post("/save/sinav","SinavController@savePoll");
  Route::get("/delete/sinav/{id}","SinavController@deletePoll");
  Route::get("/sinav/edit/{id}","SinavController@editPoll");
  Route::post("/update/sinav","SinavController@updatePoll");
  Route::get("/sinav/question/{id}","SinavController@addNewQuestion");
  Route::post("/sinav/save/answer/{id}","SinavController@saveQuestionAndAnswers");
  Route::get("/delete/sinav/question/{id}","SinavController@deleteQuestion");
  Route::get("/sinav/question/edit/{id}","SinavController@editQuestion");
  Route::post("/sinav/edit/answer/{id}","SinavController@updateQuestion");
  Route::get("/sinav/user/assign/{id}","SinavController@assignUserToPoll");
  Route::post("/sinav/assing/user","SinavController@savePollAssing");
  Route::get("/sinav/delete/user/{pollid}/{id}","SinavController@deleteAssing");

  Route::get("/user/sinav","SinavController@assingToMe");

  Route::get("/user/sinav/done","SinavController@doneToMe");
  Route::get("/user/sinav/late","SinavController@timerPollsMe");

  Route::get("/sinav/start/user/{id}","SinavController@startPoll");
  Route::post("/sinav/save/useranswer","SinavController@saveUserAnswersPoll");

  Route::get("/sinav/show/user/{id}","SinavController@showMyPoll");


  Route::get("/sinav/continue/list","SinavController@continuePolls");
  Route::get("/sinav/done/list","SinavController@donePolls");

  Route::get("/sinav/show/allanswers/{id}","SinavController@showPollAnswers");

  Route::get("/sinav/show/puandataforusers/{id}","SinavController@showPuanUsers");

    Route::get("/parametreler/sinav/soru","SinavController@questionpolllist")->name("menu.admin.kullanicitanimlama.titles");;
    Route::get("/parametreler/sinav/soru/add","SinavController@pollquestionAdd");
    Route::post('/parametreler/sinav/soru/save', 'SinavController@questionpollsave');
    Route::get("/parametreler/sinav/soru/edit/{id}","SinavController@questionpolledit");
    Route::post('/parametreler/sinav/soru/update', 'SinavController@questionpollupdate');
    Route::get('/parametreler/sinav/soru/delete/{id}', 'SinavController@questionpolldelete');


});

/*
Route::group(['middleware' => ['auth']], function () {


      Route::get("/exam/atanmis",'SinavController@index');
      Route::get("/exam/done",'SinavController@indexdone');

      Route::get("/exam/start/{id}",'SinavController@startwithid');
      Route::get("/exam/statics/{id}","SinavController@statics");


      Route::get('/exam', 'SinavController@start')->name("sinav")->middleware("auth");//->middleware("auth");
      Route::get("/soru/getir/{n?}",'SinavController@findSoru');
      Route::get("/soru/next/{n}",'SinavController@nextQuestion');

      Route::get("/soru/findone/{n}",'SinavController@getOneSoru');

      Route::post("/soru/answer",'SinavController@answerSave');


      Route::get("/test",'SinavController@renderForLinks');
      Route::get("/sinav/sonuc/{id?}",'SinavController@sonuc');
      Route::get("/exam/sonuc",'SinavController@sonuc');
      Route::get("/hightest",'SinavController@hightest');
});
*/
