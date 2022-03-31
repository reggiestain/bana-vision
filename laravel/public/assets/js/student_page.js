//***************************STUDENTS PROJECT CLICKED  **********************************************************
/*
*  this function displays the student project details using 
*  the viewPostPicModal  
*
*/
$(document).on('click','.show-featured-photo',function(event){

	var featured_ = JSON.parse($(event.target).attr('data-featured'));
	console.log(featured_.school_student.name);
document.getElementById("collapseFeaturedBody"+$(event.target).attr('data-keyb')).innerHTML=
/*'<img class="rounded-circle ml-auto mr-auto" style="width:7rem" src="'+$(event.target).attr('src')+'" alt="">'+*/
'<h6 style="text-align:center;margin:0.75rem"><strong>'+featured_.school_student.name+'\'s  Achievements</strong></h6>'+
	'<p style="text-align:center">'+featured_.achievements+'</p>';
/* console.log("starting carousel ");

 var studentsImages = document.getElementById("student-pictures");
 var postText = document.getElementById("post-text");
 studentsImages.innerHTML = '';

 studentsImages.innerHTML += '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" id="first-slide" alt="First slide" ></div>';

 $('#first-slide').prop('src',(value=$(event.target).attr('src')));
 console.log($('#first-slide').attr('src'));
 var projectName = this.dataset['awardBody'];
 //set the post body 
 document.getElementById("post-text").innerHTML='<p>'+$(this).data('awardbody')+'</p>';

//display the modal
$('#PostPicCarousel-modal').modal();*/
});
//show details on the student award collapse
$(document).on('click','.show-award-photo',function(event){

	var award_ = JSON.parse($(event.target).attr('data-award'));
	console.log(award_);
document.getElementById("collapseAwardBody"+$(event.target).attr('data-keya')).innerHTML=
/*'<img class="rounded-circle ml-auto mr-auto" style="width:7rem" src="'+$(event.target).attr('src')+'" alt="">'+*/
'<h6 style="text-align:center;margin:0.75rem"><strong>  Award</strong></h6>'+
	'<dl class="row">'+
	'<dt class="col-sm-4"><strong>Field :</strong></dt><dd class="col-sm-8">'+award_.field+'</dd>'+
	'<dt class="col-sm-4"><strong>Description :</strong></dt><dd class="col-sm-8">'+award_.description+'</dd>'+
	'<dt class="col-sm-4"><strong>Year :</strong></dt><dd class="col-sm-8">'+award_.year+'</dd>'+
	'<dt class="col-sm-4"><strong>Awarded By :</strong></dt><dd class="col-sm-8">'+award_.awarded_by+'</dd>'+
	'</dl>';

});

/*$(document).on('click','.show-project-photo',function(event){

	var project_ = JSON.parse($(event.target).attr('data-project'));
	var participants = JSON.parse($(event.target).attr('data-participants'));
	var p = '';
	participants.forEach(function(el){
		p = p + '<p>'+el.name+'</p><img src="">';
	});
	console.log(project_);
document.getElementById("collapseProjectBody"+$(event.target).attr('data-keyc')).innerHTML=
'<h6 style="text-align:center;margin:0.75rem"><strong>'+participants+'</strong></h6>'+
	'<dl class="row">'+
	'<dt class="col-sm-4"><strong>Name :</strong></dt><dd class="col-sm-8">'+project_.name+'</dd>'+
	'<dt class="col-sm-4"><strong>Description :</strong></dt><dd class="col-sm-8">'+project_.description+'</dd>'+
	'<dt class="col-sm-4"><strong>Date :</strong></dt><dd class="col-sm-8">'+project_.date+'</dd>'+
	'<dt class="col-sm-4"><strong>Category :</strong></dt><dd class="col-sm-8">'+project_.category+'</dd>'+
	'</dl>'+p;

});*/

$(document).on('click','#save-featured-student',function(event){
  $('#submit-featured-student').trigger('click');
  $('#featuredStudentModal').modal('hide');
});

$(document).on('click','#save-student-award',function(event){
  $('#submit-student-award').trigger('click');
  $('#studentAwardModal').modal('hide');
});


