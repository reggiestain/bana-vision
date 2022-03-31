@extends('layouts.masterProfile')

@section('registrationType')
login
@endsection
@section('styles')
<link href="URL::asset('/assets/css/placeholder-loading.css')" rel='stylesheet' />
<style type="text/css">
  #left-sidebar {
    top: 9rem;
     position: relative ; 

    padding: 0;
  
}

.video-image::after {
  font-family: 'Font Awesome\ 5 Free';
   font-weight: 900;
  content:"\f005";
  padding: 0.3rem !important;
  border-radius: 5rem;
  background-color: #ffffff;  
  position: relative ;
}

#pill-review::after
{
   font-family: 'Font Awesome\ 5 Free';
   font-weight: 900;
  content: attr(data-rating)"\f005";
  padding: 0.3rem !important;
  border-radius: 5rem;
  background-color: #ffffff;  
  position: relative ;
  left: 1.2rem;
  box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
 
  
}
#details
{
  color: #000000 !important;
}

.details-subsection .fa {
  color: #000080;
  transition: .3s transform ease-in-out;
}
.details-subsection.collapsed .fa {
  transform: rotate(90deg);
}

#profilepic::after
{
  font-size: 2rem;
  font-weight: 900;
  color: #6495ed;
  position: absolute;
  content: "Bana";
  bottom: 2rem;
  left: 12rem;
}

ul
{
  border-bottom: none;
}

.nav-item a
{
  font-weight: bold;
}

.nav-link 
{
 
  padding:0 !important; 
}

.nav-tabs
{
  border-bottom: none;
}

.nav-tabs .nav-link.active {
    background-color: transparent !important;
    border-color: transparent !important;
}

.nav-item.nav-link.gallery-link.active::after, .nav-link.active.gallery-link.show::after {
  border-bottom: 8px solid #ffffff;
  /* margin-bottom: -0.5rem; */
  }


</style>
@endsection
@section('content')
    <div class="card" id="cover-profile">
<!--=========================FORM FOR CHANGING IMAGE==============================-->
<!-- ====================COVER  AREA====================-->
 <div class="card-body" style="padding:0;min-height: 300px;max-height:400px;overflow: hidden;">
  <!-- Tab panes -->
  <div class="tab-content" >
    <div id="cover" style="    background-image: url(../../assets/img/3574.jpg);background-size: 270px 270px;background-repeat: repeat;opacity: 0.8">
     <!--=====================COVER PICTURE==========================-->
     <img  class="show-fullscreen" :src="'../assets/img/bana1.png'" alt="Schools brand picture" style="height:315px;padding:0;display:block;margin:auto;">
   </div>
   
   <!--======================PROFILE PICTURE============================-->
    <span id="profilepic">


      <img  class="border show-fullscreen bg-white" :src="'../assets/img/bana1.png'" style="width: 8rem;height: 8rem;position: absolute;bottom: -1rem;left: 2rem;
    padding: 0.35rem;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    </span>


 

 </div>
</div>
<!-- END COVER AREA -->
</div> <!--end cover profile-->
<div class="container-fluid bg-white" >

<!--================================================NAV TABS================================================-->
<ul class="nav nav-tabs  " id="tab-menu" role="tablist" style="min-height: 2rem;">
  <li role="presentation" class=" nav-item active border-left border-right" style="min-height: 2rem;padding: 0.5rem;margin-left: 11rem;">
    <a class="nav-link active" >
        <i class="fa fa-thumbs-up" style="color:#ff5500">
      </i>
     Like
    </a>
  </li>
  

  <li role="presentation" class="nav-item  border-right" style="min-height: 2rem;padding: 0.5rem;">
    <a class="nav-link" >
      <i class="fa fa-share" style="color:#ff5500">
      </i>
      Share
    </a>
  </li>
  <li role="presentation" class="nav-item  border-right" style="min-height: 2rem;padding: 0.5rem;">
    <a class="nav-link" >
      <i class="fa fa-splotch " style="color:#ff5500">
      </i>
      Rate
    </a>
  </li>
</ul>
</div>  <!--end nav--> 

<!--TABS-->
<div class="row m-0 p-0 align-items: flex-start;" style="margin-top: 2rem !important;">
  <div class="d-none d-md-block col-12 col-md-3 p-0 m-0 stickyEl" id="left-sidebar" >
    @include('includes.sidebarLeft')
  </div>
<!-- Tab panes -->
<div class="col-12 col-md-7 card card-default  pl-0 about-pane" id="tab-panes">
                <div class=" tab-content card-body p-0">
    <!--=======================DETAILS=======================-->
    <div role="tabcard" align="center" class="tab-pane active" id="details">
        <div class="p-3 row m-0">
            <h4>Details</h4>
        </div>
        <div class="p-3">
            <div v="useridno.usable_type == 'App\\School'"> 
            <div class="well" style="padding-bottom:1px; " >

                <a class="collapsed details-subsection" data-toggle="collapse" href="#where-we-are" aria-expanded="false" aria-controls="collapse-example" id="where-we-are-co" style="display: block;width:100%">
                    <h5 class="d-inline">
                        <span class="mr-2" style="color:#6495ed"><i class="fas fa-info-circle"></i></span> 
                        About
                    </h5>
                    <i class="fa fa-chevron-down float-right">
                    </i>
                </a>
                <div class="collapse show" id="where-we-are">
                    Bana is the place to find and fulfill all your education needs. We are here to help you connect with opportunities close to you and all over the world. We are here to make it easier for you to get involved and get in touch with learners and schools that you would like to help. We want to see connections from Morocco to Amsterdam, from Seoul to Sao Paulo and many, many more! Get in touch and find those you can exchange ideas with internationally or support locally!
                </div>

            </div>
            <hr>
        </div>
            
            <div v="useridno.usable_type == 'App\\School'">
            <div class="well" style="padding-bottom:1px; ">
                <!--==========================QUICK FACTS================================-->

                <a class="details-subsection collapsed align-items-center" data-toggle="collapse" href="#quick-facts" aria-expanded="false" aria-controls="collapse-example" id="quick-facts-co" style="display: block;width:100%" >
                    <h5 class="d-inline" >
                        <span class="mr-2" style="color:#6495ed"><i class="fas fa-space-shuttle"></i></span>
                        Mission
                    </h5>
                    <i class="fa fa-chevron-down float-right d-flex align-self-center">
                    </i>
                </a>

                <div class="collapse show" id="quick-facts">
                    Our mission is to have people, locally as well as from across the globe, interact
more easily within the education space, whether it be through ideas, tools or aid. We believe
that the closer online and offline communication behaviors and standards align, the more
effectively you can mobilize energy between worlds, specifically the education world.
                </div> 
            </div>
            <hr>
            </div>
            <!--===========================================================-->
            <div class="well" style="padding-bottom:1px; ">
              
                <!--==========================CONTACT DETAILS==================================-->
                       
                <a class="details-subsection collapsed" data-toggle="collapse" href="#contact-details" aria-expanded="false" aria-controls="collapse-example" id="contact-details-co" style="display: block;width:100%">

                    <h5 class="d-inline">
                        <span class="mr-2" style="color:#6495ed"><i class="fas fa-phone"></i></span> 
                       Contact
                    </h5>
                    <i class="fa fa-chevron-down float-right">
                    </i>
                </a>

                <div class="collapse show" id="contact-details">
                    <ul  class="dl-horizontal" style="padding:3px">
                        <li>
                            <strong>
                                Support :
                            </strong>
                            support@bana.vision
                        </li>
                        <li>
                            <strong>
                                Info :
                            </strong>
                            info@bana.vision
                        </li>
                    </ul>
                </div>

                <hr>
             
            </div>
            <!--===========================================================-->


            <div v="useridno.usable_type == 'App\\School'">
            <!--===========================================================-->
            <!--<div class="well" style="padding-bottom:1px; ">-->
                <!--===========================OUR HISTORY===============================-->

                <!--<a class="details-subsection collapsed" data-toggle="collapse" href="#our-history" aria-expanded="false" aria-controls="collapse-example" id="our-history-co" style="display: block;width:100%">
                    <h5 class="d-inline">
                        Our History
                    </h5>
                    <i class="fa fa-chevron-down float-right">
                    </i>
                </a>

                <div class="collapse" id="our-history">
                    <p >getUser.usable.history</p>
                </div>
            </div>-->
            <!--===========================================================-->
            

           </div>
        </div>
    </div> <!--end details-->
    </div>
    </div>  
    <div class="col-12 col-md-2 p-0 ml-3 stickyEl" >
    @include('includes.sidebarRight') 
    </div>
</div>

@endsection
