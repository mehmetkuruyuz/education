@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
@php
  $totaldata=array();
  $totalanswer=array();
@endphp
        @if (!empty($list))
                <div class="card-title pl-1"><strong>{{$list->poll->title}}</strong></div>
                  <div class="row">
                    <div class="col-12 mb-4 pb-4 border-bottom">
                      <strong>{{$list->poll->description}}</strong>
                    </div>

                    @if (!empty($list->poll->questions))
                        <hr />
                        @foreach ($list->poll->questions as $queskey => $quesvalue)
                          <div class="col-9 my-2 py-3 border-bottom">
                            <a class="text-dark" data-toggle="collapse" href="#question_{{$quesvalue->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                              {{$quesvalue->ordernum}} - {{$quesvalue->question}}
                            </a>

                              <div class="collapse show" id="question_{{$quesvalue->id}}">
                                <div class="card card-body border-0">
                                  @foreach ($quesvalue->answers as $key => $value)
                                    @php

                                      $cewvap=\Helper::findSinavAnswerCount($quesvalue->id,$value->id);
                                      if (empty($totalanswer[$quesvalue->id])) {$totalanswer[$quesvalue->id]=array();}
                                      $totalanswer[$quesvalue->id][$key]["title"]=$value->answer;
                                      $totalanswer[$quesvalue->id][$key]["count"]=$cewvap;
                                    @endphp
                                    <div class="input-group mb-3">

                                      <div class="form-control text-dark">
                                          {{$value->answer}}  <span class="badge badge-danger float-right">{{$cewvap}}</span>
                                      </div>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                          </div>
                          <div class="col-3 my-2 py-3 border-bottom">
                              <canvas id="poll_{{$quesvalue->id}}" width="300" height="300"></canvas>
                          </div>
                        @endforeach

                    @endif
                  </div>



        @endif

      </div>
    </div>

  </div>
@endsection
@section("altscripts")
<script>

@if (!empty($totalanswer))

@foreach ($totalanswer as $key => $value)
    var ctx_{{$key}} = document.getElementById('poll_{{$key}}');
    var myChart_{{$key}} = new Chart(ctx_{{$key}}, {
        type: 'pie',
        data: {
            labels: [@foreach($value as $zeky=>$valk) "Cevap : {{$valk["title"]}}", @endforeach],
            datasets: [{
                label: '# of Votes',
                data: [@foreach($value as $zeky=>$valk) {{$valk["count"]}}, @endforeach],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

@endforeach
@endif
</script>

@endsection
