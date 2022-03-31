<!--Modal for   messages-->
<div class='modal fade' id='messages-modal' tabindex='-1' role='dialog' >
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header d-flex align-items-center'>
        <h5 class='modal-title'>Message</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        
      </div>
      <div class='modal-body'>
       <form class="random" action="{{route('sendMessage')}}" method="POST" >


        <div class="form-group  {{$errors->has('name') ? 'has-error':''}}" id="name_div">

        <textarea class="form-control"  name="messages-body" id="messages-body" placeholder="Write message"></textarea>   
        </div>
       

      </form>
    </div>
    <div class='modal-footer' align="center ">
      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      <button type='button' class='btn btn-orange' id='messages-modal-save'>Save changes</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->