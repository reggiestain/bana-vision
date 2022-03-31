       <!--=============================================================================  -->

        @if ($post->comments->count()!=0 || $post->likes->count()!=0)
        <div class=" d-flex align-self-center pl-3" style="padding-top: 0.5rem;">
       
          @if($post->comments->count()!=0)
          {{$post->comments->count()}}
          <a data-toggle="collapse" href="#comments-collapse-{{$key}}" role="button" aria-expanded="false" aria-controls="comments-collapse-{{$key}}">
             <span style="margin: 0 0.5rem">Comments</span>
          </a>
         
          @else

          @endif
          
        
          
          @if($post->likes->count()!=0)
            {{$post->likes->count()}}
          <span style="margin: 0 0.5rem">Likes</span>
          @else

          @endif
          

          @if($post->shares->count()!=0)
            {{$post->shares->count()}}
          <span style="margin: 0 0.5rem">Shares</span>
          @else

          @endif
          

      </div>
      @endif
      <!--==========================ICONS FOR EDITNG post==========================-->
      <div class=" d-flex align-self-center border-top border-bottom p-0" style="margin-bottom: -1.25rem;">
        @if (Auth::user()) 
         <!-- COMMENT post -->
        
          <a  class="col p-2 pl-4 pr-4 hvr" style="display:inline;padding-left : 15px;text-align: center;" data-commentableid="{{$post->id}}" data-toggle="collapse" href="#comments-collapse-{{$key}}" role="button" aria-expanded="false" aria-controls="comments-collapse-{{$key}}">
         
            <i class="fa fa-comment comment edit_pen">
            </i>
            <span class="ml-1">
              Comment
            </span>
          </a>
        
        <!-- LIKE post -->
        
          <a  class="col p-2 pl-4 hvr" href="{{route('createLike',['likeableId'=>$post->id])}}" style="display:inline;padding-left : 15px;text-align: center;" >
            <i class="fa  fa-thumbs-up ">
            </i>
            <span class="ml-1">
              Like
            </span>
          </a>
      @else
        <!-- COMMENT post -->
          <a  class="col p-2 pl-4 hvr" style="display:inline;padding-left : 15px;text-align: center;" data-toggle="collapse" href="#comments-collapse-{{$key}}" role="button" aria-expanded="false" aria-controls="comments-collapse-{{$key}}" >
            <i class="fas fa-comment">
            </i>
            <span class="ml-1">
              Comment
            </span>
          </a>


        <!-- LIKE post -->
          <a  class="col p-2 pl-4 hvr" href="#" style="display:inline;padding-left : 15px;text-align: center;">
            <i class="fa fa-thumbs-up ">
            </i>
            <span class="ml-1">
              Like
            </span>
          </a>
      @endif 

       <!-- SHARE post -->
          <a  class="col p-2 pl-4 hvr" href="{{route('sharePost',['shareable_id'=>$post->id,'shareable_type'=>get_class($post)])}}" style="display:inline;padding-left : 15px;text-align: center;" data-commentableid="{{$post->id}}">
            <i class="fa fa-share comment edit_pen">
            </i>
            <span class="ml-1">
              Share
            </span>
          </a> 
      </div>

      

      <!--==========================COMMENTS==========================-->
      <div class="collapse mt-2" id="comments-collapse-{{$key}}" style="padding: 0.5rem">
        <!-- COMMENT TO BE ADDED HERE -->
        <div><h1></h1></div>
     
      <comments post_id="{{$post->id}}" post_type="{{get_class($post)}}" @auth auth_id="{{Auth::id()}}" @endauth></comments>
   <div>
      @auth
        <form  action="{{route('createComment')}}" method="POST" enctype="multipart/form-data">
        <img class="mr-3 image-fluid rounded-circle " src="@auth{{route('getProfilePic',['filename'=>Auth::user()->id])}}@endauth" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >
        <input type="text" class="form-control form-control-sm col-10" style="display: inline;border-radius: 2rem;"  type="text" name="body" placeholder="make opinion ...">
        <input type="hidden"  name="commentableId" value="{{$post->id}}"> 
        <input type="hidden" name="commentable_type" value="{{get_class( $post  ) }}">
        <input type="hidden"  name="_token" value="{{{csrf_token()}}}"> 
        <input type="submit" value="Submit" style="display: none">
      </form>
      @endauth
      </div>
 </div>