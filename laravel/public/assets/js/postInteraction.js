$(document).on('click','.reply',function(event){
	var commentid = event.target.parentNode.dataset['commentid'];
	commentreply = "comment-reply"+commentid;
	console.log(commentreply);
	hiddenInputDiv = document.getElementById(commentreply);
$(hiddenInputDiv).show();
});


/*trigger image uploader*/
$(document).on('click','.input-add-image',function(event){
	var id = event.target.dataset['commentid'];
    $('#reply-picture'+id).trigger('click'); 
});

/*$(document).on('change','input[type=file]',function(event) {
var file = $(this)[0].files[0];
 console.log(file);
     var destination = $(event.target.parentNode.parentNode).find(".uploaded-image");
	 var reader = new FileReader();
	 reader.onload = function (e) {
	 	var img = new Image();
	 	img.className = "mr-3 image-fluid d-block rounded mt-1";
	 	img.style.width = "12.35rem";
	 	img.style.height = "12.35rem";
		img.src = e.target.result;
		destination.append(img);
	 }

	 reader.readAsDataURL(file);
	

	$($(event.target.parentNode.parentNode).find(".uploaded-image")).attr('src', $(event.target).val());
   
});*/