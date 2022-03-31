<div class="card card-custom d-flex mt-2 ">
  <div class="card-header">
    @if(isset($post->shared)) <!--this event is shared on a timeline-->
    <div class="media d-flex align-items-center p-0 pb-2">
      <img class="rounded-circle mr-3  bg-white post-avatar" src="{{route('getProfilePic',['filename'=>$post->shared_user_id])}}" id="jumbotron-image"  class="img-circle">
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="{{route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])}}" style="padding-right:6px">
            {{$post->shared_user_name}} <span style="color:#000000">shared a book</span>
          </a>
        </h5>
        <a style="color: black" >
         {{$post->created_at->format('j F g:i A')}}
       </a>
     </div>
     <!--===========================SHARED POST MORE OPTIONS BUTTON==============================-->
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    <!--============================SHARED POST OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @if (Route::currentRouteName() != 'getBursaries')
        <a class="dropdown-item" href="{{route('ourNeeds',['user'=>$post->user])}}">more needs from </a>
        @endif
      
    </div>
   </div>

   <div class="media d-flex align-items-center p-0 pb-2">
   	@if (!(isset($post->shared)))
      <img class="rounded-circle mr-3  bg-white post-avatar" src="{{route('getProfilePic',['filename'=>$post->shared_user_id])}}" id="jumbotron-image"  class="img-circle">
      @endif
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="{{route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])}}" style="padding-right:6px">
            {{$post->school->user->first()->name}}
          </a>
        </h5>
        <a style="color: black" >
         {{$post->created_at->format('j F g:i A')}}
       </a>
     </div>
     <!--===========================SHARED POST MORE OPTIONS BUTTON==============================-->
     @if (!(isset($post->shared)))
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    @endif
    <!--============================SHARED POST OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @if (Route::currentRouteName() != 'getBursaries')
        <a class="dropdown-item" href="{{route('ourNeeds',['user'=>$post->user])}}">more needs from </a>
        @endif
      
    </div>
   </div>
   @endif
  </div>
  <img class="card-img-top show-photo" src="{{route('getPostPic',['filename'=>$post->book->images->first()->name,'folder'=>'books'])}}"    alt="Schools brand picture" style="background-color:beige;height: 14.25rem; ">
  <!--============================CARD BODY===============================-->
  <div class="card-body" style="padding: 0"> 
      <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-2x">
          <i class="fas fa-book fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
      <!--==============================EVENT DETAILS==============================-->
      <div class="col-9 p-3" >
        <h5>
          <strong>
            {{$post->book->title}}
          </strong>
        </h5>
        <h6>By {{$post->book->author}}</h6>
           Isbn : {{ $post->book->isbn_number}}
            <p class="text-muted">
              {{$post->book->description}}
            </p>

      </div>
   </div>
       
<span class="p-2 pb-0"></span>
    </div> 
</div>