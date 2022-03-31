<template>
  <div class="card" style="border:none">
    <div class="card-header p-0 border">
      <h5 class="d-block p-2">
        <span
          ><i class="fas fa-search"></i
          ><span class="ml-2">Search Results</span></span
        >
      </h5>
      <!--===================RESULTS NAV TAB===================-->
      <ul class="nav nav-tabs" role="tablist">
        <!--===================INSTITUTIONS NAV===================-->
        <li role="presentation" class="nav-item active">
          <a
            class="nav-link"
            href="#institutions"
            aria-controls="institutions"
            role="tab"
            data-toggle="tab"
          >
            <i class="fas fa-university" style="color:#f8c374"></i>
            <strong style="color: #000000" id="institutions-nav"
              >Institutions</strong
            >
          </a>
        </li>
        <!--END INSTITUTION NAV-->

        <!--===================EVENTS NAV===================-->
        <li role="presentation" class="nav-item">
          <a
            class="nav-link d-flex align-items-center"
            href="#events"
            aria-controls="events"
            role="tab"
            data-toggle="tab"
          >
            <i class="fas fa-calendar-alt" style="color: #0002ff"></i>
            <strong style="color: #000000" id="events-nav">Events</strong>
          </a>
        </li>
        <!--END EVENTS NAV-->

        <!--===================BURSARIES NAV===================-->
        <li role="presentation" class="nav-item">
          <a
            class="nav-link"
            href="#bursaries"
            aria-controls="bursaries"
            role="tab"
            data-toggle="tab"
          >
            <i class="fas fa-piggy-bank" style="color: #d1b808"></i>
            <strong style="color: #000000" id="bursaries-nav">Bursaries</strong>
          </a>
        </li>
        <!--END BURSARIES NAV-->

        <!--===================NEEDS NAV===================-->
        <li role="presentation" class="nav-item">
          <a
            class="nav-link"
            href="#needs"
            aria-controls="needs"
            role="tab"
            data-toggle="tab"
          >
            <i class="fas fa-hand-holding-heart" style="color: #d1b808"></i>
            <strong style="color: #000000" id="needs-nav">Needs</strong>
          </a>
        </li>
      </ul>
      <!--END NEEDS NAV-->

      <!--END RESULTS NAV TAB-->
    </div>
    <!--===================RESULTS TAB===================-->
    <div class="tab-content card-body p-0" style="background-color: #f0f0f0">
      <!--===================INSTITUTIONS===================-->
      <div role="tabcard" class="tab-pane active" id="institutions">
        @if ($searchResults !="") @foreach($searchResults as $post) @if($post
        instanceOf App\User) @include('includes.schoolData')
        <?php 
                $userIdNo = $post->user; ?> @endif @endforeach @endif
      </div>
      <!--END INSTITUTION-->

      <!--===================EVENTS===================-->
      <div role="tabcard" class="tab-pane" id="events">
        @if ($searchResults !="")
        <?php 
            $events = $searchResults;
          ?>
        @include('event.eventsData') @endif
      </div>
      <!--END EVENTS -->

      <!--===================BURSARIES===================-->
      <div
        role="tabcard"
        class="tab-pane"
        id="bursaries"
        style="margin-left: 2.25rem;"
      >
        @if ($searchResults !="")
        <?php
          $bursaries = $searchResults;
        ?>
        @include('bursary.bursariesData') @endif
      </div>
      <!--END BURSARIES-->

      <!--===================NEEDS===================-->
      <div role="tabcard" class="tab-pane" id="needs" style="">
        <div class="text-light" style="padding: 0.75rem">
          @if ($searchResults !="")
          <?php
              $needs = $searchResults;
            ?>
          @include('need.needsData') @endif
        </div>
      </div>
      <!--END NEEDS -->
    </div>
    <!--END RESULTS TAB-->
  </div>
</template>
<script>
export default {};
/*$(document).ready(function(){
      console.log("document loaded on search results");
      var no_events = 0;
      var no_bursaries = 0;
      var no_schools = 0;
      var no_needs = 0;
      //Increment the no of events
      $('.event').each(function(){
        ++no_events;
        console.log(no_events);
      });
      if(no_events > 0)
      {
        $('#events-nav').append('<span class="badge badge-pill badge-info ml-1 p-1">'+no_events+'</span>');
      }

      $('.bursary').each(function(){
        ++no_bursaries;
      });
      if(no_bursaries > 0)
      {
        $('#bursaries-nav').append('<span class="badge badge-pill badge-info ml-1 p-1">'+no_bursaries+'</span>');
      }

      $('.institution').each(function(){
        ++no_schools;
      });
      if(no_schools > 0)
      {
        $('#institutions-nav').append('<span class="badge badge-pill badge-info ml-1 p-1">'+no_schools+'</span>');
      }

      $('.need').each(function(){
        ++no_needs;
      });
      if(no_needs > 0)
      {
        $('#needs-nav').append('<span class="badge badge-pill badge-info ml-1 p-1">'+no_needs+'</span>');
      }
      
    });*/
</script>

<style scoped></style>
