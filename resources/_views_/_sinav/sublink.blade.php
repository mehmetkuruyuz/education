<nav aria-label="Page navigation example" class=" text-center">
    <ul class="pagination" style="flex-wrap: wrap;justify-content: center;">
      @php $tus=0; @endphp
        @foreach ($data->questions as $key => $value)
          @if (in_array($value->id,$sorulist))
          <li class="page-item" style="  ">
            @php
          //    print_r($value);
            @endphp
            @if (!empty($value->answers->userAnswerId))
              <a class="page-link  text-muted" href="JavaScript::void(0)" onclick="findquestion({{$value->id}})">{{$tus}}</a>
            @else
              <a class="page-link" href="JavaScript::void(0)" onclick="findquestion({{$value->id}})">{{$tus+1}}</a>
            @endif
          </li>
          @endif
            @php
                $tus++;
            @endphp
        @endforeach

    </ul>
  </nav>
