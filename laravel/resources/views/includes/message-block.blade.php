@if (count($errors)>0)
  <div class="card alert alert-danger" role="alert" style="margin-top: 5.5rem" > 
  <div class="card-body">
  	 <ul>
  	   @foreach($errors->all() as $error )
  	     <li><i class="fa fa-pencil"></i> {{$error}}</li>
  	   @endforeach
  	 </ul>
  </div>
  </div>
  @endif
  @if(Session::has('message'))
    <div class="card alert alert-success" style="margin-top: 5.5rem"> 
  <div class="card-body">
        {{Session::get('message')}}
     </div>
    </div>
  @endif