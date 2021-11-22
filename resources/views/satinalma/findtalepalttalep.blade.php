<style>

table { border-collapse: collapse; empty-cells: show; }

td { position: relative; }

tr.strikeout td:not(:last-child):before {
  content: " ";
  position: absolute;
  top: 50%;
  left: 0;
  border-bottom: 1px solid red;
  width: 100%;
}

tr.strikeout td:after {
  content: "\00B7";
  font-size: 1px;
}
</style>

@php
    $whoIAm=Helper::findMyInformationForTalep();
  //  print_r($checkdugme);
  //  echo \Auth::user()->id;
    $dugmeOpen=false;
    switch ($checkdugme["type"]) {
      case 'departman':
      case 'ustdepartman':
        if (in_array($checkdugme['id'],$whoIAm['sorumlumasrafyeri']))
        {
          $dugmeOpen=true;
        }
      break;
      case 'birey':
            if ($whoIAm['id']==$checkdugme['id'])
            {
              $dugmeOpen=true;
            }
      break;
      case 'unvan':
        if ($whoIAm['gorevtanimi']==$checkdugme['id'])
        {
          $dugmeOpen=true;
        }
      break;
    }
@endphp
<div class="row">
  <div class="col-8">
    <table class="table striped">
      <thead>
        <tr>
          <th>İşlem Masraf Yeri - Onaylayıcı</th>
          <th>Onay  Tarihi</th>
          <th>Durumu</th>
          <th>Açıklama</th>
          <th>Ekli Dosyalar</th>
        </tr>
      </thead>
    <tbody>
      <tr>
        <td>{{Helper::findUserNameWithCode($data->createdUser)}}</td>
        <td>{{\Carbon\Carbon::parse($data->created_at)->format("d-m-Y H:i")}}</td>
        <td class="bg-success text-white">Satınalma Talep Oluşturuldu</td>
        <td>{{$data->genelaciklama}}</td>
        <td>
        @php
          $dokumasyon=Helper::satinAlmaEvrakListesi($data->id);
        @endphp
          @foreach ($dokumasyon as $key => $value)
            <a href='/uploads/{{$value->mediaurl}}' target="_blank">{{$value->name}}</a><br />
          @endforeach
        </td>
      </tr>
      @php
        $actionData=Helper::satinAlmaDurumuKontrol($data->id);
      @endphp

      @foreach ($data->durumkontrol as $key => $value)
        <tr>
          <td>
              @switch($value->masrafYeriTipi)
                  @case ("departman")
                  @case ("ustdepartman")
                        {{Helper::findMasrafYeriAdiWithUser($value->masrafYeriId)}}
                  @break
                  @case ("birey")
                      {{Helper::findUserNameWithCode($value->masrafYeriId)}}
                  @break
                  @case ("unvan")
                      {{Helper::findUnvanWithCode($value->masrafYeriId)}}
                  @break
              @endswitch
          </td>
          <td>{{\Carbon\Carbon::parse($value->updated_at)->format("d-m-Y H:i")}}</td>
          <td class="{{Helper::findColorForStatus($value->status)}}"> {{Helper::lookStatus($value->status)}}</td>
          <td>{{$value->aciklama}}</td>
          <td></td>
        </tr>
      @endforeach
    </tbody>
    </table>
    <hr  />

  </div>
    <div class="col-3">

    </div>
</div>
<div>

    @if ($dugmeOpen==true)
      <form action="/satinalma/talep/onay" method="post" id="talepformilerlet"  class="row">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$checkdugme['action_id']}}" />
        <input type="hidden" name="talepId" value="{{$data->id}}" />
        <input type="hidden" name="durum" id="xxtypexx" value="" />
          <div class="form-group col-md-4 pl-2">
            <label for="inputEmail4" class="smallx">Açıklama</label>
            <textarea name="aciklama" class="form-control my-"></textarea>
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4" class="smallx">Ek Dosyalar</label>
            <div class="custom-file">

              <input type="file" class="custom-file-input" name="file[]" id="customFile" multiple>
              <label class="custom-file-label" for="customFile">Dosya Seç</label>
            </div>
          </div>
          <div class="form-group col-md-4 pt-4 pl-5">
              <button type="button" class="btn btn-success" onclick="setStatusAndSend('onay')" >Onayla</button>
              <button type="button" class="btn btn-danger" onclick="setStatusAndSend('red')">Reddet</button>
          </div>
      </form>
    @endif
</div>

<table class="table striped">
  <thead>
    <tr>
      <th class="smallx">Talep No</th>
      <th class="smallx">Stok Kodu</th>
      <th class="smallx">Stok Tanımı</th>
      <th class="smallx">Stok Türü </th>
      <th class="smallx">Stok Sınıfı </th>
      <th class="smallx">Stok Birimi </th>
      <th class="smallx">Stok Adet </th>
      <th class="smallx">Stok Açıklaması </th>
      <th class="smallx">Önerilen Tedarikçi</th>
      <th class="smallx">Birim Fiyatı </th>
      @if ($dugmeOpen==true)
        <th class="smallx">İşlemler </th>
      @endif
    </tr>
  </thead>
  @if (!empty($list))
    <tbody>
      @foreach($list as $key=>$value)
          <tr  @if ($value->status=="iptal") class="strikeout" @endif>
            <td>{{$value->talepNo}}</td>
            <td>{{$value->stokkodu}}</td>
            <td>{{$value->urunadi}}</td>
            <td>{{$value->stokturu}}</td>
            <td>{{$value->stoksinifi}}</td>
            <td>{{$value->stokbirimi}}</td>
            <td>{{$value->stokadet}}</td>
            <td>{{$value->stokaciklamasi}}</td>
            <td>{{$value->onerilentedarikci}}</td>
            <td>{{$value->birimfiyati}}</td>
            @if ($dugmeOpen==true && $value->status=="onay" )
              <td>
                <a href='javascript::void(0)' class="text-danger" onclick="birimRed({{$value->id}},this)"><i class="fa fa-times"></i></a>
              </td>
            @elseif($value->status=="iptal")
              <td>
                İptal Eden : {{Helper::findUserNameWithCode($value->redUser)}}
              </td>
            @endif
        </tr>
      @endforeach
  </tbody>
  @endif
</table>
<hr  />
