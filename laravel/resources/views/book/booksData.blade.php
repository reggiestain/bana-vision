 @foreach($books->chunk(3) as $chunk)
      <div class="row m-0">
        @foreach($chunk as $book)
        <div class="col-4">
          <figure class="figure">
            <img src="{{route('getPostPic',['filename'=>$book->images->first()->name,'folder'=>'books'])}}" class="figure-img img-fluid rounded show-photo" alt="A generic square placeholder image with rounded corners in a figure." data-book="{{$book}}" style="max-width: 100%">
            <?php
              $post = $book;
            ?>
            @include('includes.viewPostPicModal')
            <figcaption class="figure-caption">{{$book->title}}</figcaption>
        </figure>
        </div>
        @endforeach
      </div>
      @endforeach