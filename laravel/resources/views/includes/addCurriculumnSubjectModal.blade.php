<!--Add curriculumn subject modal-->
<!--This doubles up as an edit form-->
<div class="modal" tabindex="-1" role="dialog" id="add-curriculumn-subject-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="curriculumn-subject-modal-title">Add subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="curriculumn-subject-form" action='{{route('createCurriculumn')}}' method='post'>
         
 
          <div class='form-group row m-0  {{$errors->has('subject') ? 'has-error':''}} ' id='subject_div'>
           <label for='grade' class="col-sm-2 col-form-label">Subject :</label>
           <div class="col-sm-10">
           <input class='form-control form-control-sm' type='text' name='subject' id='subject' value='{{Request::old('subject')}}' placeholder="name of the subject">  </div>
         </div>
        
          <div class='form-group row m-0  {{$errors->has('grade') ? 'has-error':''}}' id='grade_div'>
           <label for='requirements' class="col-sm-2 col-form-label">Grade:</label>
           <div class="col-sm-10">
           <input class='form-control form-control-sm' type='number' name='grade' id='grade' min="0" max="12" value='{{Request::old('grade')}}' placeholder="Grade"> </div> 
         </div> 

         
         <div class="form-group row m-0  {{$errors->has('has_practicals') ? 'has-error':''}}" id='has_practicals_div'>
           <label for='applicationLink' class="col-sm-2 col-form-label">Has practicals:</label>
           <div class="col-sm-10">
           <select class="form-control form-control-sm" name='has_practicals' id='has_practicals' value="{{Request::old('has_practicals')}}">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select>
        </div>
         </div> 
          
      <div class='form-group row m-0  {{$errors->has('description') ? 'has-error':''}}' id='description_div'>
           <label for='description' class="col-sm-2 col-form-label">description</label>
           <div class="col-sm-10">
           <textarea class='form-control form-control-sm' type='text' name='description' id='description' value='{{Request::old('description')}}' placeholder="briefly explain what the subject is about"></textarea> 
         </div>
         </div> 

          <input type='hidden' name='school_id' value='{{$userIdNo->usable_id}}'>
          <button type='submit' class='btn btn-primary'>Submit</button> 
          <input type='hidden' name='_token' value='{{{csrf_token()}}}'>

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

