$(document).on('click','.bursary-show-more',function(event){
	console.log("bursary show more");
	if($(event.target.parentNode.parentNode).find(".bursary-information").css("overflow") == "hidden")
	{
		$(event.target.parentNode.parentNode).find(".bursary-information").css({"overflow": "unset", "max-height": "none"});
	}
	else
	{
		$(event.target.parentNode.parentNode).find(".bursary-information").css({"overflow": "hidden", "max-height": "8rem"});
	}
	
	
});

$(document).on('click','#add-requirement',function(event){
	var textarea = $(event.target.parentNode).prev().find('textarea');
	if(textarea.val() != "") 
	{
		$('#requirement_div').append('<div class="col-4"><i class="fas fa-check-circle"></i>'+textarea.val()+'<input type="hidden" name="requirements[]" value="'+textarea.val()+'"></div>');
		textarea.val('');
	}
});

$(document).on('click','#save-changes',function(){
   $('#bursary-form-submit').trigger("click");
});

$(document).on('click','.show-photo',function(event){
	var bursary_ = JSON.parse($(event.target).attr('data-bursary'));
	var requirements = JSON.parse($(event.target).attr('data-requirements'));
	var req ='';
	requirements.forEach(function(ele){
		req = req +'<span class="badge badge-pill badge-primary">'+ ele.requirement + '</span> ,';
	});
	console.log(requirements);
	var studentsImages = document.getElementById("student-pictures-"+bursary_.id);

	studentsImages.innerHTML = '';
	studentsImages.innerHTML += '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" id="first-slide-'+bursary_.id+'" alt="First slide" ></div>';
 	$('#first-slide-'+bursary_.id).prop('src',(value=$(event.target).attr('src')));
 	document.getElementById("post-text-"+bursary_.id).innerHTML='<h4>'+bursary_.title+'</h4><p>'+
 	bursary_.description+'</p><ul>'+
 	'<li><strong>Closing Date:</strong> '+bursary_.closing_date+'</li>'+
 	'<li><strong>Sector:</strong> '+bursary_.sector+'</li>'+
 	'<li><strong>Positions available:</strong> '+bursary_.positions_available+'</li>'+
 	'<li><strong>Requirements :</strong> '+req+'</li>'
 	'</ul>';
	$('#PostPicCarousel-modal-'+bursary_.id).modal();
});

