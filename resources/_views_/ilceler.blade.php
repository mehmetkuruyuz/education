@if (!empty($ilce))
  @foreach ($ilce as $key => $value)
      <option value="{{$value->ilce_id}}">{{$value->ilce_title}}</option>
  @endforeach
@endif
