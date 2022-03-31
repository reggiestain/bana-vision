console.log('loaded');
var currentIndex = 0;
//***************************ADD PARTICIPANTS  **********************************************************
     $(document).on('click','.add-participants',function(event){
        console.log("im clicked");
        event.preventDefault();
       
        $('#addParticipants-modal').modal();
     });


//********************ADD PARTICIPANTSs SAVE CHANGES********************************************


$(document).on('click','#participants-modal-save',function(){
  console.log("prt clickd");
  var participantsDiv = document.getElementById("added-participants");
  console.log(participantsDiv.innerHTML);
  participantsDiv.innerHTML = '';
  studentsProjectParticipants.forEach(function(entry){
    participantsDiv.innerHTML += '<span class="badge badge-info selected-participant" style="padding:0.3rem;margin :0.3rem" id="'+entry.id+'" onclick="removeParticipant('+entry.id+')" >'+entry.name+'<i class="fa fa-close p-2"></i></span><input type="hidden"  name="student_id[]" value="'+entry.id+'">';
  });
  
  console.log(participantsDiv.innerHTML);
  $('#addParticipants-modal').modal('hide');
});

//********************REMOVE SELECTED  PARTICIPANT********************************************


function removeParticipant(id){
  event.preventDefault();
  console.log("clicked"+id);
  var participantsDiv = document.getElementById("added-participants");
  //index = studentsProjectParticipants.findIndex(x => x.id==id);
  var index = getIndex(studentsProjectParticipants,id);
  console.log(index);

  studentsProjectParticipants.splice(index, 1);
  participantsDiv.innerHTML = '';
  studentsProjectParticipants.forEach(function(entry){
    participantsDiv.innerHTML += '<span class="badge badge-info selected-participant" style="padding:0.3rem;margin :0.3rem" id="'+entry.id+'" onclick="removeParticipant('+entry.id+')" >'+entry.name+'<i class="fa fa-close p-2"></i></span>';
  });
}
//***************************STUDENTS PARTICIPANTS CHECKBOX CHECKED  **********************************************************
     $(document).on('click','.participantCheckbox',function(event){
        
var participntObj = {};
        //event.preventDefault();
        //check if checkbox is checked
        if($(this).is(':checked'))
        {
          
          console.log('im checked');
          console.log(participntObj);
          participntObj.name = event.currentTarget.value ;
          participntObj.id  = event.currentTarget.id;
          console.log(participntObj);
          //check if none of the elements contain object about to be added
          var isNotAlreadyIncluded = studentsProjectParticipants.every(function(entry){
            return (entry.id != event.currentTarget.id);
          });

          if(isNotAlreadyIncluded)
          {
            studentsProjectParticipants.push(participntObj);
          }
          
        }
        else
        {
          console.log('im not checked');
          console.log(participntObj);
          console.log(studentsProjectParticipants);
          /*index = studentsProjectParticipants.findIndex(x => x.id==event.currentTarget.id);
          console.log(index);*/
          var index = getIndex(studentsProjectParticipants,event.currentTarget.id);
          console.log(index);
          studentsProjectParticipants.splice(index, 1);
          console.log(studentsProjectParticipants);
        }
        console.log(studentsProjectParticipants);
        //commentableId = event.target.parentNode.dataset['commentableid'];
  
      
        
     });

     function getIndex(collection,item)
     {
        var index = -1;
          for (var i = 0; i < collection.length; ++i) {
            console.log(collection[i].name);
            if (collection[i].id == item) {
              index = i;
              break;
            }
          }

          return index;
     }
//***************************STUDENTS PROJECT CLICKED  **********************************************************
/*
*  this function displays the student project details using 
*  the viewPostPicModal  
*
*/
$(document).on('click','.students-project-image',function(event){
 console.log("starting carousel ");
 var school_id = this.dataset['school_id'];
 var project_id=this.dataset['project_id'];
 



 var studentsImages = document.getElementById("student-pictures");
 var postText = document.getElementById("post-text");
 studentsImages.innerHTML = '';
 studentsImages.innerHTML += '<div class="carousel-item active"><img class="img-fluid " id="first-slide" alt="First slide" ></div>';
 $('#first-slide').prop('src',(value=getImageRoute+'/'+school_id+'-student-project-'+project_id+'.jpg'));
 var projectName = this.dataset['project_name'];
 //set the project name 
 document.getElementById("post-text").innerHTML='<h6><strong>'+ projectName +'</strong></h6><br><br>'+'<p>'+this.dataset['project_description']+'</p>';

 //populate the carousel with each students information
 for (var i = 0; i < students.length; i++) 
 {

  if(students[i].project_id == project_id ) //ensure student is a participant in this project
  {
    //set the student images source link
    studentsImages.innerHTML += '<div class="carousel-item"><a href="'+students[i].route+'"><img class="d-block img-fluid" src="'+students[i].img_src+'" alt="Third slide"></a></div>';
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

