<div class="form-group">
    <label class="smallx ml-3">Firma</label>
    <div class="col-md-12">
        <select class="form-control" name="companyId">
            @foreach (Helper::getFirmList() as $key => $value)
                <option value="{{$value->id}}" {{-- @if($value->id==$data->companyId) selected @endif --}}>{{$value->firmaKodu}} - {{$value->firmaAdi}}</option>
            @endforeach
        </select>
    </div>
</div>
