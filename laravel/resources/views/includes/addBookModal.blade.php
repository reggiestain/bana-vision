<div class="modal" tabindex="-1" role="dialog" id="add-book-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('createBook')}}" enctype="multipart/form-data">
          <div class="form-group row  {{$errors->has('title') ? 'has-error':''}}">
            <label for="inputPassword" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="what is the book title?" value="{{Request::old('title')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('isbn_number') ? 'has-error':''}}">
            <label for="inputPassword" class="col-sm-2 col-form-label">Isbn number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" id="isbn_number" name="isbn_number" placeholder="book isbn number" value="{{Request::old('isbn_number')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('author') ? 'has-error':''}}">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" id="author" name="author" placeholder="who is the book's author?" value="{{Request::old('author')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('year') ? 'has-error':''}}">
            <label for="year" class="col-sm-2 col-form-label">Year</label>
            <div class="col-sm-10">
              <input type="number" class="form-control form-control-sm" id="year" name="year" placeholder="which year was the book published"  value="{{Request::old('year')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('grade') ? 'has-error':''}}">
            <label for="grade" class="col-sm-2 col-form-label">Grade</label>
            <div class="col-sm-10">
              <input type="number" class="form-control form-control-sm" id="grade" name="grade" max="12" placeholder="which grade is the book prescribed for" value="{{Request::old('grade')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('quantity') ? 'has-error':''}}">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
              <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="the number of copies the school has" value="{{Request::old('quantity')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('description') ? 'has-error':''}}">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea  class="form-control form-control-sm" id="description" name="description" placeholder="describe the book"></textarea   value="{{Request::old('description')}}">
            </div>
          </div>

          <div class="form-group row {{$errors->has('category') ? 'has-error':''}}">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" id="category" name="category" placeholder="which category does the book belong to" value="{{Request::old('category')}}">
            </div>
          </div>

           <div class="form-group row {{$errors->has('book_cover') ? 'has-error':''}}">
            <label for="category" class="col-sm-2 col-form-label">Book cover</label>
            <div class="col-sm-10">
              <input type="file" class="form-control form-control-sm" id="book_cover" name="book_cover" placeholder="which category does the book belong to" value="{{Request::old('book_cover')}}">
            </div>
          </div>

          <input type="hidden" name="school_id" value="{{$userIdNo->id}}">
          <input type="hidden"  name="_token" value="{{{csrf_token()}}}">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
        </form>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>