//book result book is clicked
$(document).on('click','.library-book',function(event){
	console.log(event.target);
	document.getElementById('book-title').innerHTML = $(event.target).attr('data-title');
	$('#book-isbn').html('Isbn number : '+$(event.target).attr('data-isbn'));
	$('#book-author').html('Author : '+$(event.target).attr('data-author'));
	$('#book-year').html('Year : '+$(event.target).attr('data-year'));
	$('#book-location').html('Location  : '+$(event.target).attr('data-location'));
	$('#book-description').html($(event.target).attr('data-description'));
	$('#book-image').attr('src',$(event.target).attr('data-src'));
	$('#book-id').val($(event.target).attr('data-id'));
	$('#displayBook-modal').modal();
});