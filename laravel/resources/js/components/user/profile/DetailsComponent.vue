<template>
	<!--=======================DETAILS=======================-->
	<div role="tabcard"  class="tab-pane" id="details">
		<div class="p-3 row m-0">
			<h4 class="profile-tab-title">Details</h4>
			<a class="p-1 tab-icon-p  ml-auto ">
				<i class="fas fa-chevron-up " style="color:#c5c7cb"></i>
			</a>
			<a class="p-1 tab-icon-p ">
				<i class="fas fa-wrench" style="color:#c5c7cb">
				</i>
			</a>
			<a class="p-1 tab-icon-p ">
				<i class="fas fa-cog" style="color:#c5c7cb"></i>
			</a>
		</div>
		<div class="p-3">
			<!-- <div v-if="user.usable_type == 'App\\School'"> 
			<div class="well" style="padding-bottom:1px; " >
			
				<a class="collapsed details-subsection" data-toggle="collapse" href="#where-we-are" aria-expanded="false" aria-controls="collapse-example" id="where-we-are-co" style="display: block;width:100%">
					<h5 class="d-inline">
						Where we are
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>
				<div class="collapse" id="where-we-are">
				</div>
			
			</div>
			<hr>
		</div> -->
		
		<div v-if="user.usable_type != 'App\\Student'">
			<div class="well" style="padding-bottom:1px; ">
				<!--==========================QUICK FACTS================================-->

				<a class="details-subsection collapsed align-items-center" data-toggle="collapse" href="#quick-facts" aria-expanded="false" aria-controls="collapse-example" id="quick-facts-co" style="display: block;width:100%; margin:5px 0px;" >
					<h5 class="d-inline" >
						Quick facts
					</h5>
					<i class="fa fa-chevron-down float-right d-flex align-self-center">
					</i>
				</a>

				<div class="collapse" id="quick-facts">
					<ul v-if="user.usable_type == 'App\\School'"  class="dl-horizontal"  style="padding:3px;">
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">Pass rate :</p>
							{{usable.pass_rate}} %
						</li>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">
								Total number of students :
							</p>
							{{usable.number_students}}
						</li>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">
								Total number of teachers :
							</p>

							{{usable.number_teachers}}
						</li>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">
								Student to teacher ratio :
							</p>
							{{usable.number_students/usable.number_teachers}}
						</li>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">Current principal:</p>
							{{usable.principal}}
						</li>

					</ul>

					<ul v-else-if="user.usable_type == 'App\\Organization' || user.usable_type == 'App\\Company'"  class="dl-horizontal"  style="padding:3px;">
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">Registration number:</p>
							{{usable.registration_number}}
						</li>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">Year established :</p>
							{{usable.year_established}}
						</li>
						

						<div v-if="user.usable_type == 'App\\Company'">
							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Sector:
								</p>
								{{usable.sector}}
							</li>

							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Country of registration :
								</p>
								{{usable.registration_country}}
							</li>
						</div>

						<div v-if="user.usable_type == 'App\\Organization'">

							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Country of registration :
								</p>
								{{usable.operation_area_country}}
							</li>
						</div>

					</ul>
				</div> 
			</div>
			<hr>
		</div><!-- end school information -->

		<!--=============================CONTACT DETAILS==============================-->
		<div class="well" style="padding-bottom:1px; ">
			<div v-if="user.usable_type != 'App\\Student'">
				<!--==========================CONTACT DETAILS==================================-->

				<a class="details-subsection collapsed" data-toggle="collapse" href="#contact-details" aria-expanded="false" aria-controls="collapse-example" id="contact-details-co" style="display: block;width:100%">
					<h5 class="d-inline">
						Contact Details
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>

				<div class="collapse" id="contact-details">
					<ul  class="dl-horizontal" style="padding:3px">

						<div v-if="user.usable_type != 'App\\Student'"> 
							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Tel :
								</p>
								<a :href="tel">
									{{usable.telephone}}
								</a>
							</li>
						</div>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">
								Email :
							</p>
							<a :href="mailto">
								{{user.email}}
							</a>
						</li>
						<li class= "profile-info-list">
							<p class="profile-info-list-lable">
								Alternative Email :
							</p>
							<a :href="mailto">
								{{usable.bana_email_address}}
							</a>
						</li>
						<div v-if="user.usable_type != 'App\\Student'"> 
							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Website :
								</p>
								<a :href="usable.web_url" target="_blank">
									{{usable.web_url}}
								</a>
							</li>
							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Address :
								</p>
								<div v-if="user.usable_type == 'App\\School'">
									<address>{{usable.street_address}}</address>
								</div>
								<div v-else-if="user.usable_type == 'App\\Organization'">
									<address>{{usable.headquarters_address}},{{usable.headquarters_town}},{{usable.headquarters_area_code}}</address>
								</div>
								<div v-else-if="user.usable_type == 'App\\Company'">
									<address>{{usable.business_place_address}},{{usable.business_place_town}},{{usable.business_place_area_code}}</address>
								</div>
							</li>
							<li class= "profile-info-list">
								<p class="profile-info-list-lable">
									Postal Address :
								</p>
								<div v-if="user.usable_type == 'App\\School'">
									<address>{{usable.postal_address}}</address>
								</div>
								<div v-else-if="user.usable_type == 'App\\Organization'">
									<address>{{usable.headquarters_address}},{{usable.headquarters_town}},{{usable.headquarters_area_code}}</address>
								</div>
								<div v-else-if="user.usable_type == 'App\\Company'">
									<address>{{usable.business_place_address}},{{usable.business_place_town}},{{usable.business_place_area_code}}</address>
								</div>
							</li>
						</div>
					</ul>
				</div>

				<hr>
			</div>
		</div><!-- end contact details -->

		<!--============================= MISSION ==============================-->
		<div v-if="user.usable_type == 'App\\Organization' || user.usable_type == 'App\\Company'">
			<!--===========================================================-->
			<div class="well" style="padding-bottom:1px; ">
				<!--===========================OUR MISSION===============================-->

				<a class="details-subsection collapsed" data-toggle="collapse" href="#our-mission" aria-expanded="false" aria-controls="collapse-example" id="our-history-co" style="display: block;width:100%">
					<h5 class="d-inline">
						Our Mission
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>

				<div class="collapse" id="our-mission">
					<p >{{usable.mission}}</p>
				</div>
			</div>
			<!--===========================================================-->
			<hr>
		</div><!-- end mission  -->

		<!--=============================== VALUES ============================-->
		<div v-if="user.usable_type == 'App\\Company'">
			<!--===========================================================-->
			<div class="well" style="padding-bottom:1px; ">
				<!--===========================OUR VALUES===============================-->

				<a class="details-subsection collapsed" data-toggle="collapse" href="#our-values" aria-expanded="false" aria-controls="collapse-example" id="our-values-co" style="display: block;width:100%">
					<h5 class="d-inline">
						Our Values
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>

				<div class="collapse" id="our-values">
					<p >{{usable.values}}</p>
				</div>
			</div>
			<hr>
		</div><!-- end values -->


		<div v-if="user.usable_type == 'App\\Company'">
			<!--===========================================================-->
			<div class="well" style="padding-bottom:1px; ">
				<!--===========================OUR SERVICES===============================-->

				<a class="details-subsection collapsed" data-toggle="collapse" href="#our-services" aria-expanded="false" aria-controls="collapse-example" id="our-services-co" style="display: block;width:100%">
					<h5 class="d-inline">
						Our Services
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>

				<div class="collapse" id="our-services">
					<p >{{usable.services}}</p>
				</div>
			</div>
			<!--===========================================================-->
			<hr>
		</div><!-- end services -->

		<div v-if="user.usable_type == 'App\\School'">
			<!--===========================================================-->
			<div class="well" style="padding-bottom:1px; ">
				<!--===========================OUR HISTORY===============================-->

				<a class="details-subsection collapsed" data-toggle="collapse" href="#our-history" aria-expanded="false" aria-controls="collapse-example" id="our-history-co" style="display: block;width:100%">
					<h5 class="d-inline">
						Our History
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>

				<div class="collapse" id="our-history">
					<p class="d-inline" >{{usable.history.substring(0,256)}}</p>
					<a v-on:click="showHistoryModal">
						<i class="fas fa-ellipsis-h mr-2"></i>
					</a>
				</div>
			</div>
			<!--===========================================================-->
			<hr>

			<!--===========================================================-->
			<div class="well" style="padding-bottom:1px; ">
				<!--===========================OUR HISTORY===============================-->

				<a class="details-subsection collapsed" data-toggle="collapse" href="#about" aria-expanded="false" aria-controls="collapse-example" id="our-history-co" style="display: block;width:100%">
					<h5 class="d-inline">
						About us
					</h5>
					<i class="fa fa-chevron-down float-right">
					</i>
				</a>

				<div class="collapse" id="about">
					<p class="d-inline" >{{usable.about.substring(0,256)}}</p>
					<a v-on:click="showAboutModal">
						<i class="fas fa-ellipsis-h mr-2"></i>
					</a>
				</div>
			</div>
			<!--===========================================================-->
			<hr>
			

			<!--=====================================CURRICULUM=====================================-->

			<a class="details-subsection collapsed" data-toggle="collapse" href="#curriculum" aria-expanded="false" aria-controls="collapse-example" id="curriculum-co" style="display: block;width:100%">
				<h5 class="d-inline">
					Curriculum
				</h5>
				<i class="fa fa-chevron-down float-right">
				</i>
			</a>

			<div class="collapse" id="curriculum">
				<a href="#" class="p-1 tab-icon-p "><i class="fa fa-eye "></i> View</a><a class="p-1 tab-icon-p " href=" route('pdfview',['download'=>'pdf']) ">|  <i class="fas fa-file-pdf "></i> Download</a>
			</div>
			<hr>
			<!--=====================================STAFF MEMBERS=====================================-->

			<a class="details-subsection collapsed" data-toggle="collapse" href="#staff-members" aria-expanded="false" aria-controls="collapse-example" id="staff-members-co" style="display: block;width:100%">
				<h5 class="d-inline">
					Staff Members
				</h5>
				<i class="fa fa-chevron-down float-right">
				</i>
			</a>

			<!--===========================================================-->
			<div class="collapse" id="staff-members">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<!--===========================================================-->
					<div class="carousel-inner">
						<!--foreach($user->usable->staff->chunk(3) as $key => $chunk)-->

						<!--===========================================================-->
						<div v-for="(chunk,index) in chunkedStaffPosts" :class="isActive(index)">

							<!--foreach($chunk as $member)-->
							
							<!--===========================================================-->
							<div  v-for="member in chunk" class="col-4 float-left" style="padding-left:0;padding-right:0; ">
								<figure class="figure">
									<img class="rounded-circle figure-img img-fluid show-fullscreen" :data-src="staffPic(member)" :src="staffPic(member)" alt="Second slide" style="height: 3rem;width: 3rem">
									<figcaption class="figure-caption">
										<span style="display: block;">
											<a href="route('SchoolProfilePage',['user'=>$member->user->first()->slug])">
												{{member.name}}
											</a>
										</span>
										{{member.position}}
									</figcaption>
								</figure>
							</div>

									<!-- <div v-if="member.length == 0 ">
										<h2>Nothing to show at the moment</h2>
									</div> -->

									<!--===========================================================-->
									<!--endforeach-->

								</div>

								<!--===========================================================-->
								<!--endforeach-->
							</div>
							<!--===========================================================-->
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" dataslide="prev" >
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" dataslide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<!--===========================================================-->
					</div>
					<!--===========================================================-->
					<hr>
					<!--=====================================Ratings and Review=====================================-->

					<a class="details-subsection collapsed" data-toggle="collapse" href="#ratings-review" aria-expanded="false" aria-controls="collapse-example" id="ratings-review-co" style="display: block;width:100%">
						<h5 class="d-inline">
							Ratings and Review
						</h5>
						<i class="fa fa-chevron-down float-right">
						</i>
					</a>

					<div class="collapse" id="ratings-review">
						<!-- <ratings :user="user" :rating="rating"></ratings> -->
					</div>


				</div> <!-- end other school information -->
			</div><!--end p-3-->
		</div> <!--end details-->	
	</template>
<script>
import {Post} from '../../../Post.ts';
import { mapGetters } from 'vuex';
export default
{
	data:function(){
		return {
			staff: null,//this.user.usable.staff,
			post:null,
		}
	},
	methods:
	{
			isActive(index)
		{
			console.error(index);
			if(index === 0)
			{
				return 'carousel-item active';
			}
			else
			{
				return 'carousel-item';
			}
		},
		staffPic:function(member){
			//fix this please
			//return '../profile-picture/'+member.user[0].id;
			var pth;
				console.log(name);
				if(member.images)
				{


					pth = member.images[0].path;
					name = member.images[0].name;

            		//return '/sub-picture/'+name+'/'+name.substring(0, name.lastIndexOf('-'))+'-';
        		}
        		else if(member.imageable)
        		{
        			pth = member.imageable[0].path;
					name = member.imageable[0].name;
        		}
        		else
        		{
        			var img;
        			img = member[xtra_info].images[0];
        			pth = img.path;
        			name = img.name;
        		}
        		return '/sub-picture/'+name+'/'+pth.replace(/\//g,"-");
		},
		showHistoryModal:function()
		{
				this.$swal({
                	text: this.usable.history,
                	buttons: true,
            	});
		},
		showAboutModal:function()
		{
				this.$swal({
                	text: this.usable.about,
                	buttons: true,
            	});
		}
	},
	computed:
	{
		//get the auth status and user
          ...mapGetters({
            user:'user',
            usable:'usable',
        }),
		getRatingsCount:function()
		{
			return this.user.usable.ratings.length;
		},
		chunkedStaffPosts:function()
		{
			return _.chunk(this.staff,3)
		},
		/**
		 * [mailto description]
		 * @return {[type]} [description]
		 */
		mailto:function()
		{
			return 'mailto:'+ this.email;
		},
		tel:function()
		{
			return 'tel:'+ this.telephone;
		}
		
	},
	mounted()
	{
		//this.$store.commit('setuser',this.user);

		this.post = new Post();
    	this.post.get(this,'/api/'+this.$route.params.slug+'/usable',1,'user_id','usable');
	}
}
</script>
<style scoped>

</style>