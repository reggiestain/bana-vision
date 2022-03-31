<template>
	<div class="modal" tabindex="-1" role="dialog" id="admin-info-modal">
		<div class="col-12 modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header pt-0 pb-0 pl-0" style="background-color: #f7f7f7;justify-content: normal;">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-id-card" style="color: #4b36ff"></i> Personal details</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-book" style="color: #ba4602"></i> Requested Books</a>
							<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-book" style="color: #126164"></i> Checked out books</a>
							<a class="nav-item nav-link" id="nav-loanedbooks-tab" data-toggle="tab" href="#nav-loanedbooks" role="tab" aria-controls="nav-loanedbooks" aria-selected="false"><i class="fas fa-book" style="color: #f0c0c0"></i> Loaned books</a>
							<a class="nav-item nav-link" id="nav-misconducts-tab" data-toggle="tab" href="#nav-misconducts" role="tab" aria-controls="nav-misconducts" aria-selected="false"><i class="fas fa-gavel" style="color:#000000"></i> Misconducts</a>
							<a class="nav-item nav-link" id="nav-attendance-tab" data-toggle="tab" href="#nav-attendance" role="tab" aria-controls="nav-attendance" aria-selected="false"><i class="fas fa-history" style="color:#ff0000"></i> Attendance</a>
						</div>
					</nav>

					<a class="p-1 align-self-center ml-auto"  href="#" role="button" id="schoolStudentMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
						<i class="fas fa-wrench" style="color:#c5c7cb">
						</i>
					</a>
					<a class="p-1 align-self-center ">
						<i class="fas fa-chevron-up" style="color:#c5c7cb">
						</i>
					</a>
					<a class="p-1 align-self-center ">
						<i class="fas fa-times" data-dismiss="modal" aria-label="Close"  style="color:#c5c7cb">
						</i>
					</a>

					<!--=============================STUDENT DROPDOWN MENU==================================-->
					<div class="dropdown-menu" aria-labelledby="schoolStudentMenuLink">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>


       <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button> -->
 </div>
 <div class="modal-body">
 	<div class="row m-0">
 		<!--student image-->
 		<div class="col-4 d-none d-md-flex border-right">
 			<figure>
 				<img class="figure-img img-fluid rounded-circle d-flex align-items-center ml-auto mr-auto" :src="getPostImg(student,'school_student')" alt="Second slide" style="width: 15rem" id="student-image">
 				<figcaption>
 					<h3 id="caption-name" style="text-align: center"></h3>
 				</figcaption>
 			</figure>
 		</div>
 		<!--TABS DIV-->
 		<div class="col-12 col-md-8 p-0">
 			<div class="tab-content" id="nav-tabContent">
 				<div class="tab-pane fade show active p-0" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
 					<div class="col-12 d-flex p-0">
 						<div class=" col-6 " style="display: inline">
 							<ul class="list-group">
 								<li  style="font-size: 0.875rem;" id="student-name">
 									<strong>
 										Name :
 									</strong>
 									 {{student.name+' '+student.surname}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-id-number">
 									<strong>
 										Id Number : 
 									</strong>
 									{{student.id_number}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-gender">
 									<strong>
 										Gender : 
 									</strong>
 									  {{student.gender}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-guardian">
 									<strong>
 										Guardian : 
 									</strong>
 									 {{student.guardian}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-special-medication">
 									<strong>
 										Special Medication : 
 									</strong>
 									 {{student.special_medication}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-medical-condition">
 									<strong>
 										Medical Condition : 
 									</strong>
 									 {{student.medical_condition}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-previous-school">
 									<strong>
 										Previous School : 
 									</strong>
 									 {{student.previous_school}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-previous-grade">
 									<strong>
 										Previous grade : 
 									</strong>
 									 {{student.previous_grade}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-previous-school-grade">
 									<strong>
 										Grade at previous school : 
 									</strong>
 									 {{student.previous_school_grade}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-disability">
 									<strong>
 										Disability : 
 									</strong>
 									 {{student.disability}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-year">
 									<strong>
 										Year : 
 									</strong>
 									 {{student.year}}
 								</li>
 								<li  style="font-size: 0.875rem;" id="student-grade-class">
 									<strong>
 										Class : 
 									</strong>
 									grade {{student.grade+' '+student.class}}
 								</li>
 							</ul>
 						</div>
 						<div class="col-6 border-left" style="display: inline">
 							<h3 style="text-align: center;color: #ff0000">
 								<i class="fas fa-user-edit" style="color: #ff0000"></i>
 								 Edit 
 							</h3>
 							<form>
 								<!--NAME-->
 								<div class="form-group row">
 									<label for="student-name" class="col-sm-4 col-form-label">
 										Name : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-name" name="student_name" :placeholder="student.name">
 									</div>
 								</div>
 								<!--ID NUMBER-->
 								<div class="form-group row">
 									<label for="id_number" class="col-sm-4 col-form-label">
 										Id number : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-id-number" name="id_number" :placeholder="student.id_number">
 									</div>
 								</div>
 								<!--SURNAME-->
 								<div class="form-group row">
 									<label for="surname" class="col-sm-4 col-form-label">
 										Surname : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="surname" name="student-surname" :placeholder="student.surname">
 									</div>
 								</div>
 								<!--GUARDIAN-->
 								<div class="form-group row">
 									<label for="guardian" class="col-sm-4 col-form-label">
 										Guardian : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-guardian" name="guardian" :placeholder="student.guardian" >
 									</div>
 								</div>
 								<!--CLASS-->
 								<div class="form-group row">
 									<label for="class" class="col-sm-4 col-form-label">
 										Class : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-class" name="class" :placeholder="student.class">
 									</div>
 								</div>
 								<!--GRADE-->
 								<div class="form-group row">
 									<label for="grade" class="col-sm-4 col-form-label">
 										Grade : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-grade" name="grade" :placeholder="student.grade">
 									</div>
 								</div>
 								<!--YEAR-->
 								<div class="form-group row">
 									<label for="year" class="col-sm-4 col-form-label">
 										Year : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-year" name="year" :placeholder="student.year">
 									</div>
 								</div>
 								<!--STUDENT NUMBER-->
 								<div class="form-group row">
 									<label for="student_number" class="col-sm-4 col-form-label">
 										Student Number : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-student-number" name="student_number" :placeholder="student.student_number">
 									</div>
 								</div>
 								<!--DISABILITY-->
 								<div class="form-group row">
 									<label for="disability" class="col-sm-4 col-form-label">
 										Disability : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-disability" name="disability" :placeholder="student.disability">
 									</div>
 								</div>
 								<!--GENDER-->
 								<div class="form-group row">
 									<label for="gender" class="col-sm-4 col-form-label">
 										Gender : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-gender" name="gender" :placeholder="student.gender">
 									</div>
 								</div>
 								<!--SPECIAL MEDICATION-->
 								<div class="form-group row">
 									<label for="special_medication" class="col-sm-4 col-form-label">
 										Special medication : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-special-medication" name="special_medication" :placeholder="student.special_medication">
 									</div>
 								</div>
 								<!--MEDICAL CONDITION-->
 								<div class="form-group row">
 									<label for="medical_condition" class="col-sm-4 col-form-label">
 										Medical condition : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-medical-condition" name="medical_condition" :placeholder="student.medical_condition">
 									</div>
 								</div>
 								<!--PREVIOUS GRADE-->
 								<div class="form-group row">
 									<label for="previous_grade" class="col-sm-4 col-form-label">
 										Previous grade : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-previous-grade" name="previous_grade" :placeholder="student.previous_grade">
 									</div>
 								</div>
 								<!--PREVIOUS SCHOOL-->
 								<div class="form-group row">
 									<label for="previous_school" class="col-sm-4 col-form-label">
 										Previous school
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-previous-school" name="previous_school" :placeholder="student.previous_school">
 									</div>
 								</div>
 								<!--PREVIOUS SCHOOL GRADE-->
 								<div class="form-group row">
 									<label for="previous_school_grade" class="col-sm-4 col-form-label">
 										Previous school grade : 
 									</label>
 									<div class="col-sm-8">
 										<input type="text" class="form-control form-control-sm" id="student-previous-school-grade" name="previous_school_grade" :placeholder="student.previous_school_grade">
 									</div>
 								</div>
 							</form>
 						</div>
 					</div>
 				</div>
 				<div class="tab-pane fade col-12" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
 					<div class="col-4" style="display:inline">
 						<figure class="figure" style="    width: 29.333%;">
 							<img class="rounded" src="'+entry.cover_src+'" style="width:13rem">
 							<figcaption class="figure-caption">
 								<strong>Title : </strong>'+entry.title+'<br><strong>Book id : </strong>'+entry.book_identification+'<br><strong>Date requested :</strong>entry.date_requested
 							</figcaption>
 						</figure>
 					</div>

 				</div>
 				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
 				<div class="tab-pane fade" id="nav-loanedbooks" role="tabpanel" aria-labelledby="nav-loanedbooks-tab">...</div>
 				<div class="tab-pane fade" id="nav-misconducts" role="tabpanel" aria-labelledby="nav-misconducts-tab">...</div>
 				<div class="tab-pane fade" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab">...</div>
 			</div>
 			<h5 id="book-title"></h5>

 		</div><!--TABS DIV-->
 	</div>
 </div>
 <div class="modal-footer">
 	<button type="button" class="btn btn-primary btn-sm">
 		Save changes
 	</button>
 	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
 		Close
 	</button>
 </div>
</div>
</div>
</div>
</template>
<script>
	export default
	{
		props:['student'],
		methods:
		{
			getPostImg: function(name,xtra_info = null) 
			{
				var pth;
				if (name)
				{
				if(name.images)
				{


					pth = name.images[0].path;
					name = name.images[0].name;

            		//return '/sub-picture/'+name+'/'+name.substring(0, name.lastIndexOf('-'))+'-';
        		}
        		else
        		{
        			var img;
        			img = name[xtra_info].images[0];
        			pth = img.path;
        			name = img.name;
        		}
        	}
        		if(pth)
        			return '/sub-picture/'+name+'/'+pth.replace(/\//g,"-");

    		},
		}
	}
</script>