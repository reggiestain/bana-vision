$(document).ready(function() {
     //SET EVENT ARRAY 
       var currentDate = new Date().toJSON().slice(0,10); 
       var eventsNames =JSON.parse('{{$eventsLiked}}'.replace(/&quot;/g,'"'));
       var eventsDates =JSON.parse('{{$eventsDates}}'.replace(/&quot;/g,'"'));
       var eventsNamesLength = eventsNames.length;
       var events =Array();
       for (var i=0;i<eventsNamesLength;i++)
      {
         events.push({
          title: eventsNames[i],
          start: eventsDates[i],
        });
      }
      console.log(eventsDates);

  //FULLCALENDAR CODE
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: currentDate,
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        var title = prompt('Event Title:');
        var eventData;
        if (title) {
          eventData = {
            title: title,
            start: start,
            end: end
          };
          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }
        $('#calendar').fullCalendar('unselect');
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      
      
     
      events: events
    });
    
  });