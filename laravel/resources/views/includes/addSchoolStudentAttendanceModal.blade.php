<!--*********************************************************************
* 
*************************************************************************
*
*
-->
<div class="modal" tabindex="-1" role="dialog" id="add-school-student-attendance-modal">
  <div class="modal-dialog" style="max-width: 1080px" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Attendance Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('takeAttendance')}}" method="post">
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Student name</th>
                <th scope="col">Class</th>
                <th scope="col">Subject</th>
                <th scope="col">Time</th>
                <th scope="col">Day</th>
                <th scope="col">Week</th>
                <th scope="col">Present</th>
              </tr>
            </thead>
            <tbody>@if(isset($teachers_students))
              @foreach($teachers_students->unique() as $key=>$student)
              <tr>
                <th scope="row">{{$student->surname.' '.$student->name}}<input type="hidden" name="attendable_id[]" value="{{$student->id}}"><input type="hidden" name="attendable_type[]" value="{{'App\SchoolStudent'}}"></th>
                <td>{{$student->grade.' '.$student->class}}
                  <input type="hidden" name="grade[]" value="{{$student->grade}}">
                  <input type="hidden" name="class[]" value="{{$student->class}}">
                </td>
                <td>
                  
                  <select class="form-control form-control-sm" name="curriculumn_id[]">
                    @foreach(Auth::user()->usable->teacher->first()->teacherProficiency->unique() as $tp)
                  <option value="{{$tp->curriculumn->id}}">{{$tp->curriculumn->subject}}</option>
                  @endforeach
                </select></td>
                <td><input type="time" name="time[]" class="form-control form-control-sm"></td>
                <td><select name="day[]" class="form-control form-control-sm">
                  <option value="mon">Monday</option>
                  <option value="tue">Tuesday</option>
                  <option value="wed">Wednesday</option>
                  <option value="thur">Thursday</option>
                  <option value="fri">Friday</option>
                </select></td>
                <td><select name="week[]" class="form-control form-control-sm">
                  @for($i=1;$i<=52;$i++)
                  <option value="{{$i}}">week {{$i}}</option>
                  @endfor
                </select></td>
                <td><div class="form-check">
                  <input class="form-check-input" type="hidden" value="0" name="status[{{$key}}]" id="defaultCheck1">
                  <input class="form-check-input" type="checkbox" value="1"  name="status[{{$key}}]" id="defaultCheck1"></div></td>
                  <input type="hidden" name="school_id[]" value="{{$student->school->id}}">
                </tr>
              @endforeach
              @endif
            </tbody>
          </table>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
      <input type='hidden' name='_token' value='{{{csrf_token()}}}'>
      </form>
    </div>
  </div>
</div>