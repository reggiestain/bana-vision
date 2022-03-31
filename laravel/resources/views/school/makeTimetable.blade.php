@extends('layouts.master')

@section('title')
 
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}Make Timetable
  @else
    Make Timetable
  @endif
@endsection

@section('content')
  @include('includes.message-block')
  <div class="card">
  <div class="card-header">
    Make timetable

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
        <a class="dropdown-item" href="#"  id="timetable-add-subject">
          <i class="fas fa-plus"></i> Add Subject
        </a>
      </div>
  </div>
  <div class="card-body">
    <!--FORM FOR CREATING TIMETABLE-->
    <form action="{{route('createTimetable')}}" method="POST" enctype="multipart/form-data"> 

      <!---->
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label col-form-label-sm">
          Year 
        </label>
        <div class="col-sm-8">
          <input type="number" min="2019" class="form-control form-control-sm" id="inputEmail3" placeholder="2019">
        </div>
      </div> 

       <!---->
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-7 col-form-label col-form-label-sm">
          Semester
        </label>
        <div class="col-sm-5">
          <input type="number" min="0" class="form-control form-control-sm" id="inputEmail3" placeholder="1">
        </div>
      </div> 

      <!---->
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-7 col-form-label col-form-label-sm">
          Number of days in the week
        </label>
        <div class="col-sm-5">
          <input type="number" min="1" class="form-control form-control-sm" id="inputEmail3" placeholder="0">
        </div>
      </div>

      <!---->
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-7 col-form-label col-form-label-sm">
          Number of timeslots in a day
        </label>
        <div class="col-sm-5">
          <input type="number" min="1" class="form-control form-control-sm" id="inputEmail3" placeholder="0">
        </div>
      </div>

      <div class="mt-2">
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Subject</th>
      <th scope="col">Allow double period</th>
      <th scope="col">Teachers</th>
      <th scope="col">Classes</th>
    </tr>
  </thead>
  <tbody class="added-subjects">
   
  </tbody>
</table>
</div>

    </form>
  </div>
</div>

@include('includes.addSubjectModal')
@endsection