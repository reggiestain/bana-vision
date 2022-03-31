 <!-- 
 =
 =
 =
 =  RIGHT SIDEBAR
 =
 =
 =
  -->

    @if(Route::current()->getName() === 'home')

        @else
        <!--WHEN NOT ON SPECIFIC SCHOOL PROFILE PAGE-->
        <?php
            $routes = array();
        ?>
        
        @if(!isset($userIdNo->name))
            <?php
                $routes['student_projects']=route('generalStudentProjects');
                $routes['student_awards']=route('generalStudentAwards');
                $routes['featured_students']=route('generalFeaturedStudents');
                $routes['our_needs']=route('generalNeeds');
                $routes['our_excess']=route('generalExcess');
                $routes['outreach_programme']='';
                $routes['our_events']=route('generalEvents');
                $routes['help_received_or_given']='';
                $routes['bursaries_available']=route('generalBursaries');
                $routes['internships_available']='';
            ?>


        <!--WHEN  ON SPECIFIC SCHOOL PROFILE PAGE-->
        @else
        <?php
                $routes['student_projects']=route('studentAwards',['user'=>$userPassedId->slug]);
                $routes['student_awards']=route('studentAwards',['user'=>$userPassedId->slug]);
                $routes['featured_students']=route('studentAwards',['user'=>$userPassedId->slug]);
                $routes['our_needs']=route('ourNeeds',['userIdNo'=>$userPassedId->slug]);
                $routes['our_excess']='';
                $routes['outreach_programme']='';
                $routes['our_events']=route('ourEventsPage',['userIdNo'=>$userPassedId]);
                $routes['help_received_or_given']=route('helpReceivedOrGiven',['userIdNo'=>$userPassedId->id]);
                $routes['bursaries_available']=route('getBursaries',['user'=>$userPassedId->slug]);
                $routes['internships_available']='';
        
        
          ?>                                                                                                                                                              
        @endif
        <div class="card col-12  collapse navbar-collapse" id="navigation-sidebar"> 
            <div class="card-body  col-12" style="padding: 1.25rem 0.75rem;"> 
                <h6>Students </h6>
                <div  class="list-group list-group-flush">

                    <!--====================STUDENT PROJECTS============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['student_projects']}}" >
                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/student-projects-01.svg')}}" >
                        </object>
                        <span class="ml-2">
                            Student projects
                        </span>
                    </a>

                    <!--====================STUDENT AWARDS============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['student_awards']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/student-awards-01.svg')}}" >
                        </object>
                        <span class="ml-2">
                            Student awards
                        </span>
                    </a>

                    <!--====================FEATURED STUDENTS============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['featured_students']}}">

                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/featured-students-01.svg')}}" >
                        </object>
                        <span class="ml-2">
                            Featured students   
                        </span>
                    </a>
                    
                </div>
                <hr style="border-color:#1001f4">
                <h6>How You Can Help</h6>
                <div  class="list-group list-group-flush">

                    <!--====================OUR NEEDS============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['our_needs']}}">
                        <object  type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/our-needs-01.svg')}}" style="width: 20px">
                        </object>
                        <span class="ml-2">
                            Needs
                        </span>
                    </a>

                    <!--====================OUR EXCESS============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['our_excess']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/excess-01.svg')}}" style="width: 20px" >
                        </object>
                        <span class="ml-2">
                            Excess
                        </span>
                    </a>

                    <!--===================OUTREACH PROGRAMME============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['outreach_programme']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/outreach-01.svg')}}" style="width: 20px">
                        </object>
                        <span class="ml-2">
                            Outreach programme
                        </span>
                    </a>
                    
                </div>
                <hr style="border-color:#1001f4">
                <h6>Announcements</h6>
                <div  class="list-group list-group-flush">

                    <!--====================EVENTS============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['our_events']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/events-01.svg')}}" style="width: 20px">
                        </object>
                        <span class="ml-2">
                            Events
                        </span>
                    </a>

                    <!--====================HELP RECEIVED OR GIVEN============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['help_received_or_given']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons"  data="{{URL::asset('assets/icons/help-received-given-01.svg')}}" style="width: 20px">
                        </object>
                        <span class="ml-2">
                            Help received or given
                        </span>
                    </a>

                    <!--====================BURSARIES AVAILABLE============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['bursaries_available']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons" data="{{URL::asset('assets/icons/bursaries-01.svg')}}" style="width: 20px">
                        </object>
                        <span class="ml-2">
                            Bursaries available
                        </span>
                    </a>

                    <!--====================INTERNSHIPS AVAILABLE============================================-->
                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{$routes['internships_available']}}">
                        <object type="image/svg+xml" class="img-circle svg-icons"  data="{{URL::asset('assets/icons/internship-01.svg')}}" style="width: 20px">
                        </object>
                        <span class="ml-2">
                            internships available
                        </span>
                    </a>
                    <!--Adimn-->
                     
                </div>
                <hr style="border-color:#1001f4">
                <h6>Tools</h6>
                <div class="list-group list-group-flush">
                    @auth
                        @if(isset($userIdNo->name))
                            @if(Auth::id() == $userIdNo->id)
                                @if(($userIdNo->usable_type == 'App\School') ||($userIdNo->usable_type == 'App\Staff' && $userIdNo->usable->first()->school->user->first()->id == $userIdNo->id))
                                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{route('getAdminPage',['user'=>$userIdNo])}}">
                                        <i class="fas fa-cogs " style="font-size: 1.046rem;color: #a9a9a9;"></i> 
                                        <span class="ml-2">
                                            Admin
                                        </span>
                                    </a>
                                @endif
                                @if($userIdNo->usable_type == 'App\School' )
                                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{route('library',['user'=>$userIdNo])}}">
                                        <i class="fas fa-book-open " style="font-size: 1.046rem;"></i> 
                                        <span class="ml-2">
                                            Library
                                        </span>
                                    </a>
                                @elseif($userIdNo->usable_type !='App\Company' && $userIdNo->usable_type != 'App\Organization')
                                    <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{route('library',['user'=>$userIdNo->usable->school->user->first()])}}">
                                        <i class="fas fa-book-open " style="font-size: 1.046rem;"></i> 
                                        <span class="ml-2">
                                            Library
                                        </span>
                                    </a>
                                @endif
                                <a class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center" href="{{route('getNotes',['user'=>$userIdNo])}}">
                                        <i class="fas fa-file-alt " style="font-size: 1.046rem;"></i> 
                                        <span class="ml-2">
                                            My notes
                                        </span>
                                    </a>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <!--END SIDEBAR-->
    @endif