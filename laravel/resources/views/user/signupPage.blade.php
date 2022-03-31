@extends('layouts.master')

@section('title')
  Welcome
@endsection

@section('content')
  @include('includes.message-block')
<!-- SIGN UP-->
  
<div class="panel panel-default panel-custom " style="padding:0;padding-top:0;margin-top:-45px"> 
<div class="panel-heading panel-heading-custom"> 
<h3 class="panel-title">Sign Up</h3>
 </div> <div class="panel-body">    
     <form action="{{route('signup')}}" method="post">
         <div class="form-group">
           <label for="party">Party:</label>
           <select class="form-control" id="party" name="party">
              <option value="Student">Student</option>
              <option value="Company" selected="selected">Company</option>
              <option value="School">School</option>
              <option value="Organization">Organization</option>
           </select>
         </div>
 
          <div class="form-group  {{$errors->has('name') ? 'has-error':''}}" id="name_div">
           <label for="name">Name:</label>
           <input class="form-control" type="text" name="name" id="name" value="{{Request::old('name')}}">  
         </div>

          <div class="form-group" id="gender_div">
           <label for="gender">Gender:</label>
           <select class="form-control" id="gender" name="gender">
              <option value="Male">Male</option>
              <option value="Female" selected="selected">Female</option>
           </select>
         </div>
        
         <div class="form-group {{$errors->has('birthdate') ? 'has-error':''}}" id="birthdate_div">
           <label for="email">birth date:</label>
           <input class="form-control" type="text" name="birthdate" id="birthdate" value="{{Request::old('birthdate')}}">  
         </div> 


         <div class="form-group {{$errors->has('email') ? 'has-error':''}}" id="email_div">
           <label for="email">E-mail</label>
           <input class="form-control" type="text" name="email" id="email" value="{{Request::old('email')}}">  
         </div> 

         

         <div class="form-group  {{$errors->has('institution') ? 'has-error':''}}" id="institution_div">
           <label for="institution" style="display:block;">Institution:</label>
           <input class="form-control" list="institution" name="institution" />
           <datalist id="institution">
            @foreach($schools as $school)
            <option value="{{$school->name}}">
              @endforeach 
            </datalist>
          </div> 

         <div class="form-group" id="sector_div">
           <label for="sector">Sector:</label>
           <select class="form-control" id="sector" name="sector">
              <option value="information technology">Information Technology</option>
              <option value="engineering" selected="selected">Engineering</option>
              <option value="finance">Finance</option>
              <option value="insurance">Insurance</option>
           </select>
         </div>

         <div class="form-group" id="province_div">
           <label for="province">Province:</label>
           <select class="form-control" id="province" name="province">
              <option value="eastern-cape">Eastern Cape</option>
              <option value="free-state" selected="selected">Free State</option>
              <option value="gauteng">Gauteng</option>
              <option value="kwazulu-natal">KwaZulu Natal</option>
              <option value="limpopo">Limpopo</option>
              <option value="mpumalanga">Mpumalanga</option>
              <option value="north-west">North West</option>
              <option value="northern-cape">Northern Cape</option>
              <option value="western-cape">Western Cape</option>
           </select>
         </div>
             

          <div class="form-group {{$errors->has('district') ? 'has-error':''}}" id="district_div">
           <label for="district">district:</label>
           <input class="form-control" type="text" name="district" id="country" value="{{Request::old('district')}}"> 
         </div> 

          <div class="form-group {{$errors->has('suburb') ? 'has-error':''}}" id="suburb_div">
           <label for="suburb">suburb:</label>
           <input class="form-control" type="text" name="suburb" id="country" value="{{Request::old('suburb')}}"> 
         </div> 

          <div class="form-group {{$errors->has('country') ? 'has-error':''}}" id="country_div">
           <label for="country">country:</label>
           <input class="form-control" type="text" name="country" id="country" value="{{Request::old('country')}}"> 
         </div>

          <div class="form-group {{$errors->has('k_12') ? 'has-error':''}}" id="k_12_div">
           <label for="k_12">k_12:</label>
           <input class="form-control" type="text" name="k_12" id="k_12" value="{{Request::old('k_12')}}"> 
         </div>  

          <div class="form-group {{$errors->has('coeducational') ? 'has-error':''}}" id="coeducational_div">
           <label for="coeducational">coeducational:</label>
           <input class="form-control" type="text" name="coeducational" id="coeducational" value="{{Request::old('coeducational')}}"> 
         </div>         

          <div class="form-group {{$errors->has('funding') ? 'has-error':''}}" id="funding_div">
           <label for="funding">Funding:</label>
           <input class="form-control" type="text" name="funding" id="funding" value="{{Request::old('funding')}}"> 
         </div>

       <div class="form-group {{$errors->has('pass_rate') ? 'has-error':''}}" id="pass_rate_div">
           <label for="pass_rate">pass rate:</label>
           <input class="form-control" type="number" min="30" max="100" name="pass_rate" id="pass_rate" value="{{Request::old('pass_rate')}}"> 
         </div>

       <div class="form-group {{$errors->has('special_needs') ? 'has-error':''}}" id="special_needs_div">
           <label for="special_needs">special needs:</label>
           <input class="form-control" type="text" name="special_needs" id="special_needs" value="{{Request::old('special_needs')}}"> 
         </div> 

       <div class="form-group {{$errors->has('about') ? 'has-error':''}}" id="about_div">
           <label for="password">About:</label>
           <textarea class="form-control" name="about" id="about" value="{{Request::old('about')}}"> </textarea>
         </div> 
      
      <div class="form-group {{$errors->has('history') ? 'has-error':''}}" id="history_div">
     
           <label for="history">History:</label>
           <textarea class="form-control"  name="history" id="history" value="{{Request::old('history')}}"> </textarea>
         </div> 
       
    
        <div class="form-group {{$errors->has('principal') ? 'has-error':''}}" id="principal_div">
           <label for="principal" >Principal:</label>
           <input class="form-control" type="text" name="principal" id="principal" value="{{Request::old('principal')}}"> 
         </div> 

        <div class="form-group {{$errors->has('number_students') ? 'has-error':''}}" id="number_students_div">
           <label for="number_students">Number students:</label>
           <input class="form-control" type="number" min="100" name="number_students" id="number_students" value="{{Request::old('number_students')}}"> 
         </div> 

        <div class="form-group {{$errors->has('number_teachers') ? 'has-error':''}}" id="number_teachers_div">
           <label for="number_teachers">Number teachers:</label>
           <input class="form-control" type="number" min="1" name="number_teachers" id="number_teachers" value="{{Request::old('number_teachers')}}"> 
         </div> 
          
         <div class="form-group {{$errors->has('password') ? 'has-error':''}}" id="password_div">
           <label for="password">Password:</label>
           <input class="form-control" type="password" name="password" id="password" value="{{Request::old('password')}}"> 
         </div> 

         <div class="form-group {{$errors->has('address') ? 'has-error':''}}" id="address_div">
           <label for="address">Address</label>
           <input class="form-control" type="text" name="address" id="address" value="{{Request::old('address')}}">  
         </div> 
          
         <div class="form-group {{$errors->has('web_url') ? 'has-error':''}}" id="website_div">
           <label for="web_url">website</label>
           <input class="form-control" type="text" name="website" id="website" value="{{Request::old('website')}}">  
         </div> 

          <div class="form-group {{$errors->has('telephone') ? 'has-error':''}}" id="telephone_div">
           <label for="telephone">Telephone:</label>
           <input class="form-control" type="text" name="telephone" id="telephone" value="{{Request::old('telephone')}}">  
         </div> 

          <button type="submit" class="btn btn-primary">Submit</button> 
          <input type="hidden" name="_token" value="{{Session::token()}}">

      </form>  
 </div> 
 </div>

<script>
    $(document).ready(function(){ 
      console.log("hi");
        $("#party").change(function(){
            $( "#party option:selected").each(function(){
                if($(this).attr("value")=="Student"){
                    $("#address_div").hide();
                    $("#website_div").hide();
                    $("#telephone_div").hide();
                    $("#institution_div").show();
                    $("#gender_div").show();
                    $("#birthdate_div").show();
                    $("#sector_div").hide();
                    $("#special_needs_div").hide();
                    $("#pass_rate_div").hide();
                    $("#funding_div").hide();
                    $("#coeducational_div").hide();
                    $("#k_12_div").hide();
                    $("#number_students_div").hide();
                    $("#number_teachers_div").hide();
                    $("#principal_div").hide();
                    $("#history_div").hide();
                    $("#about_div").hide();
                    $("#district_div").hide();
                    $("#province_div").hide();
                    $("#suburb_div").hide();
                    $("#country_div").hide();



                    console.log("hide");
                } else if ($(this).attr("value")=="Company")
                  {
                      $("#sector_div").show();
                       $("#address_div").show();
                    $("#website_div").show();
                    $("#telephone_div").show();
                    $("#institution_div").hide();
                    $("#gender_div").hide();
                    $("#birthdate_div").hide();
                     $("#special_needs_div").hide();
                    $("#pass_rate_div").hide();
                    $("#funding_div").hide();
                    $("#coeducational_div").hide();
                    $("#k_12_div").hide();
                    $("#number_students_div").hide();
                    $("#number_teachers_div").hide();
                    $("#principal_div").hide();
                    $("#history_div").hide();
                    $("#about_div").hide();
                    $("#district_div").hide();
                    $("#province_div").hide();
                    $("#suburb_div").hide();
                    $("#country_div").hide();

                  }


                else if ($(this).attr("value")=="School")
                {
                    $("#address_div").show();
                    $("#website_div").show();
                    $("#telephone_div").show();
                    $("#institution_div").hide();
                    $("#gender_div").hide();
                    $("#birthdate_div").hide();
                    $("#sector_div").hide();
                    $("#special_needs_div").show();
                    $("#pass_rate_div").show();
                    $("#funding_div").show();
                    $("#coeducational_div").show();
                    $("#k_12_div").show();
                    $("#number_students_div").show();
                    $("#number_teachers_div").show();
                    $("#principal_div").show();
                    $("#history_div").show();
                    $("#about_div").show();
                    $("#district_div").show();
                    $("#province_div").show();
                    $("#suburb_div").show();
                    $("#country_div").show()
                    console.log("show");                 
                }
            });
        }).change();
    });
</script>
 
  
@endsection
