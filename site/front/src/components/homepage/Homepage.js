import './Homepage.scss';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import {
  Chart,
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip,
  SubTitle
} from 'chart.js';

Chart.register(
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip,
  SubTitle
);

const Homepage = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    const tiktok = document.querySelector('#chart-tiktok');
    const c1824 = document.querySelector('#chart-18-24');
    const c2534 = document.querySelector('#chart-25-34');
    const c3544 = document.querySelector('#chart-35-44');
    const c4554 = document.querySelector('#chart-45-54');

    const socialLabels = [
      'Vues',
      'Abonnés'
    ];

    const instaData = {
      labels: socialLabels,
      datasets: [{
        label: 'Instagram',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [60, 40]
      }]
    };

    const facebookData = {
      labels: socialLabels,
      datasets: [{
        label: 'Facebook',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [200, 76]
      }]
    };

    const twitchData = {
      labels: socialLabels,
      datasets: [{
        label: 'Twitch',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [163, 92]
      }]
    };

    const tiktokData = {
      labels: socialLabels,
      datasets: [{
        label: 'Instagram',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [4930, 291]
      }]
    };

    const c1824Data = {
      labels: socialLabels,
      datasets: [{
        label: '18 - 24 ans',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [2304, 1320]
      }]
    };

    const c2534Data = {
      labels: socialLabels,
      datasets: [{
        label: '25 - 34 ans',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [849, 312]
      }]
    };

    const c3544Data = {
      labels: socialLabels,
      datasets: [{
        label: '35 - 44 ans',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [292, 134]
      }]
    };

    const c4554Data = {
      labels: socialLabels,
      datasets: [{
        label: '45 - 54 ans',
        backgroundColor: [
          '#D11800',
          '#F2AC44'
        ],
        borderColor: '#FEFEFE',
        data: [102, 34]
      }]
    };

    const instaConfig = {
      type: 'doughnut',
      data: instaData,
      options: {}
    };

    const facebookConfig = {
      type: 'doughnut',
      data: facebookData,
      options: {}
    };

    const twitchConfig = {
      type: 'doughnut',
      data: twitchData,
      options: {}
    };

    const tiktokConfig = {
      type: 'doughnut',
      data: tiktokData,
      options: {}
    };

    const c1824Config = {
      type: 'bar',
      data: c1824Data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const c2534Config = {
      type: 'bar',
      data: c2534Data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const c3544Config = {
      type: 'bar',
      data: c3544Data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const c4554Config = {
      type: 'bar',
      data: c4554Data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const instaChart = new Chart(
      insta,
      instaConfig
    );
    const facebookChart = new Chart(
      facebook,
      facebookConfig
    );
    const twitchChart = new Chart(
      twitch,
      twitchConfig
    );
    const tiktokChart = new Chart(
      tiktok,
      tiktokConfig
    );
    const c1824Chart = new Chart(
      c1824,
      c1824Config
    );
    const c2534Chart = new Chart(
      c2534,
      c2534Config
    );
    const c3544Chart = new Chart(
      c3544,
      c3544Config
    );
    const c4554Chart = new Chart(
      c4554,
      c4554Config
    );

    return (
      instaChart,
      facebookChart,
      twitchChart,
      tiktokChart,
      c1824Chart,
      c2534Chart,
      c3544Chart,
      c4554Chart
    );
  };

  renderCalendar = () => {
    const calendarEl = document.querySelector('#calendar');
    const today = new Date();
    const eventStart = today.setHours(12, 0, 0);
    const eventEnd = today.setHours(12, 30, 0);
    const calendar = new Calendar(calendarEl, {
      plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
      initialView: 'listWeek',
      headerToolbar: {
        left: 'prev',
        center: 'title',
        right: 'next'
      },
      height: 300,
      contentHeight: 300,
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
      <div class="homepage-left-right">
        <div class="timesheets-stats">
          <div class="timesheets">
            <div class="timesheet-calendar">
              <h4>Aperçu planificateur</h4>
              <div id="calendar">
              </div>
            </div>
            <div class="timesheet-meetings">
              <div id="meetings">
              <h4>Prochaines dates importantes</h4>
                <div class="meeting-list">
                  <div class="meeting">
                    <h5>12 juin 2022</h5>
                    <p>Sephora - 17h</p>
                  </div>
                  <div class="meeting">
                    <h5>13 juin 2022</h5>
                    <p>Sephora - 17h</p>
                  </div>
                  <div class="meeting">
                    <h5>14 juin 2022</h5>
                    <p>Sephora - 17h</p>
                  </div>
                  <div class="meeting">
                    <h5>15 juin 2022</h5>
                    <p>Sephora - 17h</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="stats">
            <div class="charts">
              <h4>Aperçu vue d'ensemble des stats</h4>
              <div class="circle-charts">
                <div class="circle-chart">
                  <h5>Instagram</h5>
                  <canvas id="chart-insta"></canvas>
                </div>
                <div class="circle-chart">
                  <h5>Facebook</h5>
                  <canvas id="chart-facebook"></canvas>
                </div>
                <div class="circle-chart">
                  <h5>Twitch</h5>
                  <canvas id="chart-twitch"></canvas>
                </div>
                <div class="circle-chart">
                  <h5>Tiktok</h5>
                  <canvas id="chart-tiktok"></canvas>
                </div>
              </div>
              <div class="bar-charts">
                <div class="bar-chart">
                  <canvas id="chart-18-24"></canvas>
                </div>
                <div class="bar-chart">
                  <canvas id="chart-25-34"></canvas>
                </div>
                <div class="bar-chart">
                  <canvas id="chart-35-44"></canvas>
                </div>
                <div class="bar-chart">
                  <canvas id="chart-45-54"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="badges-courses">
          <div class="badge-list">
            <h4>Badges acquis</h4>
          </div>
          <div class="course-list">
            <h4>Aperçu formation actuelle</h4>
          </div>
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();
    this.renderCalendar();
    this.renderCharts();
  };
};

export default Homepage;
