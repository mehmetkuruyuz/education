@if (!empty($projects))
  <div class="border p-3">
      <ul>
        <li class="no-li-style">
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio0" name="parentId" class="custom-control-input" value="0">
            <label class="custom-control-label" for="customRadio0">Ana Masraf Yeri</label>
          </div>
        </li>
        @foreach ($projects as $key=>$project)
            @include('admin.inf_a', $project)
        @endforeach
      </ul>
  </div>
@endif
