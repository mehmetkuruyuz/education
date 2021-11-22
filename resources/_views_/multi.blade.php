<li class="no-li-style">
  <div class="custom-control custom-radio" onclick="openSubFromId({{ $project->id }})">
    <input type="radio" id="customRadio{{ $project->id }}" name="parentId" class="custom-control-input" value="{{ $project->id }}">
    <label class="custom-control-label" for="customRadio{{ $project->id }}" >{{ $project->code }} - {{ $project->title }}  	@if (!empty($project->childrenrecursive) && $project->childrenrecursive->count()>0) <i class="fas fa-caret-down"></i> @endif</label>
  </div>
</li>
	@if (!empty($project->childrenrecursive))
	    <ul id="sub_{{ $project->id }}" class="d-none ulstyle" data-parent="{{$project->id}}">
	    @foreach($project->childrenrecursive as $project)
	        @include('multi', $project)
	    @endforeach
	    </ul>
	@endif
