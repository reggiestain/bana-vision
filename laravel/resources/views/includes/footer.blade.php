<!--FOOTER-->


<footer class="container-fluid row m-0 mt-4 bg-white text-dark @if(Route::currentRouteName() != 'home') d-lg-none d-md-none d-xl-none @endif col-md-12 col-sm-12 col-xs-12 border-success border-top p-3" id="footer">

	<div class="col-md-3 col-12" id="social-icons-container">
		<a class="navbar-logo" href='route('home')'  id="footer-img"><span><img src="{{URL::asset('/assets/img/bana.png'

			)}}" height="50px"></span></a>
			<a ><span><i class="fab fa-facebook borderedIcon1"></i></span></a>
			<a ><span><i class="fab fa-twitter borderedIcon1"></i></span></a>
			<a ><span><i class="fab fa-linkedin borderedIcon1"></i></span></a>
		</div>

		<div class="row col-md-6 col-12 m-0">
		<div class="col-6">
			<h3 class="text-primary">
				About Bana
			</h3>
			<ul  style="list-style:none;">
				<li>
					<a href="route('getAboutUsPage')">
						<i class="fas fa-info-circle"></i>
						<span class="ml-1">
						About us
					</span>
				</a>
			</li>
				<li>
					<i class="fas fa-hand-holding-heart"></i>
					<span class="ml-1">
					Get involved
				</span>
			</li>
				<li>
					<i class="fas fa-question-circle text-primary"></i>
					<span class="l-1">
				Things to know
			</span>
		</li>
				<li>
					<a  data-toggle="modal" data-target="#student-support" >
						<i class="fas fa-life-ring text-danger"></i>
						<span class="ml-1">
					Student support
				</span>
				</a>
			</li>
			</ul>
		</div >

		<div class="col-6" id="about-container">
			<h3 class="text-primary">Our Network</h3>
			<ul  style="list-style:none">
				<li>
					<a href="route('schoolsPage')">
						<i class="fas fa-school" style="color: tan"></i>
						<span class="ml-1">
						Schools
						</span>
					</a>
				</li>
				<li>
					<i class="fas fa-university" style="color: tan"></i>
					<span class="ml-1">
					Colleges
				</span>
				</li>
				<li>
					<i class="fas fa-university" style="color: tan"></i>
					<span class="ml-1">
				Universities
				</span>
			</li>
				<li>
					<a href="route('companiesPage')">
				<i class="fas fa-store text-info"></i>
					<span class="ml-1">Businesses
					</span>
				</a>
				</li>
				<li>
				<a href="route('organizationsPage')">
				<i class="fas fa-warehouse" style="color: tan"></i>
					<span class="ml-1">
				Organizations
			</span>
		</a>
		</li>
			</ul>
		</div>

	</div>

		<div class="row col-md-3 col-12"  >
			<a>
				<span>
				<button type="button" class="btn" style="border-radius:45px;background-color:lightseagreen">
				<i class="fa fa-phone">
				 Contact us
				</i>
			</button>
			</span>
			</a>
		</div>

</footer>
<!--END FOOTER-->