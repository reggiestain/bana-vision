@extends('layouts.master')

@section('title')
  @if(isset($numberMessages)){{'('.$numberMessages.')'}} Curriculumn
  @else
  Curriculumn
  @endif
@endsection

@section('content')
  @include('includes.message-block')
  <div class="card">
  <div class="card-header">
    Curriculumn
     @if(Auth::user())
   @if((Auth::user()->name == $userIdNo->name) && (Auth::user()->usable_type != 'App\Student'))
    

    <a class="p-1 float-right">
        <i class="fas fa-wrench" style="color:#c5c7cb"></i>
      </a>
      <a class="p-1 float-right">
        <i class="fas fa-chevron-up" style="color:#c5c7cb"></i>
      </a>
      <a class="p-1 float-right" id="addSubjectMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-plus" style="color:#c5c7cb"></i>
      </a>
      <div class="dropdown-menu" aria-labelledby="addSubjectMenuButton">
        <a class="dropdown-item" href="#"  id="add-curriculumn-subject" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#add-event-modal">
          <i class="fas fa-plus"></i> Add Subject
        </a>
      </div>
    @endif
    @endif
  </div>
  <div class="card-body" style="min-height: 25rem;">
  	<div class="row p-2">
  		<!--SUBJECTS TABLE-->
  		<table class="table table-bordered table-hover">
  			<thead>
  				<tr>
  					<th scope="col">Subject</th>
  					<th scope="col">Grade</th>
  					<th scope="col">Has practicals</th>
  					<th scope="col">Description</th>
  					@if(Auth::user())
   @if((Auth::user()->name == $userIdNo->name) && (Auth::user()->usable_type != 'App\Student'))
   <th scope="col">Action</th>
   @endif 
   @endif
  				</tr>
  			</thead>
  			<tbody>
  				@foreach($curriculumn as $key=>$curr)
  				<tr>
  					<td>{{$curr->subject}}</td>
  					<td>{{$curr->grade}}</td>
  					<td>@if($curr->has_practicals == 1)Yes @else No @endif</td>
  					<td>{{$curr->description}}</td>
  					@if(Auth::user())
   					@if((Auth::user()->name == $userIdNo->name) && (Auth::user()->usable_type != 'App\Student'))
   					<td>
   						<a href="{{route('deleteCurriculumn',['user'=>$userIdNo,'curriculumn_id'=>$curr->id])}}">
   							<i class="fas fa-trash delete-msg" style="color: #ff0000"></i>
   						</a>
   						<a href="#">
   							<i class="fas fa-pen " id="edit-curriculumn-subject" data-grade="{{$curr->grade}}" data-subject="{{$curr->subject}}" data-hasPracticals="{{$curr->has_practicals}}" data-description="{{$curr->description}}"></i>
   						</a>
   					</td>
  					@endif
  					@endif
  				</tr>
  				@endforeach
  			</tbody>
  		</table>
  		<div><span class="d-flex ml-auto mr-auto">{{$curriculumn->links()}}</span></div>
  	</div>
  </div>
</div>

<script type="text/javascript">
  var edit_route = "{{route('createCurriculumn')}}";
</script>

@include('includes.addCurriculumnSubjectModal')
@endsection