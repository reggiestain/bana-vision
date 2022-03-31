<template>
	<div class="modal" tabindex="-1" role="dialog" id="add-class-modal">
		<div class="modal-dialog .modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						Add Class
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="route('createSchoolClass')">


						<!--Class grade-->
						<div class="form-group row">
							<label class="col-3" for="exampleInputPassword1">
								Grade :
							</label>
							<div class="col-9    $errors->has('grade') ? 'has-error':''">
								<input type="number" name="grade" max="12" min="0" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="class grade" value="Request::old('grade')" required>
							</div>
						</div>
						<!--Class letter-->
						<div class="form-group row">
							<label class="col-3" for="exampleInputPassword1">
								Class letter :
							</label>
							<div class="col-9 $errors->has('class_name') ? 'has-error':''">
								<input type="text" name="class_name" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="class suffix e.g 7A"  value="Request::old('class_nme')" required>
							</div>
						</div>
						<!--Class teacher-->
						<div class="form-group row">
							<label class="col-3" for="exampleInputPassword1">
								Class Teacher :
							</label>
							<div class="col-9  $errors->has('teacher_id') ? 'has-error':''">
								<select class="form-control form-control-sm" name="teacher_id"   value="Request::old('teacher_id')">
									<option selected>select a class teacher</option>
									@foreach($teachers as $teacher)
									<option value="$teacher->id">$teacher->staff->user->first()->name</option>
									@endforeach
								</select>
							</div>
						</div>

						<input type="hidden" name="school_id" value="$userIdNo->usable_id">
						<input type="hidden"  name="_token" value="{csrf_token()}">
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm">
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
</script>