@if (!empty($modallist))
  <option value="0" selected>
    Seçiniz
  </option>
  @foreach ($modallist as $key => $value)

      @if (!empty($value->subdata))
          <optgroup label="{{$value->code}} {{$value->title}} Alt Masraf Yerleri">
            <option value="{{$value->id}}" data-code="{{$value->code}}">{{$value->code}} - {{$value->title}}</option>
            @foreach ($value->subdata as $keyx => $xalue)
              <option value="{{$xalue->id}}" data-code="{{$xalue->code}}">{{$xalue->code}} - {{$xalue->title}}</option>
            @endforeach
          </optgroup>
      @else
          <option value="{{$value->id}}" data-code="{{$value->code}}">{{$value->code}} - {{$value->title}}</option>
      @endif
  @endforeach
@endif
