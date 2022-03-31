@foreach ($news_feed->sortByDesc('created_at') as $key=>$post)
      		@switch(get_class($post))
    			@case('App\OurEvent')
    				<?php $events = $post; ?>
        			@include('event.eventsData')
        		@break

    			@case('App\Bursary')
        			<?php $bursaries = $post; ?>
        			@include('bursariesData')
        			@break

                @case('App\User')
                    @include('includes.schoolData')
                    @break

                @case('App\OurNeed')
                    @include('singleNeedData')
                    @break
                
                @case('App\StudentAward')
                    @include('singleStudentAwardData')
                    @break

                @case('App\LibraryBook')
                    @include('singleBookData')
                    @break

                @case('App\StudentsProject')
                    @include('singleStudentProjectData')
                    @break

                @case('App\FeaturedStudent')
                    @include('singleFeaturedStudentData')
                    @break
    		@default
        
			@endswitch
      @endforeach