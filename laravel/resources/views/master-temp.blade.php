<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BanaVision</title>

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script> -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/aside.css">
     <link rel="stylesheet" href="/assets/css/sidebar-mainpage.css"><link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"><link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
 <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
     



    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">


    <!--<script>
        // Initialize and add the map
        function initMap() {
          // The location of Uluru
          const uluru = { lat: -25.344, lng: 131.036 };
          // The map, centered at Uluru
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: uluru,
          });
          // The marker, positioned at Uluru
          const marker = new google.maps.Marker({
            position: uluru,
            map: map,
          });
        }
      </script>-->    <style>
    	*
	{
		margin:0;
		padding:0;
		box-sizing:border-box;	
	}.content-1,.content-2,.content-3
{
	display:none;
}
    </style>
</head>

<body>
      <div class = "">
    <!--   <div class="navbar">
            <div class="logo">
                <img src="/assets/img/logo.png" alt="" width="100" height="70">
            </div>
            <div class="menu">
                <ul>
                    <li><span> Login</span></li>
                    <li>Register</li>
                    <li class = "mobile-off">Contact</li>
                </ul>
                <div class="menu-icons">
                    <img src="/assets/img/search.png" alt=""  class = "mobile-off">
                    <img src="/assets/img/menu.png" alt="" width="30" height="30">
                </div>
            </div>
        </div> -->

      <!--  <nav class="navbar navbar-expand-md navbar-light ">
            <a href="#" class="navbar-brand"><img src="/assets/img/logo.png" alt="" width="100" height="70"></a>-->
  
            <div class = "tp">
	 <header class="header">
          <div class="logo">
                <img src="/assets/img/bana1.png" alt="" width="70" height="70" >
            </div>
           <i class="header__toggle" id="header-toggle">
                <img src="/assets/img/menu.png" alt="" width="30" height="30">
            </i>
	    
	    <nav class="nav" id="nav-menu">
                <div class="nav__content bd-grid">
                    <a href="" class="nav__perfil">
                        <div class="nav__img">
                            <img src="/assets/img/bana1.png" alt="">
                        </div>                 
                        <div>
                            <span class="nav__name">bana vision.</span>             
                        </div>
                    </a>
     <div class="search-bar">
      <input class = "search-txt" type="text " placeholder="Search...">
      <a href="" class = "search-btn">   <i class="lni lni-search"></i>
      </a>
       </div>
                    <div class="nav__menu">
                        <ul class="nav__list">
                            <li class="nav__item"><a href="#" class="nav__link active">Home</a></li> 
							
                            <li class="nav__item dropdown">
                                <a href="#" class="nav__link dropdown__link">Network<i class='bx bx-chevron-down dropdown__icon'></i></a>
                                <ul class="dropdown__menu">
                                    <li class="dropdown__item"><a href="{{url('schools')}}" class="nav__link">Schools</a></li>
                                    <li class="dropdown__item"><a href="{{url('Orginazation')}}" class="nav__link">Organisation</a></li>
                                    <li class="dropdown__item"><a <a href="{{url('about-us')}}" class="nav__link">About us</a></li>
                                </ul>
                            </li>
                         <li class="nav__item"><a href="{{url('login')}}" class="nav__link  btn banner-btn btt"><i class = "material-icons nav--icon">login</i><p>Sign in</p></a></li>
                            <li class="nav__item "><a href="{{url('register')}}" class="nav__link  btn banner-btn btt"><i class = "material-icons nav--icon">how_to_reg</i><p>Register</p></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

          <!--  <div class="justify-content-between">
                <div class="navbar-nav">
                </div>
                <form class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" > 
                         <div class="input-group-append">
                    <button type="button" class="btn btn-secondary" style = "border-radius:3px;" ><i class="fa fa-search"></i></button>
                </div> 
                    </div>
                </form>
                <div class="navbar-nav">
                    <a href="{{url('register')}}" class="nav-item nav-link n-border-left "> Register</a>
                    <a href="{{url('login')}}" class="nav-item btn banner-btn ">Sign in</a>
                </div>
            </div>
        </nav>-->
        <div class="banner mb-3 mobile-banner ">
            <div class="left-col">
                <div class="turn-2"> </div>
                <div class="banner-text">
                
                    <h1>bana<br><span>vision.</span></h1>
                    <h5>Your world of education</h5> 
                    <h4></h4>
                    <p class="wt">The platform for all your educational needs! Whether you are a learner, school, business or NPO we got you! We connect you to the best possibile solution for your specific problem!</p>
                    <div class="banner-form">
                        <!-- <button type="button" class="btn menu-btn banner-btn mb-2 border-none btt"> <a href="{{url('register')}}" > Register</a> </button>
                        <div class="line-or"></div>-->
                        <button type="button" class="btn  banner-btn mt-2"><a href="{{url('login')}}">Sign in</a></button>
                    </div>

                </div>
               
            </div>
            <div class="right-col">
                
                <div class="small-img turn">
                </div>
                <div class="small-img turn-3">
                </div>
                <div class="small-img turn-2
    ">
                </div>
            </div>
        </div>
        </div>
	<div class= "container-my">
        <div class="row row-cols-1 row-cols-md-3 mb-3 mag">
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header mcard">
                        <h4 class="my-0 fw-normal">Library</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><small class="text-muted"></small> E-learning</li>
                            <li><small class="text-muted"></small> Sci-bono</li>
                            <li><small class="text-muted"></small> Books</li>
                            <li><small class="text-muted"></small> Book of the month</li>
			    <div class= "content-1" id= "content-1">
			    	<li><small class="text-muted"></small> Most Read</li>
                           	<li><small class="text-muted"></small> Suggested</li>
                           	<li><small class="text-muted"></small> Additional</li>
			    </div>
                        </ul>
                        <button type="button" id= "content1" class="w-100 btn btn-lg btn-outline-primary">View more</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header mcard">
                        <h4 class="my-0 fw-normal ">Ranking</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4 ">
                            <li><small class="text-muted"></small> Top 10 </li>
                            <li><small class="text-muted"></small>Maths</li>
                            <li><small class="text-muted"></small>Science</li>
                            <li><small class="text-muted"></small>Sports</li>
			    <div class= "content-2" id= "content-2" >
			    	<li><small class="text-muted"></small> Schools</li>
                           	<li><small class="text-muted"></small> Other</li>
                           	
			    </div>
                        </ul>
                         <button type="button" id= "content2" class="w-100 btn btn-lg btn-outline-primary">View more</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header mcard">
                        <h4 class="my-0 fw-normal">Announcements</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><small class="text-muted"></small> Bursary </li>
                            <li><small class="text-muted"></small> Donations</li>
                            <li><small class="text-muted"></small> Information</li>
                            <li><small class="text-muted"></small> Help</li>
			    <div class= "content-3" id= "content-3" >
                           	<li><small class="text-muted"></small> Other</li>          	
			    </div>
                        </ul>
                        <button type="button" id= "content3" class="w-100 btn btn-lg btn-outline-primary">View more</button>
                    </div>
                </div>
            </div>
        </div>
	
	
        <section class="u-clearfix u-section-2" id="sec-f986">
            <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
                <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div class="u-container-style u-layout-cell u-size-36 u-layout-cell-1">
                                <div
                                    class="u-container-layout u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-container-layout-1">
                                    <div class="u-expand-resize u-image u-image-circle u-image-1"></div>
                                    <div class="u-shape u-shape-svg u-text-palette-2-base u-shape-1">
                                        <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 160">
                                            <use xlink:href="#svg-9d3d"></use>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                            xml:space="preserve" class="u-svg-content" viewBox="0 0 160 160" x="0px"
                                            y="0px" id="svg-9d3d" style="enable-background:new 0 0 160 160;">
                                            <path d="M80,30c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50S52.4,30,80,30 M80,0C35.8,0,0,35.8,0,80s35.8,80,80,80
	s80-35.8,80-80S124.2,0,80,0L80,0z"></path>
                                        </svg>
                                    </div>
                                    <div class="u-shape u-shape-svg u-text-palette-1-base u-shape-2">
                                        <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 160">
                                            <use xlink:href="#svg-9d3d"></use>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                            xml:space="preserve" class="u-svg-content" viewBox="0 0 160 160" x="0px"
                                            y="0px" id="svg-9d3d" style="enable-background:new 0 0 160 160;">
                                            <path d="M80,30c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50S52.4,30,80,30 M80,0C35.8,0,0,35.8,0,80s35.8,80,80,80
	s80-35.8,80-80S124.2,0,80,0L80,0z"></path>
                                        </svg>
                                    </div>
                                    <div class="u-shape u-shape-svg u-text-palette-2-base u-shape-3">
                                        <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 80">
                                            <use xlink:href="#svg-50e6"></use>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                            xml:space="preserve" class="u-svg-content" viewBox="0 0 160 80" x="0px"
                                            y="0px" id="svg-50e6">
                                            <path
                                                d="M34.9,0H0c0,44.3,35.7,80,80,80s80-35.7,80-80h-34.9c0,25-20.1,45.1-45.1,45.1S34.9,25,34.9,0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="u-align-left u-container-style u-layout-cell u-size-24 u-layout-cell-2">
                                <div class="u-container-layout u-valign-middle u-container-layout-2">
                                    <h1 class="u-custom-font u-font-montserrat u-text u-text-palette-2-base u-text-1">
                                        Build Your <span style="font-weight: 700;">Future</span>
                                    </h1>
                                    <p class="u-text u-text-2">Working with Bana to create a better enviroment for
                                        learning all around the world.</p>
                                    </p>
                                    <a href="#"
                                        class="u-active-palette-2-base u-border-2 u-border-active-palette-2-base u-border-hover-palette-2-base u-border-palette-2-base u-btn u-btn-round u-button-style u-hover-palette-2-base u-none u-radius-50 u-text-active-white u-text-black u-text-hover-white u-btn-2">Register
                                        now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	
        <div class="row mb-2 mag">
            <div class="col-xs-12 col-sm-12 col-md-4 ">
                <div class="row g-0 rounded overflow-hidden flex-row mb-4   position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2">Schools</strong>
                        <h3 class="mb-0">Learners</h3>
                        <div class="mb-1 text-muted">University</div>
                        <p class="card-text mb-auto">Meet students from around the world, and maximize the potential.
                            Bana is a great platform for leaners to connect with peers from around the world and work on
                            interesting ideas together and showcase a different side of themselves.
                        </p>
                        <a href="#" class="stretched-link mt-2">Join Bana ></a>
                    </div>
                    <div class="col-auto  d-lg-block">
                        <img src="/assets/img/undraw_reading_time_gvg0.svg" alt="" width="350" height="350">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 ">
                <div class="row g-0  rounded overflow-hidden flex-row mb-4   position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 ">Learners</strong>
                        <h3 class="mb-0">Connecting</h3>
                        <div class="mb-1 text-muted">Businesses</div>
                        <p class="card-text mb-auto">As a business you will have access to the best students that you
                            can support from as early as possible. Bana has made it easier to get involved with the
                            schools and learners that can do with some help from organisations.
                        </p>
                        <a href="#" class="stretched-link mt-2">Join Bana ></a>
                    </div>
                    <div class="col-auto  d-lg-block">
                        <img src="/assets/img/undraw_travel_together_re_kjf2.svg" alt="" width="350" height="350">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="row g-0  rounded overflow-hidden flex-row mb-4  position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2">Connecting</strong>
                        <h3 class="mb-0">Partners</h3>
                        <div class="mb-1 text-muted">Organisation</div>
                        <p class="mb-auto">Nonprofits and all leading organizations can have access to a wide network of
                            schools, learners, and many more!
                            Bana allows you to leverage the power of tech to get involved with as many stakeholders as
                            possible and expand your work.
                            </p>
                        <a href="#" class="stretched-link mt-2">Join Bana ></a>
                    </div>
                    <div class="col-auto  d-lg-block">
                        <img src="/assets/img/undraw_the_world_is_mine_nb0e.svg" alt="" width="350" height="350">
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
      <footer class="footer ">
<div class="  bottom_border" style = "padding : 0 120px;">
<div class="row">
<div class=" col-sm-4 col-md col-sm-4  col-12 col mobile-off">
<div class= "mt-4">
<img src = "/assets/img/bana1.png" height= "120" width= "120">
</div>
<h5 class=" col_white_amrc headin5_amrc_1">Contact us</h5>
<!--heading-->
<p><i class="fa fa-location-arrow"></i> 12A Metropolitan Street<br/>&nbsp &nbsp &nbsp Highveld <br/>&nbsp &nbsp &nbsp Centurion <br/> &nbsp &nbsp &nbsp 0157 </p>
<p><i class="fa fa fa-envelope"></i> info@bana.vision </p>
</div>


<div class=" col-sm-4 col-md  col-6 col">
<h5 class="headin5_amrc col_white_amrc pt2">Network</h5>
<ul class="footer_ul_amrc">
                            <li><a href="{{url('schools')}}" class="">School</a></li>
                            <li><a href="/Colleges" class="">Colleges</a></li>
                            <li><a href="/University" class="">University</a></li>
                            <li><a href="/Businesses" class="">Businesses</a></li>
                            <li><a href="{{url('Orginazation')}}" class="">Organisation</a></li>
                            <li><a href="/Government" class="">Government</a></li>
                        </ul>
<!--footer ends here-->
</div>


<div class=" col-sm-4 col-md  col-6 col mobile-off">
<h5 class="headin5_amrc col_white_amrc pt2">Partners</h5>
 <ul class="footer_ul_amrc">
                            <li><a href="" class="">Department</a></li>
                            <li><a href="" class="">Bursaries</a></li>
                            <li><a href="" class="">Partners</a></li>
                            <li><a href="" class="">Company</a></li>
                            <li><a href="" class="">Social</a></li>
                        </ul>
</div>


<div class=" col-sm-4 col-md  col-12 col">
<h5 class="headin5_amrc col_white_amrc pt2">Company</h5>
<!--heading ends here-->
 <ul class="footer_ul_amrc">
                            <li><a href="/about/careers" class="">Careers</a></li>
                            <li><a href="/about/press" class="">Bana Press</a></li>
                            <li><a href="{{url('about-us')}}" class="">About Us</a></li>
                        </ul>

<!--footer ends here-->
</div>
</div>
</div>


<div class="container mt-2">
<!--foote_bottomends here-->
<p class="text-center">Copyright © 2021 Bana Vision. Pty Ltd.</p>
</div>

</footer>
<script  src="/assets/js/sidebar-mainpage.js"></script>
	</div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
	   
</body>

</html>
