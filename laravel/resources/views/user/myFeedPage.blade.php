@extends('layouts.master')

@section('title')
 
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}News feed
  @else
    News feed
  @endif
@endsection
@section('content')
  @include('includes.message-block')

      	<!--=======================DISPLAY FEED=======================-->
		<div class="col-12 col-md-12 m-0 p-0" id="news_feed-data">
      <!-- <div v-if="isLoading">
              <h4><strong>My Newsfeed working</strong></h4> -->
        <!-- =======================CREATE POST======================= -->
        <!-- <div class="card" >
            <div class="card-header">
                <span><i class="fas fa-edit"></i></span><span class="ml-2">this is the part that works</span>
            </div> -->
          <!--=============================CARD BODY=============================-->
            <!-- <div class="card-body p-0">
                    <div class="form-group row m-0">
                        <div class="col-8  m-0 p-0 pl-3 pt-2 pb-2 d-flex" style="height: 5.3rem;">
                            <div class="row m-0 p-0 other-fields">
                                

                            </div>
                        </div>
                        <div class="col-4 row m-0 p-0 d-flex"  > -->
                            
                            <!--=====================IMAGE==========================-->
                            <!-- <div class="col p-0 d-flex border-left border-right align-items-center">
                                <span  class="ml-auto mr-auto" id="image-section">
                                    <i class="fas fa-image fa-3x add-image" style="color:#ff7f50"></i>
                                </span>
                            </div> -->
                            <!--=====================VIDEO==========================-->
                            <!-- <div class="col p-0 d-flex  align-items-center " id="video-div" >
                                <span class="ml-auto mr-auto">
                                    <i class="fas fa-video fa-3x add-video" style="color:#ff7f50">
                                    </i>
                                </span>
                            </div>
                        
                        </div>
                    </div> -->
                
            <!--END CARD BODY-->
            <!-- <div class="card-footer row m-0"> -->
                <!--=======================EVENT=======================-->
                <!-- <div class="col form-check form-check-inline radios">
                    <input class="form-check-input radio-inline  align-self-center" type="radio" v-model="postType" id="event-radio" value="event" style="display:none" v-on:change="showmore">
                        <label class="form-check-label" for="event-radio">
                            <span class="d-none d-md-inline feed-radio">
                                <i class="fas fa-calendar-alt fa-1x feed-radio-icon" id="event-radio"></i>
                            </span>
                            <strong class="ml-2">
                                Event
                            </strong>
                        </label>
                </div> --><!--END EVENT  -->
                <!--=======================BURSARY=======================-->
                <!-- <div class="col form-check form-check-inline radios" >
                    
                    <label class="form-check-label" for="bursary-radio">
                    <span class="d-none d-md-inline feed-radio">
                        <i class="fas fa-piggy-bank fa-1x feed-radio-icon" id="bursary-radio"></i>
                    </span>
                    <strong class="ml-2">
                        Bursary
                    </strong>
                </label>
                </div> --><!-- END BURSARY -->
                <!--=======================STUDENT AWARD=======================-->
                <!-- <div class="col d-flex align-items-center">
                    <span style="border: solid grey 1px;border-radius: 7rem;padding: 0.5rem 0.80rem;background-color:#ffffff">
                        <i class="fas fa-award fa-1x" style="display:inline;color:#70a0f2"></i>
                    </span>
                    <strong class="ml-2">
                    Award
                    </strong>
                </div> -->
                <!--=======================NEED=======================-->
               <!--  <div class="col form-check form-check-inline radios" >
                  
                    <label class="form-check-label" for="need-radio">
                    <span class="d-none d-md-inline feed-radio">
                        <i class="fas fa-hand-holding-heart  fa-1x feed-radio-icon" id="need-radio"></i>
                    </span>
                    <strong class="ml-2">
                    Need
                    </strong>
                </label>
                </div> --><!-- END NEED -->
                <!--=======================COLLAPSE SECTION=======================-->
            <!--     <div class="col-12 collapse " id="more">
                    <input type="hidden" name="_token" value="csrf_token()">
                    <button type="submit"  class="btn btn-primary btn-sm d-flex mt-2  ml-auto">Post</button>
                </div>
            </div>

            </div>
        </div> -->
        <!--=======================LOADER PLACE HOLDER=======================-->
 <!--    <div class="card col-12  ajax-load text-center mt-2 p-0 post-card">
       
          <div class="ph-item">
            <div class="ph-col-12">
              <div class="ph-picture"></div>
              <div class="ph-row">
                <div class="ph-col-4"></div>
                <div class="ph-col-8 empty"></div>
                <div class="ph-col-12"></div>
              </div>
            </div>
            <div class="ph-col-2">
              <div class="ph-avatar"></div>
            </div>
            <div>
              <div class="ph-row">
                <div class="ph-col-12"></div>
                <div class="ph-col-2"></div>
                <div class="ph-col-10 empty"></div>
                <div class="ph-col-8 big"></div>
                <div class="ph-col-4 big empty"></div>
              </div>
            </div>
          </div> -->
   
 <!--  <p><img src="{{URL::asset('/assets/img/loader.gif')}}">Loading More post</p>
 -->
<!-- </div>
      </div> -->
  	<feed :posts="{{$news_feed}}" auth_id="{{$userIdNo->id}}" usable_type="{{Auth::user()->usable_type}}" v-bind:user="{{Auth::user()}}"></feed>
		</div>


		<!--=======================LOADER PLACE HOLDER=======================-->
		<div class="card col-12  ajax-load text-center mt-2 post-loading-card">
       
          <div class="ph-item">
            <div class="ph-col-12">
              <div class="ph-picture"></div>
              <div class="ph-row">
                <div class="ph-col-4"></div>
                <div class="ph-col-8 empty"></div>
                <div class="ph-col-12"></div>
              </div>
            </div>
            <div class="ph-col-2">
              <div class="ph-avatar"></div>
            </div>
            <div>
              <div class="ph-row">
                <div class="ph-col-12"></div>
                <div class="ph-col-2"></div>
                <div class="ph-col-10 empty"></div>
                <div class="ph-col-8 big"></div>
                <div class="ph-col-4 big empty"></div>
              </div>
            </div>
          </div>
   
 <!--  <p><img src="{{URL::asset('/assets/img/loader.gif')}}">Loading More post</p>
 -->
</div>



 @endsection
 @section('scripts')

@endsection