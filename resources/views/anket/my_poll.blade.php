@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title pl-1"><strong>@if ($ty=="done") Tamamlanan Anket Listem @else Anket Listem @endif</strong></div>
          <form action="/user/poll" method="post" >
            {{csrf_field()}}

            <div class="form-group row">
                    @include('company.select')
              <div class="col-sm-3">
                <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Anket Adı</label>
                <input type="text" class="form-control" id=""  name="categoryname"  @if (!empty($categoryname)) value="{{$categoryname}}"   @endif />
              </div>

              <div class="col-sm-1" style="padding-top:33px;">
              <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
            </div>
          </div>
          </form>

        <div class="row">
          <div class="table-responsive col-12" style="width:100%">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Anketi Oluşturan</th>
                  <th>Anket Kodu</th>
                  <th>Anket Adı</th>
                  <th>Anket Açıklama</th>
                  <th>Bitiş Tarihi</th>

                  <th>Oluşturulma Tarihi</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              @if (!empty($list))
                @foreach ($list as $z => $ze)
                    @if (!empty($ze->poll))

                          <tr>
                            <td>{{Helper::findUserNameWithCode($ze->poll->MakerId)}}</td>
                            <td>{{$ze->poll->anketCode}}</td>
                            <td>{{$ze->poll->title}}</td>
                            <td>{{$ze->poll->description}}</td>
                            <td>{{$ze->poll->enddate}}</td>

                            <td>{{$ze->poll->created_at}}</td>
                            @if ($ze->tamamlandi=="no")
                              <td><a href='/poll/start/user/{{$ze->poll->id}}' class="text-danger"><i class="fas fa-hourglass-start"></i></a></td>
                            @else
                              <td><a href='/poll/show/user/{{$ze->poll->id}}' class="text-danger"><i class="fas fa-hourglass-start"></i></a></td>
                            @endif

                          </tr>

                      @endif
                  @endforeach
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
