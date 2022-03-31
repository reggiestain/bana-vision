$(document).on('click','.show-photo',function(event){
 		console.log(event.target);
	//document.getElementById('book-title').innerHTML = $(event.target).attr('data-title');
	//sets the student personal details
	var student = JSON.parse($(event.target).attr('data-student'));
	$('#student-name').html('<strong>Name :</strong> '+student.name + ' ' +student.surname);
	$('#student-id-number').html('<strong>Id Number :</strong> '+student.id_number);
	$('#student-gender').html('<strong>Gender :</strong> '+student.gender);
	$('#student-guardian').html('<strong>Guardian  :</strong> '+student.guardian);
	$('#student-special-medication').html('<strong>Special medication :</strong>'+student.special_medication);
	$('#student-medical-condition').html('<strong>Medical condition :</strong '+student.medical_condition);
	$('#student-previous-school').html('<strong>Previous school  :</strong> '+student.previous_school);
	$('#student-previous-grade').html('<strong>Previous grade :</strong> '+student.previous_grade);
	$('#student-previous-school-grade').html('<strong>Grade at previous school  :</strong> '+student.previous_school_grade);
	$('#student-disability').html('<strong>Disability :</strong> '+student.disability);
	$('#student-year').html('<strong>Year :</strong> '+student.year);
	$('#student-grade-class').html('<strong>Class :</strong> Grade '+ student.grade);
	$('#student-image').attr('src',$(event.target).attr('data-src'));
	$('#caption-name').html(student.name+' '+student.surname);
	//sets the student input edit values 
	$('input#student-name').val(student.name);
	$('input#student-surname').val(student.surname);
	$('input#student-id-number').val(student.id_number);
	$('input#student-guardian').val(student.guardian);
	$('input#student-grade').val(student.grade);
	$('input#student-class').val(student.class);
	$('input#student-year').val(student.year);
	$('input#student-student-number').val(student.student_number);
	$('input#student-disability').val(student.disability);
	$('input#student-gender').val(student.gender);
	$('input#student-special-medication').val(student.special_medication);
	$('input#student-medical-condition').val(student.medical_condition);
	$('input#student-previous-grade').val(student.previous_grade);
	$('input#student-previous-school').val(student.previous_school);
	$('input#student-previous-school-grade').val(student.previous_school_grade);
	/*$('#book-id').val($(event.target).attr('data-id'));*/
	var books = JSON.parse($(event.target).attr('data-requestedBooks'));
	var booksdiv = '';
	books.forEach(function(entry){
		booksdiv = booksdiv + '<div class="col-4" style="display:inline">'+
		'<figure class="figure" style="    width: 29.333%;">'+
		'<img class="rounded" src="'+entry.cover_src+'" style="width:13rem">'+
		'<figcaption class="figure-caption">'+
		'<strong>Title : </strong>'+entry.title+'<br><strong>Book id : </strong>'+entry.book_identification+'<br><strong>Date requested :</strong>'+entry.date_requested+
		'</figcaption>'+
		'</figure>'+
		'</div>';
	});
	$('#nav-profile').html(booksdiv);

	//checked out books
	var chkdbooks = JSON.parse($(event.target).attr('data-checkedOutBooks'));
	var chkdbooksdiv = '';
	var returned = '';
	
				
	chkdbooks.forEach(function(entry){
		if(entry.returned == 0)
	returned = 'no';
	else
	returned = 'yes';
		chkdbooksdiv = chkdbooksdiv + '<div class="col-4" style="display:inline">'+
		'<figure class="figure" style="    width: 29.333%;">'+
		'<img class="rounded" src="'+entry.cover_src+'" style="width:13rem">'+
		'<figcaption class="figure-caption">'+
		'<strong>Title : </strong>'+entry.title+'<br><strong>Book id : </strong>'+entry.book_identification+'<br><strong>Date checked out :</strong>'+entry.date_checked_out+
		'<br><strong>Returned : </strong>'+returned+
		'</figcaption>'+
		'</figure>'+
		'</div>';
	});
	//LOANED BOOKS
	var loaned_books = JSON.parse($(event.target).attr('data-loanedBooks'));
	var loaned_booksdiv = '';
	loaned_books.forEach(function(entry){
		loaned_booksdiv = loaned_booksdiv + '<div class="col-4" style="display:inline">'+
		'<figure class="figure" style="    width: 29.333%;">'+
		'<img class="rounded" src="'+entry.cover_src+'" style="width:13rem">'+
		'<figcaption class="figure-caption">'+
		'<strong>Title : </strong>'+entry.title+'<br><strong>Book id : </strong>'+entry.book_identification+'<br><strong>Year borrowed :</strong>'+entry.year+
		'</figcaption>'+
		'</figure>'+
		'</div>';
	});

	var misconducts = JSON.parse($(event.target).attr('data-misconducts'));
	var misconductsDiv = 
	'<table class="table table-hover">'+
  '<thead>'+
    '<tr>'+
      '<th scope="col">Offense </th>'+
      '<th scope="col">Reported to</th>'+
      '<th scope="col">Complainant</th>'+
      '<th scope="col">Punishment</th>'+
    '</tr>'+
  
    
 ' </thead>'+
'<tbody>';
	misconducts.forEach(function(entry){
	   misconductsDiv = misconductsDiv + 
		'<tr>'+
      '<td >'+entry.offence+'</t>'+
      '<td>'+entry.reported_to+'</td>'+
      '<td>'+entry.complainant+'</td>'+
      '<td>'+entry.punishment+'</td>'+
    '</tr>';
	});
	misconductsDiv = misconductsDiv + '</tbody>'+
  '</table>';

	$('#nav-contact').html(chkdbooksdiv);
	$('#nav-misconducts').html(misconductsDiv);
	$('#nav-loanedbooks').html(loaned_booksdiv);
	$('#admin-info-modal').modal();

});
       