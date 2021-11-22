@if (!empty($modallist))
  <option value="0" selected>
    Seçiniz
  </option>
  @foreach ($modallist as $key => $value)
        <option value="{{$value->id}}">{{$value->title}}</option>
  @endforeach
@endif
