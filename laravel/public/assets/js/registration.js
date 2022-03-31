/**
*
*
*/
//***************************Update progress bar value**********************************************************
function updateRegProgressBar(current_progress,final_progress)
{
  
  var interval = setInterval(function() {
      current_progress += 1;
      $("#register-progress")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text(current_progress + "% Complete");
      if (current_progress >= final_progress)
          clearInterval(interval);
  }, 100);
}

//***************************Register user   **********************************************************
     $(document).on('click','#submit-final',function(event){
        console.log("im clicked");


        event.preventDefault();
        

/*var elements = document.getElementById("register-form").elements;

for (var i = 0, element; element = elements[i++];) 
{
    if (element.type === "text" && element.value === "")
        console.log("it's an empty textfield")
        console.log(element.type + " "+ element.value)
}
  */
      
        $('#agreement-modal').modal();
        
     })


//********************CREATE REPLIES SAVE CHANGES********************************************


$(document).on('click','#register-modal-submit',function(){
  if($('#agreement-check').is(':checked'))
  {
    $('#submit-register').trigger('click'); 
  }
  
});
