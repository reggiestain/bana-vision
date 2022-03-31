    var postId = 0;
    var eventId = 0;
    var commentableId = 0;
    var postBodyElement = null;
    var eventNameElement = null;
    var eventDescriptionElement = null;
    var eventVenueElement = null;
    var eventDateElement = null;
    var eventTimeslotElement = null;
    var studentsProjectParticipants = [];
    var students = [];
    var urlDelete = null;

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






//***************************EDIT EVENTS  **********************************************************
     $(document).on('click','.myclass',function(event){
        console.log("im clicked");
        event.preventDefault();
        eventId = event.target.parentNode.dataset['eventid'];
  
       var eventName =$('#eventName-'+eventId).text();
       var eventDescription =$('#eventDescription-'+eventId).text();
       var eventVenue =$('#eventVenue-'+eventId).text();
       var eventDate =$('#eventDate-'+eventId).text();
       var eventTimeslot = $('#eventTimeslot-'+eventId).text();
       //console.log(eventName);
        
        //console.log(eventId);
        $('#event-name').val(eventName);
        $('#event-description').val(eventDescription);
        $('#event-venue').val(eventVenue);
        $('#event-date').val(eventDate);
        $('#event-timeslot').val(eventTimeslot);
        var value = '#'+ eventId;
        //console.log(value);
        $('#eventsEdit-modal').modal();
     });


//********************EDIT EVENTS SAVE CHANGES********************************************


$(document).on('click','#event-modal-save',function(){
  $.ajax({
    method: 'POST',
    url: urlEditEvent,
    data: { name: $('#event-name').val(),description: $('#event-description').val(),venue: $('#event-venue').val(),date: $('#event-date').val(),timeslot: $('#event-timeslot').val(),eventId:eventId,_token:token}
  })
     .done(function (msg){
      $(postBodyElement).text(msg['new_body']);
      var yes = $(eventNameElement).text(msg['new_eventName']);
      console.log(yes);
      $(eventDescriptionElement).text(msg['new_eventDescription']);
      $(eventVenueElement).text(msg['new_eventVenue']);
      $(eventDateElement).text(msg['new_eventDate']);
      $(eventTimeslotElement).text(msg['new_evetTimeslot']);
      $('#eventsEdit-modal').modal('hide');
      $.jGrowl("edited successfully!", { position: 'center' });
     });
});




//***************************CREATE COMMENTS   **********************************************************
 /*    $(document).on('click','.comment',function(event){
        console.log("im clicked");

        event.preventDefault();
        commentableId = event.target.parentNode.dataset['commentableid'];
  
      
        $('#comments-modal').modal();
        console.log(commentableId);
     })*/

     
//********************CREATE COMMENTS SAVE CHANGES********************************************


$(document).on('click','#comment-modal-save',function(){
  $.ajax({
    method: 'POST',
    url: urlAddComment ,

    data: { body: $('#comment-body').val(),commentableId:commentableId,_token:token}
  })
     .done(function (msg){
     
    
      
      $('#comments-modal').modal('hide');
      $.jGrowl("comment successfully added!", { position: 'center' });
     });
});

//***************************CREATE EVENT   **********************************************************
     $(document).on('click','#add-event',function(event){

        event.preventDefault();

  
      
        $('#add-event-modal').modal();
        console.log(commentableId);
     })


//********************trigger registration submit button clicked********************************************


$(document).on('click','#submit-picture',function(){
    console.log('uplod pic');
    $('#submit-picture-button').trigger('click'); 
});


/*//***************************CREATE REPLIES   **********************************************************
     $(document).on('click','.reply',function(event){
        console.log("im clicked");

        event.preventDefault();
        commentId = event.target.parentNode.dataset['commentid'];
  
      
        $('#replies-modal').modal();
        console.log(commentableId);
     })


//********************CREATE REPLIES SAVE CHANGES********************************************


$(document).on('click','#reply-modal-save',function(){
  $.ajax({
    method: 'POST',
    url: urlAddReply ,

    data: { body: $('#reply-body').val(),commentId:commentId,_token:token}
  })
     .done(function (msg){
     
    
      
      $('#reply-modal').modal('hide');
      $.jGrowl("comment successfully added!", { position: 'center' });
     });
});
*/


//***************************CREATE MESSAGE   **********************************************************
     $(document).on('click','.send-message',function(event){
        console.log("im clicked");

        event.preventDefault();
        recipientId = event.target.parentNode.dataset['recipient'];
  
      
        $('#messages-modal').modal();
        console.log(recipientId);
        console.log(urlAddMessage);
     })


//********************CREATE COMMENTS SAVE CHANGES********************************************


$(document).on('click','#messages-modal-save',function(){
  $.ajax({
    method: 'POST',
    url: urlAddMessage ,

    data: { body: $('#messages-body').val(),recipient:recipientId,_token:token}
  })
     .done(function (msg){
     
    
      
      $('#messages-modal').modal('hide');
      $.jGrowl("comment successfully added!", { position: 'center' });
     });
});


//***************************DELETE EVENT  **********************************************************
     $(document).on('click','.fa-trash',function(event){
      //set the delete link from the parent data attribute 
      urlDelete = event.target.parentNode.dataset['link'];
      
      $('#comfirmation-modal').modal();
       
     });


     $(document).on('click','.delete-msg',function(event){
      
      console.log('delete-msg clicked');
       
     });
     //********************DELETE EVENT SAVE CHANGES********************************************


$(document).on('click','#comfirmation-modal-delete',function(){

  var back = window.location.href;
 //var deleteUrl = ;
  $.ajax({
    method: 'GET',
    url: urlDelete ,

    data: { body: $('#comment-body').val(),commentableId:commentableId,_token:token}
  })
     .done(function (msg){
     
    
      
      $('#comfirmation-modal').modal('hide');
      window.location.assign(back);
      $.jGrowl("successfully deleted !", { position: 'center' });
     });
});



//***************************DELETE USER  **********************************************************
     $(document).on('click','#delete-user',function(event){
      
      $('#user-account-comfirmation-modal').modal();
       
     });

     //********************DELETE USER SAVE CHANGES********************************************


$(document).on('click','#user-comfirmation-modal-delete',function(){
  $.ajax({
    method: 'GET',
    url: urlDeleteUser ,

    data: { body: $('#comment-body').val(),commentableId:commentableId,_token:token}
  })
     .done(function (msg){
     
    
      
      $('#user-account-comfirmation-modal').modal('hide');
      $.jGrowl("successfully deleted !", { position: 'center' });
     });
});
//$.jGrowl("Stick this!", { sticky: true });

//$.jGrowl("A message with a header", { header: 'Important' });

//***************************display full messages  **********************************************************
$(document).on('click','.message',function(event){
  event.preventDefault();
  var messageToPost = document.getElementById("paste-message");
  var messagebody =event.currentTarget.dataset['messagebody'];
  var messageSeenId =event.currentTarget.parentNode.dataset['messageseenid'];
  console.log(setMessageSeen);
  messageToPost.innerHTML = messagebody;
  /*$.ajax({
    method: 'POST',
    url: setMessageSeen,

    data: {messageSeenId:messageSeenId,seen:"true",_token:token}
  }).done(function (msg){
     
    
      
      $('#user-account-comfirmation-modal').modal('hide');
      $.jGrowl("successfully deleted !", { position: 'center' });
     });*/

});

//***************************upload cover image  **********************************************************
/*$(document).on('click','.OpenImgUpload',function(e){ 
  $('#picture_type').val($(e.target).data("picture-type")); 
    console.log($('#picture_type').val());
    $('#imgupload').trigger('click'); 
    
});*/

$(document).on('touchstart','#OpenImgUpload',function(){ 
   
    $('#imgupload').trigger('touchstart'); 
    
});

/*$(document).on('input','#imgupload', function() { 
    console.log('on input ');
    setTimeout(function(){ 
        alert("reach");
       $('#submit-cover').trigger('click');
    $('#submit-cover').trigger('touchstart'); 
        
    }, 3000);
    
});*/

/*$(document).on('change','#imgupload', function() { 
    console.log('on input ');
    setTimeout(function(){ 
        
       $('#submit-cover').trigger('click');
    $('#submit-cover').trigger('touchstart'); 
        
    }, 1000);
    
});*/


//***************************upload  image  **********************************************************
$(document).on('click','.OpenimgUpload',function(e){ 
    $('#add-picture').trigger('click'); 
    
});

$(document).on('touchstart','#OpenimgUpload',function(){ 
   
    $('#add-picture').trigger('touchstart'); 
    
});

/*$(document).on('input','#imgupload', function() { 
    console.log('on input ');
    setTimeout(function(){ 
        alert("reach");
       $('#submit-cover').trigger('click');
    $('#submit-cover').trigger('touchstart'); 
        
    }, 3000);
    
});*/

/*$(document).on('change','#add-picture', function() { 
    console.log('on input ');
    setTimeout(function(){ 
        
       $('#submit-photo').trigger('click');
    $('#submit-photo').trigger('touchstart'); 
        
    }, 1000);
    
});*/


//***************************RATE US **********************************************************
     $(document).on('click','.rate-us',function(event){
        console.log("im clicked");

        event.preventDefault();
        recipientId = event.target.parentNode.dataset['recipient'];
  
      
        $('#rate-us-modal').modal();
        $('#schoolUserId').val(recipientId);
        console.log(recipientId);
     });


$(window).on('load',function(){
    //console.log("/&#9986 page loading");
    $('#overlay').fadeOut();
    });

$(window).on('unload',function(){
    console.log("page loading");
    $('#overlay').fadeOut();
    });

$(document).on('mouseenter','.image-hover',function(event){
  //console.log($(event.target));
  $(event.target).next().attr('style','display:flex !important;position: absolute;margin-top: -1.75rem;background-color:rgba(0, 0, 0, 0.4);z-index:450 !important');
  event.stopPropagation();
});

$(document).on('mouseleave','.image-hover',function(event){
  $(event.target).next().attr('style','display:none !important');
});

$(document).on('click','.edit-image',function(event){
  console.log('edit image clicked ');
});



 $(document).ready(function(){
    $(document).on('click','.deleteFile',function(event){
  $.ajax({
    beforeSend:function(xhr, opts){
      //display the modal
      console.log("here on beforesend");
      (function(){
        $('#delete-confirmation-modal').modal();
      })();
    },
    type:'POST',
    url:deleteFile,
    data:{_token:token},
    
    success:function(){

    },
    error:function(){

    },
    complete:function(){

    },
  });
});
        });

