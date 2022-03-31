<div class="modal" tabindex="-1" id="add-subject-modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 65%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="subjectsform" name="subjectsform">
        <!--LIST SCHOOL SUBJECTS-->
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label col-form-label-sm">
            Subject 
          </label>
          <div class="col-sm-8">
            <select class="form-control form-control-sm" name="subject" id="exampleFormControlSelect1" required>
              @foreach($userIdNo->usable->curriculumn as $subject)
                <option value="{{$subject->id}}">
                  {{$subject->subject}}  grade {{$subject->grade}}
                </option>
              @endforeach
            </select>
          </div>
        </div> 

        <!--LIST CLASSES-->
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label col-form-label-sm">
            Classes
          </label>
          <div class="col-sm-8">
            <select multiple class="form-control form-control-sm" name="classes[]" id="exampleFormControlSelect1">
              @foreach($userIdNo->usable->schoolclass as $class)
                <option value="{{$class->id}}">
                  grade {{$class->grade}}{{$class->class_name}}
                </option>
              @endforeach
            </select>
          </div>
        </div> 

        <!--ALLOW DOUBLE PERIOD-->
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-check">
              <input class="form-check-input" name="allowDouble" type="checkbox" id="gridCheck1">
              <label class="form-check-label" for="gridCheck1">
                Allow double period?
              </label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label col-form-label-sm">
            Teachers
          </label>
          <div class="col-sm-8">
            <select multiple class="form-control form-control-sm" name="teachers[]" id="exampleFormControlSelect1">
              @foreach($userIdNo->usable->teacher as $teacher)
                <option value="{{$teacher->id}}">
                 {{$teacher->staff->user->first()->name}} | @foreach($teacher->teacherProficiency->unique('curriculumns.subject') as $tch){{$tch->curriculumn->subject}},@endforeach
                </option>
              @endforeach
            </select>
          </div>
        </div> 

      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="save-subject">Save changes</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>