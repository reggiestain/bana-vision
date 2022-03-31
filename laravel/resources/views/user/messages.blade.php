@extends('layouts.master')

@section('title')

@if(isset($numberMessages)){{'('.$numberMessages.')'}}Messages
  @else
  Messages
  @endif
@endsection

@section('content')
@inject('user', 'App\User')
  @include('includes.message-block')
 
    <div class="container-fluid" style="padding:3px;padding-top:0">
    <!-- MESSAGES MENU-->

  
    <!--END MESSAGES MENU-->
    <!--MESSAGES MENU-->
    <div role="tabcard" class="tab-pane active" id="overview">
      <div class="card">
            <nav>
              <div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
                <div class="pb-0 p-3  col-12" style="padding-bottom: 0 !important">
                  <h4  style="display: inline;">
                    <i class="fas fas1 fa-hourglass-half"></i>
                      Overview
                  </h4>
                  <!--Add videos-->
                  <a class="p-1"  style="float: right !important"  role="button" id="videos-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-plus" style="color: #c5c7cb"></i>
                  </a>
                  <!--Add videos dropdown-->
                  <div class="dropdown-menu" aria-labelledby="videos-dropdown">
                    <a class="dropdown-item" href="#" id="add-video-option">
                      <i class="fas fa-plus"> Add video</i>
                    </a>
                  </div>
                  <!---->
                  <a class="p-1"  style="float: right !important">
                    <i class="fas fa-wrench" style="color: #c5c7cb"></i>
                  </a>
                  <a class="p-1"  style="float: right !important">
                    <i class="fas fa-cog" style="color: #c5c7cb"></i>
                  </a>
                </div>
                <a class="nav-item nav-link active gallery-link " id="4" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="true" style="padding: 0.5rem 1.25rem !important">
                  <i class="fas fas1 fa-envelope">
                  </i>
                  Messages
                </a>


                <a class="nav-item nav-link gallery-link p-2" id="5"  data-toggle="tab" href="#compose" role="tab" aria-controls="compose" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
                  <i class="fas fas1 fa-user-friends "></i>
                  Followed By
                </a>

                <a class="nav-item nav-link gallery-link p-2" id="6" href="#email" data-toggle="tab" aria-controls="email" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
                  <i class="fas fas1 fa-envelope-square"></i>
                  Email
                </a>

              </div>
          </nav>


          <div class="tab-content card-body p-0" id="nav-tabContent">
            <div class="tab-content card-body p-0" id="nav">
       

           <!--=======================INBOX=======================--> 
 <div class="row tab-pane active" id="messages" role="tabpanel" >
            <div class="col-md-12 col-lg-12">
             @if(isset($userIdNo->messages))
              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th>
                            Message
                          </th>
                          <th>
                            From
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                   @foreach($messages as $counter=>$message)
                      <tr data-messageseenid="{{$message->id}}">
                          <td class="message" data-messagebody="{{$message->body}}">
                            <div style="width:60px;height:20px;overflow:hidden">
                              {{$message->body}}
                            </div>  
                          </td>
                          <td>
                            {{$message->name}}
                          </td>
                          <td>
                            {{$message->created_at}}
                          </td>
                          <td>
                            <a href="{{route('deleteMessages',['messageId'=>$message->id])}}">
                              <i class="fa fa-trash delete-msg"></i>
                            </a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              @else
              <h1>You have no messages </h1>
              @endif
            </div>

             <div class="col mt-2 d-flex ml-auto mr-auto">
              {{$messages->links()}}
             </div>
            <!-- <div class="well col-md-12 col-lg-12" style="width:100%;height:300px;overflow-y:scroll;overflow-x:hidden;word-break:break-all;background-color: #f0f0f0" id="paste-message"> 
                
            </div>-->
        
        </div><!--end messages-->
       

        <!--=======================COMPOSE=======================-->
        <div class="row tab-pane" id="compose" role="tabpanel">
          <form action="{{route('sendMessage')}}" method="post"> 
           <div class="form-group {{$errors->has('institution') ? 'has-error':''}}" style="padding-left:6px;padding-right:6px" id="institution_div">
             <label for="recipient" style="display:block;">
              To:
             </label>
             <input name="recipient" class="form-control flexdatalist" placeholder='search your contact list'  list="recipients"  multiple=''  data-min-length='1' data-selection-required='1' type="text">
             <datalist id="recipients">
              @foreach($contactList as $contact)
              <option value="{{$contact->id}}">
                {{$contact->name}}
              </option>

              @endforeach
            </datalist>
          </div> 

          <div class="form-group {{$errors->has('body') ? 'has-error':''}}" id="body_div" style="padding:6px">
           <label for="message">
            Message:
           </label>
           <textarea class="form-control" name="body" id="body" style="padding-left:3px;padding-right:3px;padding-bottom:0;margin-bottom:0;width:100%;height:300px;overflow-y:scroll;overflow-x:hidden;word-break:break-all" value="{{Request::old('about')}}"> 
           </textarea>
         </div>

         <button type="submit" class="btn btn-primary btn-sm" style="align:centre">
          Send Message
         </button> 
         <input type="hidden" name="_token" value="{{Session::token()}}">

       </form> 
     </div><!--end compose-->


          <!--=================================================EMAIL==============================================-->
          <div class="tab-pane fade col-12 p-2 container-fluid" id="email" role="tabpanel" aria-labelledby="cover-photos-tab" >
              <div id="cover-photo-data">
                <table class="table table-hover">
                  <tbody>
                   @foreach($emails as $email)
                      <tr data-messageseenid="{{$message->id}}">
                          <td class="message" data-messagebody="{{$email->getHTMLBody(true)}}">
                            <div style="height:20px;overflow:hidden">
                              {!!$email->getFrom()[0]->mail!!}
                            </div>  
                          </td>
                          <td>
                            {!!$email->getSubject()!!}
                            {!!$email->getAttachments()!!}
                          </td>
                          <td>
                            <a href="{{route('deleteMessages',['messageId'=>$message->id])}}">
                              <i class="fa fa-trash delete-msg"></i>
                            </a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>

              <div class="well col-md-12 col-lg-12" style="width:100%;height:300px;overflow-y:scroll;overflow-x:hidden;word-break:break-all;background-color: #f0f0f0" >
                <div id="paste-message"></div>
                <div class="btn-group  mt-2" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary">Left</button>
  <button type="button" class="btn btn-secondary">Middle</button>

</div>
              </div>
            </div>
          </div><!--end email-->

      
      </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
  var setMessageSeen = '{{route('setMessageSeen')}}';
  var token = '{{Session::token()}}';
</script>

 @endsection


