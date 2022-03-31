$(document).on('click','#timetable-add-subject',function(){
   //display the modal
$('#add-subject-modal').modal();
});

$(document).on('click','#save-subject',function(){
	var subject_form = document.getElementById('subjectsform');
	formData = new FormData(document.getElementById('subjectsform'));
	console.log(formData);
	for (var [key, value] of formData.entries()) { 
  console.log(key, value);
}
/*var classes = '';
formData.getAll('classes[]').forEach(function(el){
	console.log(el);
});*/

var selects = document.forms["subjectsform"].getElementsByTagName("select");
var double_period =0;
var allow_double_period  = "no";

if(formData.get('allowDouble') != null)
{
	allow_double_period = "yes";
}
//console.log("allow double period :"+allow_double_period);
var subject = selects[0].options[selects[0].selectedIndex].innerHTML;
var classes_array = selects[1].selectedOptions;
var teachers_array = selects[2].selectedOptions;
var classes = '' ;
var teachers = '';
var multiple_select_values = function(selected_options,values_string,separator,index)
{
	values_string = '';
	for (var i = 0; i < selected_options.length; i++) 
	{
		console.log(selected_options[i].innerHTML);
		var splits = selected_options[i].innerHTML.split(separator);
		values_string = values_string  + splits[index]+',';
	}
	return values_string;
}

var grades =  multiple_select_values(classes_array,classes,'grade ',1).split()[0];
classes =  multiple_select_values(classes_array,classes,'grade ',1);
teachers = multiple_select_values(teachers_array,teachers,'|',0);
//this.options[this.selectedIndex].innerHTML
console.log('classes :'+classes);

	 $('.added-subjects').prepend("<tr><th scope='row'>1</th><td>"+subject+"</td><td>"+allow_double_period+"</td><td>"+teachers+"</td><td>"+classes+"</td></tr>");
});