{{--
<tr>
  <td>
    <input type="hidden" name="urunadi[]"  class="form-control form-control-sm productsname"/>
    @if (!empty($urunler))
      <select name="urunkodu[]" class="form-control form-control-sm"  onchange="changeType(this)">
        <option value="M">Malzeme</option>
        <option value="H">Hizmet</option>
      </select>
     @endif
</td>
  <td colspan="2">
    <input type="hidden" name="urunadi[]"  class="form-control form-control-sm productsname"/>
    @if (!empty($urunler))
      <select name="urunkodu[]" class="selectmulti productscode"  onchange="changeType(this)">
        @foreach($urunler as $key=>$value)
              <option value="{{$value->id}}" >{{$value->malzemeKodu}} - {{$value->malzemeAciklamasi}}</option>
        @endforeach
      </select>
     @endif
</td>

    <td><input type="text" name="urunbirim[]"   class="form-control form-control-sm productstype"/></td>
    <td><input type="text" name="urunadet[]"    class="form-control form-control-sm"/></td>
    <td><input type="text" name="urunaciklama[]" class="form-control form-control-sm"/></td>
    <td><input type="text" name="uruntedarikci[]" class="form-control form-control-sm"/></td>

    Stok Kodu 	Stok Tanımı 	Stok Türü 	Stok Sınıfı 	Stok Birimi 	Stok Adet 	Stok Açıklaması 	Önerilen Tedarikçi 	Birim Fiyatı
</tr>
--}}

<tr>
      <td><input type="text" name="stokkodu[]" readonly  class="form-control form-control-sm stokkodu"/></td>
      <td style="min-width:300px !important">
        @if (!empty($urunler))
          <select name="urunadi[]" class="selectmulti"  onchange="changeType(this)" style="min-width:300px !important">
            @foreach($urunler as $key=>$value)
                  <option value="{{$value->id}}"

                        data-malzemeKodu="{{$value->malzemeKodu}}"
                        data-malzemeTipi="{{\Helper::findUrunTipi($value->malzemeTipi)}}"
                        data-malzemeTuru="{{\Helper::findStokTuru($value->stokTuru)}}"
                        data-malzemeSinifi="{{\Helper::findUrunSinifi($value->malzemeSinifi)}}"
                        data-malzemeBirimi="{{\Helper::findUrunBirimi($value->malzemeBirimi)}}"
                        data-stokTuru="{{$value->stokTuru}}"
                        data-birimFiyat="{{$value->birimFiyat}}">{{$value->malzemeKodu}} - {{$value->malzemeAciklamasi}}</option>
            @endforeach
          </select>
         @endif
       </td>
      <td><input type="text" name="stokturu[]" readonly  class="form-control form-control-sm stokturu"/></td>
      <td><input type="text" name="stoksinifi[]" readonly  class="form-control form-control-sm stoksinif"/></td>
      <td><input type="text" name="stokbirimi[]" readonly  class="form-control form-control-sm stokbirimi"/></td>
      <td><input type="text" name="stokadet[]"   class="form-control form-control-sm"/></td>
      <td><input type="text" name="stokaciklamasi[]"   class="form-control form-control-sm"/></td>
      <td>
        <select name="onerilentedarikci[]" class="selectmultiwithtags" style="min-width:300px !important">
            @if (!empty($firmalist))
                @foreach ($firmalist as $key => $value)
                    <option value="{{$value->firma_Kodu}} - {{$value->firma_Adı}}">{{$value->firma_Kodu}} - {{$value->firma_Adı}}</option>
                @endforeach
            @endif
        </select>
      </td>
      <td><input type="text" name="birimfiyati[]"   class="form-control form-control-sm birimfiyati"/></td>
      <td><a class="text-danger" onclick="removeAllItem(this)"><i class="fas fa-trash"></i></a></td>
</tr>
