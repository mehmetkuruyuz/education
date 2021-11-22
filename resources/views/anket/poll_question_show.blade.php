@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        @if (!empty($list))
                <div class="card-title pl-1"><strong>{{$list->poll->title}}</strong></div>
                  <div class="row">
                    <div class="col-12 mb-4 pb-4 border-bottom">
                      <strong>{{$list->poll->description}}</strong>
                    </div>

                    @if (!empty($list->poll->questions))
                        <hr />
                        @foreach ($list->poll->questions as $queskey => $quesvalue)
                    <div class="col-12 my-2 py-3 border-bottom">
                            <a class="text-dark" data-toggle="collapse" href="#question_{{$quesvalue->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                              {{$quesvalue->ordernum}} - {{$quesvalue->question}}
                            </a>

                          <div class="collapse show" id="question_{{$quesvalue->id}}">
                            <div class="card card-body border-0">
                              @php
                                $cewvap=\Helper::findPollAnswer($quesvalue->id,\Auth::user()->id);
                              @endphp
                              @foreach ($quesvalue->answers as $key => $value)
                                <div class="input-group mb-3">

                                  <div class="  form-control  @if ($cewvap==$value->id) bg-success text-light @else text-dark @endif">
                                      {{$value->answer}}
                                  </div>
                                </div>
                              @endforeach
                            </div>
                          </div>
                          </div>
                        @endforeach

                    @endif
                  </div>



        @endif

      </div>
    </div>

  </div>
@endsection
