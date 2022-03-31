@extends('layouts.master')

@section('title')

@if(isset($numberMessages)){{'('.$numberMessages.')'}}Schools
@else
Schools
@endif
@endsection


@section('content')
@include('includes.message-block')




<div class="card card-custom d-flex mt-2 institution" > 
  <div class="card-header">
    <h5><i class="fas fa-university" style="color: #8b4513"></i><span class="ml-1">Schools</span></h5>
  </div>
</div>
    <schools-page ref="schoolspage" v-bind:post="{{$schools}}" v-bind:shared="false"></schools-page>





<!--<script>
  $( document ).ajaxStart(function() {
    //$('.ajax-load').show();
    $('.ajax-load').fadeIn();
    
  console.log( "Triggered ajaxStart handler." );
});


  var page =1;
  $(document).ready(function(){

  $(window).scroll(function() {

      if($(window).scrollTop() + $(window).height() >= $(document).height()) {

          page++;

          loadMoreData(page);

      }

  });

});

  function loadMoreData(page){

    $.ajax(

          {

              url: '?page=' + page,

              type: "get",

              beforeSend: function()

              {
                  /*setTimeout(function(){ 
                    console.log("setting timeout"+page);
                    $('.ajax-load').show(); }, 30000);
                  */
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
              $("#schools-data").append($('ajax.load'));
              $("#schools-data").append(data.html);

          })

          .fail(function(jqXHR, ajaxOptions, thrownError)

          {

                alert('server not responding...');

          });

  }

$(document).on('click','.show-photo',function(event){
$('#PostPicCarousel-modal').modal();
});
  
</script>-->



@endsection