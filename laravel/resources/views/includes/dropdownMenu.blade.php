
<!--*******************DROPDOWN MENU********************************************************-->
            <div class=" dropdown-menu dropdown-menu-right" style="border-radius: 1rem;min-width:15rem;padding:0" aria-labelledby="dropdown-content">
               @if (Auth::check())
               
                   <ul>
                       <li>
                        <a class="dropdown-item" href="{{route('SchoolProfilePage',['user'=>Auth::user()->slug])}}">
                        <i class="fas fa-home"></i><span class="ml-2">Edit profile</span>
                      </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{route('getFeed',['user'=>Auth::user()->slug])}}">
                        <i class="fas fa-rss-square"></i><span class="m-2">Go to feed</span>
                      </a>
                    </li>
                       
                       <!--link to the school-->
                      @switch(Auth::user()->usable_type)
                        @case('App\Company')
                        @break

                        @case('App\Organization')
                        @break

                        @case('App\School')
                        @break

                        @default
                          @if(Auth::user()->usable->school)
                            <li>
                              <a class="dropdown-item" href="{{route('SchoolProfilePage',['user'=>Auth::user()->usable->school->first()->user->first()->slug])}}">
                              <i class="fas fa-university"></i>
                              <span class="ml-2">
                                Go to school
                              </span>
                              </a>
                            </li>
                          @endif
                          
                      @endswitch

                       
                       <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="fas fa-lock"></i><span class="ml-2">{{ __('Logout') }}</span>
                       </a>

                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </li>

                    </ul>
               
               @else
               <!--DROPDOWN FORM-->
                  <h6 class="dropdown-header">Please login below :</h6>
                  <form class="px-3 py-2 " action="{{url('/login')}}" method="post">
                    <div class="form-group  " id="institution_div" >
                    
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-sm" type="text" name="email" id="email" value="{{Request::old('email')}}" placeholder="&#xf007; username" style='border-radius: 12rem;font-weight:900;font-family: "Font Awesome\ 5 Free","Open Sans", Verdana, sans-serif;'>
                      @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    
                    </div>

                    <div class="form-group " id="institution_div" >
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-sm" type="password" name="password" id="password" value="{{Request::old('password')}}" placeholder="&#xf023; password" style='border-radius: 12rem;font-weight:900;font-family: "Font Awesome\ 5 Free", "Open Sans", Verdana, sans-serif;'> 
                      @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>
                                          {{ $errors->first('password') }}
                                        </strong>
                                    </span>
                                @endif
                    </div> 
                    
                    <button type="submit" class="btn btn-sm btn-orange" style="border-radius: 12rem;;padding-bottom: 0.15rem;padding-top: 0.15rem;">
                      <i class="fa fa-lock" style="padding-right: 0.25rem">
                      </i>Login
                    </button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">

                    </form> 
                    <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{url('/register')}}">New around here? Sign up</a>
                      <a class="dropdown-item" href="#">Forgot password?</a> 
               
               @endif
                
            </div>
            <!--*******************END DROPDOWN********************************************************-->