<table class="table table-hover">
  <thead>
    <tr>
      <th>Kullanıcı Adı</th>
      <th>Eğitim Durumu</th>
      <th>Toplam Eğitim Süresi</th>
      <th>Başarı Süresi</th>
      <th>Kullanıcı Seyretme Durumu</th>
      <th>Son Güncellenme Tarihi</th>
    </tr>
  </thead>
  <tbody>
      @if (!empty($list))
        @foreach ($list as $key => $value)
          <tr>
            <td>@if (!empty($value->user->name)) {{$value->user->name}} @endif</td>
            <td>
              @if ($value->isSuccess=="yes")
                Tamamladı
              @else
                @if ($value->educationTime=="00:00:00")
                  Eğitim Atandı
                @else
                  Devam Ediyor
                @endif
              @endif
            </td>
            <td>{{$value->education->videoTime}}</td>
            <td>{{$value->education->successTime}}</td>
            <td>{{$value->educationTime}}</td>
            <td>{{$value->updated_at}}</td>
          </tr>
        @endforeach
      @endif
  </tbody>
</table>
