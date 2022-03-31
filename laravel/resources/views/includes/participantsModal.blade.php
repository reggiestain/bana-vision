<!--PARTICIPANTS  Modal -->
<div class="modal fade " id="addParticipants-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h5 class="modal-title" id="exampleModalLabel">Add participants</h5>
        <button type="button" class="close btn-orange" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">
        
        
        @foreach($school->students->chunk(3) as $chunk)

            <div >
            @foreach($chunk as $student)  
                    <div class="form-check form-check-inline">
              <input class="form-check-input participantCheckbox" type="checkbox" name="participants[]" id="{{$student->id}}" value="{{$student->user->first()->name}}">
              <label class="form-check-label" for="inlineCheckbox1">{{$student->user->first()->name}}</label>
            </div>
            @endforeach
            </div>  
          
            @endforeach 
      <div class="form-group"  align="center"></div>

      </div><!--END OF MODAL BODY-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-orange" id='participants-modal-save'>Save changes</button>
      </div>
    </div>
  </div>
</div>