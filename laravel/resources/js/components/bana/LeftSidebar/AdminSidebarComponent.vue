<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
        <div class="card col-12" style="padding:0.5rem" >
          <div class="card-body" style="padding: 0 0.25rem">
            <h5 class="card-title text-muted" style="text-align: center;">
              <i class="fas fa-briefcase" style="color: brown"></i>
               Tools
            </h5>
            <div class="list-group">
              <a href="{{route('getMakeTimetablePage',['user'=>$userIdNo])}}" class="list-group-item list-group-item-action">
               <i class="fas fa-table" style="color: #6b8e23"></i>
                Timetable
              </a>
              <a href="{{route('getCurriculumn',['user'=>$userIdNo])}}" class="list-group-item list-group-item-action">
                <i class="fas fa-chalkboard-teacher" style="color: #cbbf6d"></i>
               Curriculumn
              </a>
              <a href="{{route('getBooks',['user'=>$userIdNo])}}" class="list-group-item list-group-item-action">
                <i class="fas fa-book" style="color:#a52a2a"></i>
                 Books
              </a>
            </div>
          </div>
        </div>
      </div>
</template>
<script>
</script>