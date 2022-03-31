<!--Modal for   messages-->
<div class='modal fade' id='rate-us-modal' tabindex='-1' role='dialog' >
  <div class='modal-dialog' role='document'>
    
    <div class='modal-content' style="border-radius: 0.9rem;">
      <div class='modal-body'>
       

        <div><h5>Rate us <span><i class="fas fa-star"></i></span></h5></div>
        <form class="random" action="{{route('rateus')}}" method="POST" >
        <fieldset class="rating">
          <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
          <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
          <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
          <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
          <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
          <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
          <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

          <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>

          <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>

          <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

        </fieldset>

        
        <div class="form-group  {{$errors->has('name') ? 'has-error':''}}" id="name_div">

          <textarea class="form-control"  name="review" id="messages-body" placeholder="review us" style="border-radius: 0.9rem !important;"></textarea>   
        </div>
        
        <input type="hidden" name="schoolUserId" id="schoolUserId">
        <input type="hidden" name="_token" value="{{Session::token()}}">
      <button type='button' class='btn btn-default rounded' style="border-radius: 2.25rem !important" data-dismiss='modal'>Close</button>
      <button type='submit' class='btn btn-orange rounded' style="border-radius: 2.25rem !important">
      <i class="fas fa-save"></i>
      Save</button>
   
    </form>
    </div>
    
      
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->