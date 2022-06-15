import './Timesheet.scss';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

const Timesheet = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderCalendar = () => {
    const calendarEl = document.querySelector('#calendar-full');
    const today = new Date();
    const eventStart = today.setHours(12, 0, 0);
    const eventEnd = today.setHours(12, 30, 0);
    const calendar = new Calendar(calendarEl, {
      plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
      themeSystem: 'bootstrap5',
      initialView: 'dayGridWeek',
      headerToolbar: {
        left: 'prev,today,next',
        center: 'title',
        right: ''
      },
      firstDay: 1,
      buttonText: {
        today: 'Aujourd\'hui'
      },
      buttonHints: {
        today: 'Cette semaine',
        next: 'Suivant',
        prev: 'Précédent'
      },
      dayHeaderFormat: {
        weekday: 'short',
        day: 'numeric'
      },
      events: [
        {
          id: '1',
          title: 'EventTest',
          start: eventStart,
          end: eventEnd,
          description: 'Petit test'
        }
      ]
    });

    calendar.setOption('locale', 'fr');
    calendar.updateSize();
    return `<div>${calendar.render()}</div>`;
  };

  render = () => (
    `
      <div id="timesheet">
        <h2>Timesheet</h2>
        <div id="calendar-full">

        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();
    this.renderCalendar();
  };
};

export default Timesheet;
