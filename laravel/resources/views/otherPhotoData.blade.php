
            @foreach($post_photos->chunk(3) as $chunk)
             <div class="row m-0 " style="height:10rem;">
              @foreach($chunk as $key=>$post)
                <div class="col-4 border p-0">
                <span class="image-hover">
                  <img class="show-photo" src="{{route('getPostPic',['filename'=>$post->images->first()->name])}}" style="max-width:100%;height: 100%;width:100%">
                  @include('includes.imageInteractions')
                </span>
                @include('includes.viewPostPicModal')
                </div>
              @endforeach
              
              
            </div>
            @endforeach
