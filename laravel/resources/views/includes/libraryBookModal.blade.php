<div class="modal col-12" tabindex="-1" role="dialog" id="displayBook-modal">
  <div class="modal-dialog p-0" role="document">
    <div class="modal-content col-12" style="width:175%">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row m-0">
          <!--book image-->
          <div class="col-4">
            <img class="figure-img img-fluid" src="" alt="Second slide" style="width: 9rem" id="book-image">
          </div>

          <div class="col-8">
          <h5 id="book-title"></h5>
          <ul class="list-group">
            <li class="list-group-item p-1" style="font-size: 0.875rem;border:none" id="book-isbn"><strong>Isbn :</strong> </li>
            <li class="list-group-item p-1" style="font-size: 0.875rem;border:none" id="book-author"><strong>Author :</strong> </li>
            <li class="list-group-item p-1" style="font-size: 0.875rem;border:none" id="book-year"><strong>Year :</strong> </li>
            <li class="list-group-item p-1" style="font-size: 0.875rem;border:none" id="book-location"><strong>Year :</strong> </li>
          </ul>
        </div>  
        </div>
        <h5 class="mt-2 p-2" >Book description {{$userIdNo->usable_id}}</h5>
        <div class="col" id="book-description"></div>
      </div>
      <div class="modal-footer">
        <form action="{{route('createRequestedBook')}}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="book_id" id="book-id">
          <input type="hidden" value="{{$userIdNo->usable_id}}" name="school_id">
          <input type="hidden"  name="_token" value="{{{csrf_token()}}}">
        <button type="submit" class="btn btn-primary btn-sm">Request book</button>
      </form>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>