<div class="modal" tabindex="-1" role="dialog" id="needs-overview-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('createNeedsOverview')}}" method="POST" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="caption" class="col-sm-2 col-form-label">Caption</label>
            <div class="col-sm-10 {{$errors->has('body') ? 'has-error':''}}">
              <input type="text" class="form-control form-control-sm" name="caption" id="caption" placeholder="Tell the audience how their donation can help you" value="{{Request::old('caption')}}"> 
            </div>
          </div>

          <div class="form-group row">
            <label for="body" class="col-sm-2 col-form-label">Body</label>
            <div class="col-sm-10 {{$errors->has('body') ? 'has-error':''}}">
              <textarea class="form-control form-control-sm" name="body" id="body" placeholder="Tell the audience how their donation can help you" value="{{Request::old('body')}}"></textarea> 
            </div>
          </div>
          <input type="hidden" name="school_id" value="{{$userIdNo->usable_id}}">
          <input type="hidden"  name="_token" value="{{{csrf_token()}}}"> 
          <input type="file" class="form-control form-control-sm" name="needs-overview-image" placeholder="select image for the gratitude">
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
         </form>
      </div>
    </div>
  </div>
</div>