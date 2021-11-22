
@if (!empty($question))

<h2>{{$question->question}}</h2>

<input type="hidden" name="x" id="token" value="{{csrf_token()}}" />
<ul class="nav flex-column">
    @foreach ($question->answers as $key => $value)
      <li class="nav-item text-left my-2">
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio{{$value->id}}" name="customRadio{{$question->id}}" class="custom-control-input answer{{$value->id}}" value="{{$value->id}}">
          <label class="custom-control-label" for="customRadio{{$value->id}}">{{$value->answer}}</label>
          </div>
      </li>
    @endforeach
</ul>
  <button class="btn btn-danger" type="button" onclick="answer({{$question->id}})">Cevapla</button>
  <button class="btn btn-danger" type="button" onclick="next({{$question->id}})">Soru Pas Geç</button>
  <br class="my-5" />
  <hr  />
  <div class="text-center"><a href='/sinav/sonuc/{{$question->examId}}' class="btn btn-danger">Sınavı Bitir</a></div>
@else

  <h1>Sınav Soruları Cevaplanmıştır.</h1>
  <div class="text-center">Sonuçlarınızı görmek için lütfen <a href='/sinav/sonuc/{{$id}}' class="text-danger">tıklayınız</a></div>
@endif
