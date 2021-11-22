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
      <th class="smallx">Durum </th>
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
            <td>
                @if($value->status=="iptal")
                  İptal Eden : {{Helper::findUserNameWithCode($value->redUser)}}
                @endif
              </td>

        </tr>
      @endforeach
  </tbody>
  @endif
</table>
<hr  />
