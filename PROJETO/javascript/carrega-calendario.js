$(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,list'
      },
      defaultDate: Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
          {
                    id: 'a',
                    title: 'my event',
                    start: '2019-12-12',
                    end: '2019-12-12'
          }
      ]
    });
  });
