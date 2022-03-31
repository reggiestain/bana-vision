//Add curriculumn subject
$(document).on('click','#add-curriculumn-subject',function(event){
	$('#add-curriculumn-subject-modal').modal();
	$('#curriculumn-subject-modal-title').html('Add subject');
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

});