<template>
	<div class="card col-12" style="padding:0.5rem" >
@if($userIdNo->usable->featuredStudents()->count() > 0)
    <div class="card-body" style="padding: 0 0.25rem">
     <div >
      <p  style="float:left;" class="muted-text">
        <strong>
          Student Projects
        </strong>
      </p >
      <p style="float: right;">
        
       <a class="p-1" >
        <i class="fas fa-chevron-up " style="color:#c5c7cb"></i>
      </a>
      <a class="p-1"  >
        <i class="fas fa-wrench" style="color:#c5c7cb">
        </i>
      </a>
      <a class="p-1 ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="z-index: 6000" >
        <i class="fas fa-cog" style="color:#c5c7cb">
        </i>
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="route('studentAwards',['user'=>$userIdNo->slug])">
         more 
       </a>
      </div>
     </p>
   </div>

   <!-- STUDENT PROJECTS CAROUSEL -->
   <div id="carouselProjectControls" class="carousel slide " data-ride="carousel">
    <div class="carousel-inner">
    @foreach($userIdNo->usable->studentProjects()->get() as $key=>$project )
           <div class="carousel-item @if($key == 0)active @endif " >
            <figure class="figure" style="padding-left: 0rem;padding-right: 0.1rem;max-height: 6rem;overflow: hidden;">
              <img class="d-block w-100 figure-img  " src="route('getSubfolderPic',['filename'=>$project->images->first()->name,'folder'=>str_replace('/','-',$project->images->first()->path)])" alt="First slide" style="height: 100%">
              
            </figure>
            <figcaption class="figure-caption">
               $project->name
              </figcaption>
          </div>
          @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselProjectControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true">
        
      </span>
      <span class="sr-only">
        Previous
      </span>
    </a>
    <a class="carousel-control-next" href="#carouselProjectControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">
        Next
      </span>
    </a>
  </div>
  <!-- END STUDENT PROJECTS CAROUSEL -->
  <!-- INTERACTIONS -->
  <div class="row border-top " style="margin: 0;">
    <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
      <a href="#">
        <span style="display: block;">
          <i class="fas fa-share-alt"></i>
        </span>
      </a>
      <small>share</small>

    </div>
    <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
      <a href="#">
        <span style="display: block;">
          <i class="fas fa-eye"></i>
        </span>
      </a>
      <small>view</small>

    </div>
    <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
      <a href="#">
        <span style="display: block;">
          <i class="fas fa-rss"></i>
        </span>
      </a>
      <small>subscribe</small>

    </div>
  </div>
  <!-- END INTERACTIONS -->
</div>
@else
            <h1 class="lead">Nothing to display at the moment</h1>
          @endif
</div>
</template>
<script>
</script>