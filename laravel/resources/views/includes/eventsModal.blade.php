<!--EVENTS  Modal -->
<div class="modal fade" id="eventsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!--MODAL BODY-->
      <div class="modal-body">
        
        
    
      <form action='{{route('createEvent')}}' method='post'>
         
 
          <div class='form-group  {{$errors->has('first_name') ? 'has-error':''}} ' id='name_div'>
           <label for='name'>Name:</label>
           <input class='form-control' type='text' name='name' id='name' value='{{Request::old('name')}}'>  
         </div>
           
            <div class='form-group {{$errors->has('location') ? 'has-error':''}}' id='location_div'>
           <label for='location'>number of positions available</label>
           <input class='form-control' type='text' name='location' id='location' value='{{Request::old('location')}}'>  
         </div> 



         <div class='form-group {{$errors->has('positionsAvailable') ? 'has-error':''}}' id='positionsAvailable_div'>
           <label for='positionsAvailable'>number of positions available</label>
           <input class='form-control' type='text' name='positionsAvailable' id='positionsAvailable' value='{{Request::old('positionsAvailable')}}'>  
         </div> 

         

          <div class='form-group  {{$errors->has('requirements') ? 'has-error':''}}' id='requirements_div'>
           <label for='requirements'>requirements:</label>
           <input class='form-control' type='text' name='requirements' id='requirements' value='{{Request::old('requirements')}}'>  
         </div> 

         
         <div class="form-group {{$errors->has('password') ? 'has-error':''}}" id='applicationLink_div'>
           <label for='applicationLink'>applicationLink:</label>
           <input class='form-control' type='text' name='applicationLink' id='applicationLink' value="{{Request::old('applicationLink')}}"> 
         </div> 

         <div class='form-group {{$errors->has('closingDate') ? 'has-error':''}}' id='closingDate_div'>
           <label for='closingDate'>closingDate</label>
           <input class='form-control' type='text' name='closingDate' id='closingDate' value='{{Request::old('closingDate')}}'>  
         </div> 
          
      <div class='form-group {{$errors->has('car') ? 'has-error':''}}' id='description_div'>
           <label for='description'>description</label>
           <textarea class='form-control' type='text' name='description' id='description' value='{{Request::old('description')}}'></textarea> 
         </div> 


          <button type='submit' class='btn btn-primary'>Submit</button> 
          <input type='hidden' name='_token' value='{{{csrf_token()}}}'>

      </form>

      </div><!--END OF MODAL BODY-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>