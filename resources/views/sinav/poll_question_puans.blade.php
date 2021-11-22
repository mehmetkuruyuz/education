@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="card-title pl-1"><strong>  @if (!empty($list)) {{$list[0]->poll->title}} {{$list[0]->poll->description}} - Sınav Katılım Puanları</strong> @endif</div>
      @php
        $totaldata=array();
        $totalanswer=array();
      @endphp
        @if (!empty($list))
          <div class="px-5">
              @foreach ($list as $key => $value)
                @php
                    $lastpuan=0;
                @endphp
                <div class="row">
                  <a class="text-dark p-3 mb-2 w-100" data-toggle="collapse" href="#userinfo_{{$value->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                    @foreach ($value->poll->questions as $quekey => $quevalue)
                      @php

                          $allcevapbyuser=\Helper::findSinavAnswer($quevalue->id,$value->userid);
                      @endphp
                          @foreach ($quevalue->answers as $answkey => $answvalue)
                            @php
                              if ($allcevapbyuser==$answvalue->id){
                                  if ($answvalue->iscorrect=="yes"){
                                      $lastpuan+=$answvalue->puan;
                                    }
                                  }
                            @endphp
                          @endforeach
                    @endforeach
                    <strong>{{$value->username}} - {{$value->Bolumu}} </strong> <span class="float-right"> Puanı: {{$lastpuan}}</span>
                  </a>
                </div>
                  <div class="collapse mb-3" id="userinfo_{{$value->id}}">
                    <div class="row">
                      @foreach ($value->poll->questions as $quekey => $quevalue)
                        <div class="col-12">
                          <h5 class="bg-secondary p-2">Soru : {{$quevalue->question}} </h5>
                          <div class="row pl-5">
                            @php
                                $allcevapbyuser=\Helper::findSinavAnswer($quevalue->id,$value->userid);
                            @endphp
                            @foreach ($quevalue->answers as $answkey => $answvalue)
                                <div class="col-12 p-2 @if ($allcevapbyuser==$answvalue->id) @if ($answvalue->iscorrect=="yes") bg-success @else bg-danger @endif @endif">
                                  Cevap :  {{$answvalue->answer}} - {{$answvalue->puan}}
                                </div>
                            @endforeach
                        </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
              @endforeach
          </div>
            {{--

                  <div class="row">
                    <div class="col-12 mb-4 pb-4 border-bottom">
                      <strong>{{$list->poll->description}}</strong>
                    </div>
                    @if (!empty($list->poll->questions))
                        <hr />

                        @foreach ($list->poll->questions as $queskey => $quesvalue)
                          @php
                            $supertoplam=0;
                          @endphp
                          @foreach ($quesvalue->answers as $key => $value)
                            @php
                            $cewvap=\Helper::findSinavAnswerCount($quesvalue->id,$value->id);
                            $supertoplam+=$cewvap;
                            @endphp
                          @endforeach
                          <div class="col-9 my-2 py-3 border-bottom">
                              <a class="text-dark" data-toggle="collapse" href="#question_{{$quesvalue->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                {{$quesvalue->ordernum}} - {{$quesvalue->question}}
                              </a>
                              <div class="collapse show" id="question_{{$quesvalue->id}}">
                                <div class="card card-body border-0 my-3">
                                  @foreach ($quesvalue->answers as $key => $value)
                                    @php
                                      //
                                      $cewvap=\Helper::findSinavAnswerCount($quesvalue->id,$value->id);
                                      if (empty($totalanswer[$quesvalue->id])) {$totalanswer[$quesvalue->id]=array();}
                                      $totalanswer[$quesvalue->id][$key]["title"]=$value->answer;
                                      $totalanswer[$quesvalue->id][$key]["count"]=$cewvap;
                                      $allcevapbyuser=\Helper::findSinavAnswerByUser($quesvalue->id,$value->id);
                                      $allcevapbymasrafyeri=\Helper::findSinavAnswerByMasrafyeri($quesvalue->id,$value->id);

                                    @endphp
                                    <div class="input-group">
                                      <div class="form-control @if ($value->iscorrect=="yes") bg-success text-white  @else text-dark @endif">
                                          {{$value->answer}}  <span class="badge badge-danger float-right ml-5" id="yuzde_{{$value->id}}">@if ($supertoplam>0) {{($cewvap/$supertoplam)*100}} @else 0 @endif %</span>  <span class="badge badge-danger float-right">{{$cewvap}}</span>
                                      </div>
                                    </div>
                                    <div class="border my-1 px-2 text-right">
                                      <a class="btn btn-info" data-toggle="collapse" href="#whoisanwser_{{$value->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                          <small class=""> Kullanıcı Bazlı Cevaplar</small>
                                      </a>
                                      <a class="btn btn-info" data-toggle="collapse" href="#masrafyerianwser_{{$value->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                          <small  class=""> Masrafyeri Bazlı Cevaplar</small>
                                      </a>
                                      <hr  />
                                      <div class="collapse mb-3" id="whoisanwser_{{$value->id}}">
                                            @if(!empty($allcevapbyuser))
                                              <div class="row">
                                                <div class="col-3 text-left">Kullanıcı Kodu</div>
                                                <div class="col-3 text-left">Kullanıcı Adı</div>
                                                <div class="col-3 text-left"></div>
                                              </div>
                                              @foreach ($allcevapbyuser as $xkeymek => $xvalueemk)
                                                <div class="row">
                                                  <div class="col-3 text-left"><small>{{$xvalueemk->user->usercode}} </div><div class="col-3  text-left">{{$xvalueemk->user->name}}</small></div><div class="col-3 text-left"></div>
                                                </div>
                                              @endforeach
                                            @endif


                                      </div>
                                      <div class="collapse mb-3" id="masrafyerianwser_{{$value->id}}">
                                            @if(!empty($allcevapbymasrafyeri))
                                              <div class="row">
                                                <div class="col-3 text-left">Masraf Yeri</div>
                                                <div class="col-3 text-left">Verilen Cevap</div>
                                                <div class="col-3 text-left">Yüzde</div>
                                              </div>
                                              @foreach ($allcevapbymasrafyeri as $xkeymek => $xvalueemk)
                                                <div class="row">
                                                  <div class="col-3 text-left"><small>{{Helper::findMasrafYeriAdi($xkeymek)}} </div><div class="col-3  text-left">{{$xvalueemk}}</small></div><div class="col-3 text-left">{{($xvalueemk/$supertoplam)*100}} %</div>
                                                </div>
                                              @endforeach
                                            @endif

                                      </div>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                          </div>

                        @endforeach

                    @endif
                  </div>

--}}

        @endif

      </div>
    </div>

  </div>
@endsection
@section("altscripts")
@endsection
