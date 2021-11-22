@extends('layouts')
@section('content')
<style>

  .video-js .vjs-progress-control { display: none !important; }

</style>
<div class="card  card-tasks">
  <div class="card-header">
      <h2>Eğitim Adı: {{$educationData->title}}</h2>

  </div>

  <div class="card-body">
      <div class="row">
          <div class="col-lg-8 col-12">
            <div class="d-none">
              <button class="btn btn-success">Diğer Eğitime Geç</button>
            </div>
            <video id="myvideo" class="video-js vjs-default-skin vjs-big-play-centered"  controls="true"    preload="auto"         poster="MY_VIDEO_POSTER.jpg"        >
               <source src="/uploads/{{$educationData->media}}" type="video/mp4" />
               <p class="vjs-no-js"> view this video please enable JavaScript, and consider upgrading to a web browser that
                 <a href="https://videojs.com/html5-video-support/" target="_blank"   >supports HTML5 video</a>
               </p>
             </video>

          </div>
          <div class="col-lg-4 col-12">
              Bu video'da başarılı sayılabilmeniz için <strong>{{$educationData->successTime}}</strong> süre seyredilmiş olmalıdır.
              <br  />
              <div class="progress" style="height:20px;">
               <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" id='izlenmeoran'>
                 <small  class="ml-5">Anlık İzleme Durumunuz</small>
               </div>
             </div>
            <hr  />

                  <button onclick="skip(-10)" class="btn btn-success btn-sm">10 Saniye Geri</button>
                  <button onclick="find({{Helper::FindMyLastSeconds($educationData->id)}})" class="btn btn-success btn-sm">Kaldığım Yerden Başlat</button>
                  <button class="btn btn-success  btn-sm" onclick="restart();">Yeniden Başlat</button>
            <hr  />
            <div id="">
               <small>Son İzleme Süreniz <strong id='izlenmesuresi'>{{Helper::FindMyLastSeconds($educationData->id,true)}}</strong></small>

            </div>
            <hr  />
             <div class="my-3 border px-5 py-2" >
                 {!! $educationData->description !!}
             </div>
          </div>

          <div class="col-12">

          </div>
      </div>
  </div>
</div>
@endsection

@section("altscripts")
  <link href="https://vjs.zencdn.net/7.5.5/video-js.css" rel="stylesheet" />
  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <script src="https://vjs.zencdn.net/7.5.5/video.js"></script>
<script>

var player = videojs('myvideo', {
  fluid: true,
  controls:true,
  aspectRatio: '16:9'
});

     function skip(value) {
            var cTime=player.currentTime();
            player.currentTime(cTime+value);
     }

     function find(value) {
          player.currentTime(value);
     }
     function restart() {
          player.currentTime(0);
      }

$(document).ready(function() {
    setInterval(function ()
    {
        var whereYouAt = player.currentTime();
        if (whereYouAt>0)
        {
          if (!player.paused())
          {
            $.ajax({
                method: "POST",
                url: "/saveUserEducationTime",
              //  datatype: "html",
                data: {
                  u_id: {{\Auth::user()->id}},
                  v_id:{{$educationData->id}},
                  time:whereYouAt,
                   _token:"{{csrf_token()}}"
                 },
            })
          .done(function( msg ) {
            $("#izlenmeoran").css("width",msg.oran+"%");
            $("#izlenmesuresi").html(msg.sure);

            if (msg.success=="yes")
            {
              $("#izlenmeoran").addClass("bg-success");
              $("#izlenmeoran").removeClass("bg-warning");
              $("#izlenmeoran").removeClass("bg-secondary");

            }else {
              $("#izlenmeoran").addClass("bg-warning");
              $("#izlenmeoran").removeClass("bg-success");
              $("#izlenmeoran").removeClass("bg-secondary");
            }
          });
          }
      }

    console.log(whereYouAt+"current Time");

  },500);
});

</script>

@endsection
