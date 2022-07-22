import axios from 'axios';
import './Timesheet.scss';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import Tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import moment from 'moment';

const Timesheet = class {
  constructor() {
    this.el = document.querySelector('#body');
    this.date = moment();
    this.formattedDate = `${String(this.date.format('YYYY'))}-${String(this.date.format('M')).padStart(2, '0')}-${String(this.date.format('D')).padStart(2, '0')}`;
    this.maxDate = this.date.days(60);
    this.hour = String(this.date.hour()).padStart(2, '0');
    this.minute = String(this.date.minute()).padStart(2, '0');
    this.endTime = moment().add(30, 'minutes').format('HH:mm');
    this.time = `${this.hour}:${this.minute}`;
    this.calendar = '';
  }

  /**
   * Get user's timesheet from its session stored email
   *
   * @param {string} email
   */
  getUserTimesheet = (email) => {
    axios.post('https://lyve.local/user/timesheet', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        email
      }
    }).then((res) => {
      if (res.data.data) {
        res.data.data.forEach((item) => {
          item.timesheets.forEach((value) => {
            this.addEventOnCalendar(
              value.title,
              value.startDate,
              value.endDate,
              value.comment
            );
          });
        });
      }
    }).catch((err) => { throw new Error(err); });
  };

  /**
   * Verify if a button as been clicked on
   */
  verifyClickOnButtons = () => {
    this.waitForElm('#confirm-btn').then(() => {
      const confirmBtn = document.querySelector('#confirm-btn');
      confirmBtn.addEventListener('click', () => {
        this.cancelButton();
      });
    });

    this.waitForElm('#exit-cross').then(() => {
      const cross = document.querySelector('#exit-cross');
      cross.addEventListener('click', () => this.cancelButton());
    });
  };

  /**
   * Add an event on the calendar
   *
   * @param {string} title
   * @param {date} startDate
   * @param {date} endDate
   * @param {string} comment
   */
  addEventOnCalendar = (title, startDate, endDate, comment) => {
    this.calendar.addEvent({
      title,
      start: startDate,
      end: endDate,
      description: comment
    });
  };

  /**
   * Add an event to the timesheet
   *
   * @param {string} title
   * @param {Object} calendar
   * @param {Date} startDate
   * @param {Date} startTime
   * @param {Date} endDate
   * @param {Date} endTime
   * @param {string} notes
   */
  addEventOnCalendarWithButton = (
    title,
    calendar,
    start,
    startTime,
    end,
    endTime,
    notes = null
  ) => {
    const messages = document.querySelector('#messages');

    axios.post('https://lyve.local/timesheet/add', {
      host: 'lyve.local',
      header: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        title,
        startDate: `${start} ${startTime}:00`,
        endDate: `${end} ${endTime}:00`,
        comment: notes,
        createdBy: window.localStorage.length > 0 ? window.localStorage.getItem('user') : window.sessionStorage.getItem('user')
      }
    }).then((res) => {
      if (res.data.result === 'success') {
        calendar.addEvent({
          title,
          start: `${start}T${startTime}`,
          end: `${end}T${endTime}`,
          description: notes
        });

        if (messages.innerHTML.trim() !== '') {
          messages.className = 'show';
          this.verifyClickOnButtons();
        }

        messages.innerHTML = this.renderConfirmMessage();
      }
    });
  };

  /**
   * Hide div when clicking on cancel buttons
   */
  cancelButton = () => {
    const formBackground = document.querySelector('#rdv-background');
    const form = document.querySelector('#rdv-form');
    const messages = document.querySelector('#messages');
    formBackground.className = 'hide';
    form.className = 'hide';
    messages.className = 'hide';
  };

  /**
   * Render confirmation div
   *
   * @returns string
   */
  renderConfirmMessage = () => {
    const form = document.querySelector('#rdv-form');
    const messages = document.querySelector('#messages');
    form.className = 'hide';
    messages.className = 'show';

    return `
      <div id="confirm-message">
        <button type="button" id="exit-cross">X</button>
        <h2>Votre demande de rendez-vous a été confirmée !</h2>
        <div class="separator">
        </div>
        <button type="button" id="confirm-btn">OK</button>
      </div>
    `;
  };

  /**
   * Render form
   * @returns string
   */
  renderForm = () => {
    const formBackground = document.querySelector('#rdv-background');
    const form = document.querySelector('#rdv-form');
    formBackground.className = 'show';
    form.className = 'show';

    return `
      <h5>Demander un rendez-vous</h5>
      <div class="rdv-form-inputs">
        <div class="rdv-form-title">
          <label for="form-title">Titre</label>
          <input type="text" id="form-title" name="form-title">
        </div>
        <div class="rdv-form-start">
          <h6>Début</h6>
          <div class="inputs">
            <input type="date" id="form-start-date" name="form-start-date" value="${this.formattedDate}" min="09:00" max="19:00" required>
            <input type="time" id="form-start-time" name="form-start-time" value="${this.time}" min="09:00" max="19:00" required>
          </div>
        </div>
        <div class="rdv-form-end">
          <h6>Fin</h6>
          <div class="inputs">
            <input type="date" id="form-end-date" name="form-end-date" value="${this.formattedDate}" min="09:00" max="19:00" required>
            <input type="time" id="form-end-time" name="form-end-time" value="${this.endTime}" min="09:00" max="19:00" required>
          </div>
        </div>
        <div class="rdv-form-notes">
          <label for="form-note-text">Notes</label>
          <textarea id="form-note-text" name="form-note-text"></textarea>
        </div>
        <div class="rdv-form-buttons">
          <button type="button" id="rdv-form-button-cancel">Annuler</button>
          <button type="button" id="rdv-form-button-create">Créer</button>
        </div>
      </div>
    `;
  };

  /**
   * Render the timesheet calendar
   *
   * @returns string
   */
  renderCalendar = () => {
    const calendarEl = document.querySelector('#calendar-full');
    const today = moment();
    const eventStart = today.hours(12).minutes(0).format();
    const eventEnd = today.hours(12).minutes(30).format();
    const calendar = new Calendar(calendarEl, {
      plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
      themeSystem: 'bootstrap5',
      // initialView: 'dayGridWeek',
      initialView: 'timeGridWeek',
      eventDidMount: (info) => {
        // eslint-disable-next-line no-new
        new Tippy(info.el, {
          content: info.event.extendedProps.description,
          placement: 'bottom',
          arrow: true,
          animation: 'scale-extreme'
        });
      },
      customButtons: {
        myCustomButton: {
          text: 'Demander un RDV',
          hint: 'rdv',
          click: () => {
            const form = document.querySelector('#rdv-form');

            form.innerHTML = this.renderForm();

            this.waitForElm('#rdv-form-button-create').then(() => {
              const createBtn = document.querySelector('#rdv-form-button-create');

              createBtn.addEventListener('click', () => {
                const title = document.querySelector('#form-title').value;
                const startDate = document.querySelector('#form-start-date').value;
                const startTime = document.querySelector('#form-start-time').value;
                const endDate = document.querySelector('#form-end-date').value;
                const endTime = document.querySelector('#form-end-time').value;
                const notes = document.querySelector('#form-note-text').value;

                this.addEventOnCalendarWithButton(
                  title,
                  calendar,
                  startDate,
                  startTime,
                  endDate,
                  endTime,
                  notes
                );
              });
            });

            this.waitForElm('#rdv-form-button-cancel').then(() => {
              const cancelBtn = document.querySelector('#rdv-form-button-cancel');

              cancelBtn.addEventListener('click', () => this.cancelButton());
            });
          }
        }
      },
      headerToolbar: {
        left: 'prev,today,next',
        center: 'title',
        right: 'myCustomButton'
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
    this.calendar = calendar;
    return `<div>${calendar.render()}</div>`;
  };

  /**
   * Change className of the agenda in left navbar
   */
  renderSelectedLink = () => {
    const timesheet = document.querySelector('#timesheet-link');
    timesheet.className = 'selected';
  };

  /**
   * First render
   * @returns string
   */
  render = () => (
    `
      <div id="timesheet">
        <div id="calendar-full">
        </div>
        <div id="rdv-background" class="hide">
        </div>
        <div id="messages" class="hide">
        </div>
        <div id="rdv-form" class="hide">
        </div>
      </div>
    `
  );

  /**
   * Wait for an element to be created to listen on the onClick
   * @param {string} selector
   * @returns {*}
   */
  waitForElm(selector) {
    return new Promise((resolve) => {
      if (document.querySelector(selector)) {
        resolve(document.querySelector(selector));
      }

      const observer = new MutationObserver(() => {
        if (document.querySelector(selector)) {
          resolve(document.querySelector(selector));
          observer.disconnect();
        }
        return 1;
      });

      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
    });
  }

  /**
   * Run method
   */
  run = () => {
    const user = window.localStorage.length > 1 ? window.localStorage.getItem('user')
      : window.sessionStorage.getItem('user');

    this.el.innerHTML = this.render();
    this.renderSelectedLink();
    this.renderCalendar();
    this.getUserTimesheet(user);
    this.verifyClickOnButtons();
  };
};

export default Timesheet;
