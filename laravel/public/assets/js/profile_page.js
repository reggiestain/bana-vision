//***************************STUDENTS PROJECT CLICKED  **********************************************************
/*
*  this function displays the student project details using 
*  the viewPostPicModal  
*
*/
/*$(document).on('click','.show-photo',function(event){
 console.log("starting carousel ");
 



 var studentsImages = document.getElementById("student-pictures");
 var postText = document.getElementById("post-text");
 studentsImages.innerHTML = '';

 studentsImages.innerHTML += '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" id="first-slide" alt="First slide" ></div>';

 $('#first-slide').prop('src',(value=$(event.target).attr('src')));
 console.log($('#first-slide').attr('src'));
 var projectName = this.dataset['project_name'];
 //set the post body 
 document.getElementById("post-text").innerHTML='<p>'+this.dataset['body']+'</p>';

 //populate the carousel with each students information
 for (var i = 0; i < students.length; i++) 
 {

  if(students[i].project_id == project_id ) //ensure student is a participant in this project
  {
    //set the student images source link
    studentsImages.innerHTML += '<div class="carousel-item"><a href="'+students[i].route+'"><img class="d-block img-fluid mx-auto" src="'+students[i].img_src+'" alt="Third slide"></a></div>';
    $('#carouselExampleIndicators').on('slide.bs.carousel', function() {
      console.log($('div.active').index() + 1);
      currentIndex = $('div.active').index() + 1;
    });
    console.log('true');
    console.log('"');
    console.log(currentIndex);
    console.log('"');
    document.getElementById("post-text").innerHTML='<h6><strong>'+students[i].name+'</strong></h6><br><br><p> is one of the participants in this project</p>';
  }

}
//display the modal
$('#PostPicCarousel-modal').modal();
});

$(document).on('click','#create-school-student-attendance',function(event){
  $('#add-school-student-attendance-modal').modal();
});

//Edit curriculumn subject
$(document).on('click','#edit-curriculumn-subject',function(event){
  $('#add-curriculumn-subject-modal').modal();
  $('#curriculumn-subject-form').attr('action', edit_route);
  $('#subject').val($(event.target).attr('data-subject'));
  $('#grade').val($(event.target).attr('data-grade'));
  $('#has_practicals').val($(event.target).attr('data-hasPracticals'));
  $('#description').val($(event.target).attr('data-description'));
  $('#curriculumn-subject-modal-title').html('Edit subject');

});*/

//trigger the file uploader when add button clicked
$(document).on('click','#add-video-option',function(event){
 $('#video-input').trigger('click'); 
});

$(document).on('change','#video-input',function(event){
  $('#add-video-modal').modal();
});

$(document).on('click','.video-image',function(event){
  console.log($(event.target).attr('src'));
  var vid_canvas = document.getElementById("student-pictures");
  vid_canvas.innerHTML = '<video controls style="width:100%;height:360px;" poster="'+$(event.target).attr('src')+'">'+
  '<source src="'+$(event.target).attr('data-video')+'" type=\'video\/mp4;codecs="avc1.42E01E, mp4a.40.2"\' \/>'+
  '<track src="devstories-en.vtt" label="English subtitles" kind="subtitles" srclang="en" default></track>'+
'</video>';
  $('#PostPicCarousel-modal').modal();
});

//***************************SHOW FULLSCREEN PICTURE**********************************************************
     $(document).on('click','.show-fullscreen',function(event){


        event.preventDefault();
        console.log('Are working');
        console.log(event.target.dataset['src']);
        $('#fullscreen-image').attr('src', event.target.dataset['src']);
        $('#show-fullscreen-modal').modal();
     })