@foreach($teachers->chunk(3) as $chunk)
             <div class="row m-0">
            @foreach($chunk as $teacher)
            <div class="col-4">
              <figure class="figure">
                <img src="{{route('getProfilePic',['filename'=>$teacher->staff->user->first()->id])}}" class="figure-img img-fluid rounded-circle show-photo" alt="A generic square placeholder image with rounded corners in a figure." style="max-width: 100%;width: 6rem;object-fit: cover;border-radius:50%;width: 50px;height: 50px;">
                
                <figcaption class="figure-caption">{{$teacher->staff->user->first()->name}}</figcaption>
              </figure>
            </div>
              @endforeach
            </div>
            @endforeach