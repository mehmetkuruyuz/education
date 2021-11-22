
@php
  $id=rand(0,982222);
@endphp

<div class="row mt-2" id="master{{$id}}">
  <hr  />
    <a href="javascript::void(0)" class="text-danger" onclick="removeItemToScreen({{$id}})"><i class="fa fa-times"></i></a>
    <label for="" class="col-md-12 control-label">Onay Sırası {{$sira}}</label>
    <label for="" class="col-md-12 control-label">Onay Yeri Tipi</label>
    <div class="col-md-3">
      <select name="onaytype[]"  class="selectmulti form-control" style="width:100% !important" onchange="onayYeriGetir(this,{{$id}})">
          <option value="0" selected>Seçiniz</option>
          <option value="departman">Masraf Yeri</option>
          <option value="ustdepartman">Masraf Yeri Onaylayıcısı</option>
          <option value="birey">Kullanıcı</option>
          <option value="unvan">Ünvan Grubu</option>
      </select>
    </div>
    <div class="col-md-6">
      <select name='masrafyeri[]' id='place{{$id}}' class='form-control external' onchange="addItemToScreen({{$id}})">
      </select>
    </div>

</div>
