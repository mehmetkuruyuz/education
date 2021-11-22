@extends('layouts')
@section("content")
  <div class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-md-12 mt-5">
              <div class="card" id="allstartbody">
                  <div class="card-header" id="startoverTitle">Sayın {{\Auth::user()->name}} Sınav Bölümüne Hoşgeldiniz</div>

                  <div class="card-body text-center">
                    <div class="">
                      <h4>{{\Auth::user()->name}}</h4>
                    </div>
                    <div class="progress d-none" id="surebar">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressactionBar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                     <div id="allBodyMyAction">
                       <div id="resumetimer"></div>
                     </div>
                     <div id="questionBar">
                        Sınav için başlamanızdan itibaren sorular cevapladıkça önünüze gelecektir. Cevaplanmayan soruları ise aşağıdan seçerek tekrar görebilirsiniz.
                     </div>

                      <hr />
                      <button class="btn btn-success" onclick="startExam({{$examinformation->id}})" id="startButton">Sınava Başla</button>
                  </div>
                  <div class="footer text-center d-none" id="footerInformaiton">
                    <nav aria-label="Page navigation example" class=" text-center">
                        <ul class="pagination" style="flex-wrap: wrap;justify-content: center;">

                        </ul>
                      </nav>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection

@section('altscripts')

  <script>
  var intervalP="";
  var maxtime=50;{{--($examinformation->maximumTime*60)--}}
  var newQuestion=1;
    function startExam(id)
    {
        intervalP=setInterval(function()
        {
          maxtime-=0;
          $("#surebar").removeClass("d-none");
          $("#footerInformaiton").removeClass("d-none");
          $("#startButton").addClass("d-none");
          var minutes = Math.floor(maxtime / 60);
          var seconds = maxtime - minutes * 60;
          if (seconds<10) {seconds="0"+seconds;}

          // $("#resumetimer").html("<hr  />Kalan Süreniz "+minutes+":"+seconds+" <hr  />");
           if (newQuestion==1)
           {

             $.get("/soru/getir/"+id,
                  function(data, status){
                      $("#questionBar").html(data);
                      newQuestion=0;
                  });

                  $.get("/test",
                       function(data, status){
                           $("#footerInformaiton").html(data);
                           //newQuestion=0;
                       });

          }
          /*
           if (maxtime<0) {
              clearInterval(intervalP);
              $("#allBodyMyAction").html("Sınav Tamamlanmıştır Teşekkür Ederiz.");
              $("#footerInformaiton").children().remove();

              $("#questionBar").remove();
              $("#surebar").remove();
              $("#startButton").remove();
            }
             */
       }, 1000);

    }


    function next(id)
    {
      $.get("/soru/next/"+id,
           function(data, status){
               $("#questionBar").html(data);
               newQuestion=0;
           });
           $.get("/test",
                function(data, status){
                    $("#footerInformaiton").html(data);
                    //newQuestion=0;
                });


    }

    function findquestion(id)
    {
      $.get("/soru/findone/"+id,
           function(data, status){
               $("#questionBar").html(data);
               newQuestion=0;
           });
           $.get("/test",
                function(data, status){
                    $("#footerInformaiton").html(data);

                });


    }


    function answer(id)
    {
      var postForm = { //Fetch form data
           "cevap"  : $("input[name='customRadio"+id+"']:checked"). val(),
           "id"     : id,
           "_token" : $("#token").val()
       };

       $.ajax({
              url: "/soru/answer",
              type: "post",
              data: postForm ,
              success: function (response) {
                  $("#questionBar").html(response);
                  newQuestion=0;
                  $.get("/test",
                       function(data, status){
                           $("#footerInformaiton").html(data);
                       });
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }
          });
     }

  </script>

@endsection
