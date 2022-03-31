    var postId = 0;
    var postBodyElement = null;
    $(document).ready(function(){
     console.log("im connected");
    /*$('.profile-container').find('profile-info').find('a').eq(0).on('click',function(event){
    //$('#edit-modal').modal();
    console.log('it works');
});*/
     $(document).on('click','.myclass',function(event){
     	event.preventDefault();
        postBodyElement = event.target.parentNode.parentNode.children[0].children[1];
     	var postBody = postBodyElement.textContent;
     	postId = event.target.parentNode.parentNode.dataset['postid'];
        $('#post-body').val(postBody);
        $('#edit-modal').modal();
     });
});

$(document).on('click','#modal-save',function(){
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: { body: $('#post-body').val(),postId:postId,_token:token}
	})
     .done(function (msg){
     	$(postBodyElement).text(msg['new_body']);
     	$('#edit-modal').modal('hide');
     });
});

$(document).on('click','.like',function(event){
	var isLike = event.target.previousElementSibling == null ? true : false;
	postId = event.target.parentNode.parentNode.dataset['postid'];
     $.ajax({
     	method : 'POST',
     	url : urlLike,
     	data : {isLike:isLike, postId:postId,_token:token}
     }).done(function(){
     	//change page
     });	
     });
