<!--ICONS FOR EDITNG interaction-->
      <div class=" d-flex align-self-center">
        @if (Auth::user())  
        @if(Auth::user()->name == $userIdNo->name)
        <!-- EDIT interaction  --> 
        <a href="#" data-interactionid="{{$interaction->id}}">
          <i class="fas fa-pen edit_pen  myclass">
          </i>
        </a>
        <!-- DELETE interaction -->
        <a style="display:inline;padding-left : 15px" data-link="{{route('deleteinteraction',['interactionIdNo'=>$interaction->id])}}" >
          <i class="fa fa-trash edit_pen">
          </i>
        </a>
        @endif  
        @endif 
        @if (Auth::user()) 
         <!-- COMMENT interaction -->
        <a style="display:inline;padding-left : 15px" data-commentableid="{{$interaction->id}}">
          @if($interaction->comments->count()!=0)
          {{$interaction->comments->count()}}
          @endif
          <i class="fa fa-comment comment edit_pen">
          </i>
        </span>
        </a>
        <!-- LIKE interaction -->
        <a href="{{route('createLike',['likeableId'=>$interaction->id])}}" >
          
          @if($interaction->likes->count()!=0)
          {{$interaction->likes->count()}}
          @endif
        <i class="fa  fa-thumbs-up ">
        </i>
      </a>
      @else
        <!-- COMMENT interaction -->
        <a style="display:inline;padding-left : 15px" >
          @if($interaction->comments->count()!=0)
          {{$interaction->comments->count()}}
          @endif
          <i class="fa fa-comment edit_pen">
          </i>
        </a>
        <!-- LIKE interaction -->
        <a href="#" >
          @if($interaction->likes->count()!=0)
          {{$interaction->likes->count()}}
          @endif
        <i class="fa fa-thumbs-up ">
        </i>
      </a>
      @endif  
      </div>

      <!--comments-->
       @foreach($interaction->comments as $key => $comment)
        <div class="media mt-3">
         <img class="mr-3 image-fluid rounded-circle " src="{{route('getProfilePic',['filename'=>$comment->user->name.'-profile'.$comment->user_id.'.jpg'])}}" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >
         <div class="media-body">
           <a href="{{route('SchoolProfilePage',['userIdNo'=>$comment->user_id])}}">
            <span >
              <h6 class="mt-0">
                {{$comment->user->name}}
              </h6>
            </span>
          </a>
          <div class="badge badge-pill p-2" style="white-space: normal;background-color: #f0f0f0;">
          {{$comment->body}}
           </div>
           <!--ICONS FOR EDITNG interaction-->
           <div class=" d-flex align-self-center align-items-center"  >
            <!-- EDIT COMMENT -->
            @if($comment->user->id == Auth::id())
            <a href="#" data-interactionid="{{$comment->id}}">
              <i class="fas fa-pen edit_pen  myclass">
              </i>
            </a>
            @endif
            <!-- DELETE COMMENT -->
            @if($comment->user->id == Auth::id())
            <a style="display:inline;padding-left : 15px" data-link="{{route('deleteComment',['commentIdNo'=>$comment->id])}}" >
              <i class="fas fa-trash edit_pen">
              </i>
            </a>
            @endif
            <!-- REPLY COMMENT -->
            <a style="display:inline;padding-left : 15px" data-commentid="{{$comment->id}}">
              
              @if($comment->replies->count()!=0)
                {{$comment->replies->count()}}
              @endif
              <i class="fas fa-reply edit_pen reply">
              </i>
            </a>
            <!-- LIKE COMMENT-->
            <a href="route('createLike',['likeableId'=>$interaction->id])" >
              <i class="fas fa-thumbs-up ">
              </i>
            </a>
          </div>
          <!-- COMMENT REPLIES  -->
          @foreach($comment->replies as $reply)
          <div class="media mt-3">
             <img src="{{route('getProfilePic',['filename'=>$reply->user->name.'-profile'.$reply->user_id.'.jpg'])}}" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >

           <div class="media-body">
            <a href="{{route('SchoolProfilePage',['userIdNo'=>$reply->user_id])}}">
            <span >
              <h5 class="mt-0">
              {{$reply->user->name}}
              </h5>
            </span>
          </a>
            
            <div class="badge badge-pill" style="white-space: normal;background-color: #f0f0f0;">
             {{$reply->body}}
           </div>
           <!--ICONS FOR EDITNG interaction-->
           <div class=" d-flex align-self-center align-items-center"  >
            <!-- EDIT REPLY-->
             @if($reply->user->id == Auth::id())
            <a href="#" data-interactionid="{{$reply->id}}">
              <i class="fas fa-pen edit_pen  myclass">
              </i>
            </a>
            @endif
            <!-- DELETE REPLY -->
            @if($reply->user->id == Auth::id())
            <a style="display:inline;padding-left : 15px" data-link="{{route('deleteReply',['replyIdNo'=>$reply->id])}}" >
              <i class="fas fa-trash edit_pen">
              </i>
            </a>
            @endif
            <!-- LIKE REPLY-->
            <a href="route('createLike',['likeableId'=>$reply->id])" >
              <i class="fas fa-thumbs-up ">
              </i>
            </a>
          </div>
           </div>
         </div>

         
        <!--  END REPLIES  -->
         @endforeach 
        </div>
      </div>
   @endforeach