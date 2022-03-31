@extends('layouts.master')

@section('title')
 
  @if(isset($numberMessages)){{'('.$numberMessages.')'}} Admin
  @else
    Admin
  @endif
@endsection

@section('content')
  @include('includes.message-block')
 
    <admin auth_id="{{Auth::id()}}" :useridno="{{$userIdNo}}" :students="{{$students->getCollection()}}" :staff="{{$staff->getCollection()}}"></admin>


 @endsection
 @section('scripts')
<script>
 //redirect to specific tab
 $(document).ready(function () {
 $('#tab-menu a[href="#{{ old('tab') }}"]').tab('show');
 $('#tab-menu a[href="#{{ session('tab') }}"]').tab('show');
 });

/***********************************************************************************************
* Lazily load the pages on a tab
***********************************************************************************************
*
*
*/
  var student =1;
  var teacher=1;
  var other=1;
  /*$(document).ready(function(){

  $(window).scroll(function() {

      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          if($(".nav-item.active.show").attr('id') == 'student-tab')
          {
            student++;
            loadMoreData(student,'student','#students-data');
          }
          else if ($(".nav-item.active.show").attr('id') == 'teacher-tab')
          {
            teacher++;
            loadMoreData(teacher,'teacher','#teachers-data');
          }
          else  if ($(".nav-item.active.show").attr('id') == 'other-photos-tab')
          {
            other++;
            loadMoreData(other,'other','#other-photo-data');
          }

      }

  });

});

  function loadMoreData(page,page_name,place_id){

    $.ajax(

          {

              url: '?'+page_name+'=' + page,

              type: "get",

              beforeSend: function()

              {
                  setTimeout(function(){ 
                    console.log("setting timeout"+page);
                    $('.ajax-load').show(); }, 30000);
                  
              }

          })

          .done(function(data)

          {

              if(data.html == " "){

                  $('.ajax-load').html("No more records found");

                  return;

              }

            // $('.ajax-load').hide();
              $('.ajax-load').fadeIn();
              $(place_id).append($('ajax.load'));
              $(place_id).append(data.html);

          })

          .fail(function(jqXHR, ajaxOptions, thrownError)

          {

                alert('server not responding...');

          });

  }


  var experience_div = '';
  $(document).on('click','#add-experience',function(event){
    console.log($('#curriculumn_id').val());
    experience_div = '<div class="form-group row m-0">'+
    '<label for="staticEmail" class="col-sm-3 col-form-label">Subject :</label>'+
    '<div class="col-sm-9">'+
      '<input type="text" readonly class="form-control-plaintext" placeholder="yeeeee" id="staticEmail" value="'+$('#curriculumn_id option:selected').text()+'">'+
      '<input type="hidden" name="curriculumn_id[]" value="'+$('#curriculumn_id').val()+'" >'+
    '</div>'+
  '</div>'+
//experience
  '<div class="form-group row m-0">'+
    '<label for="staticEmail" class="col-sm-3 col-form-label">Experience</label>'+
    '<div class="col-sm-9">'+
      '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'+$('#experience').val()+' years">'+
      '<input type="hidden" name="experience[]" value="'+$('#experience').val()+'">'+
    '</div>'+
  '</div><hr>';
    $('#experience-div').append(experience_div);
  });*/


</script>
@endsection
