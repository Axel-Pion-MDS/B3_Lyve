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

  destroyChart = () => {
    switch (true) {
      case Chart.getChart('chart-insta') !== undefined:
        Chart.getChart('chart-insta').destroy();
        break;
      case Chart.getChart('chart-facebook') !== undefined:
        Chart.getChart('chart-facebook').destroy();
        break;
      case Chart.getChart('chart-twitch') !== undefined:
        Chart.getChart('chart-twitch').destroy();
        break;
      case Chart.getChart('chart-tiktok') !== undefined:
        Chart.getChart('chart-tiktok').destroy();
        break;
      default:
    }
  };

  renderInstaCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'block';
    facebook.style.display = 'none';
    twitch.style.display = 'none';
    tiktok.style.display = 'none';

    instaBtn.className = 'pressed';
    facebookBtn.className = '';
    twitchBtn.className = '';
    tiktokBtn.className = '';

    const instaData = {
      labels: ['Total Abonnés', 'Abonnés 18-24 ans', 'Abonnés 25-34 ans', 'Abonnés 35-44 ans', 'Abonnés 45-54 ans', 'Total vues', 'Vues 18-24 ans', 'Vues 25-34 ans', 'Vues 35-44 ans', 'Vues 45-54 ans', 'Achats'],
      datasets: [{
        type: 'bar',
        label: 'Juin 2022',
        data: [20, 10, 6, 1, 3, 70, 33, 27, 8, 2, 345],
        backgroundColor: [
          '#F2AC44',
          '#FFE169',
          '#EDC531',
          '#C9A227',
          '#A47E1B',
          '#FFE169',
          '#C9A227',
          '#A47E1B'
        ]
      }]
    };

    const instaConfig = {
      type: 'scatter',
      data: instaData,
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

    return (
      instaChart
    );
  };

  renderFacebookCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'none';
    facebook.style.display = 'block';
    twitch.style.display = 'none';
    tiktok.style.display = 'none';

    instaBtn.className = '';
    facebookBtn.className = 'pressed';
    twitchBtn.className = '';
    tiktokBtn.className = '';

    const facebookData = {
      labels: ['Total Abonnés', 'Abonnés 18-24 ans', 'Abonnés 25-34 ans', 'Abonnés 35-44 ans', 'Abonnés 45-54 ans', 'Total vues', 'Vues 18-24 ans', 'Vues 25-34 ans', 'Vues 35-44 ans', 'Vues 45-54 ans', 'Achats'],
      datasets: [{
        type: 'bar',
        label: 'Juin 2022',
        data: [20, 10, 6, 1, 3, 70, 33, 27, 8, 2, 345],
        backgroundColor: [
          '#F2AC44',
          '#FFE169',
          '#EDC531',
          '#C9A227',
          '#A47E1B',
          '#FFE169',
          '#C9A227',
          '#A47E1B'
        ]
      }]
    };

    const facebookConfig = {
      type: 'scatter',
      data: facebookData,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const facebookChart = new Chart(
      facebook,
      facebookConfig
    );

    return (
      facebookChart
    );
  };

  renderTwitchCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'none';
    facebook.style.display = 'none';
    twitch.style.display = 'block';
    tiktok.style.display = 'none';

    instaBtn.className = '';
    facebookBtn.className = '';
    twitchBtn.className = 'pressed';
    tiktokBtn.className = '';

    const twitchData = {
      labels: ['Total Abonnés', 'Abonnés 18-24 ans', 'Abonnés 25-34 ans', 'Abonnés 35-44 ans', 'Abonnés 45-54 ans', 'Total vues', 'Vues 18-24 ans', 'Vues 25-34 ans', 'Vues 35-44 ans', 'Vues 45-54 ans', 'Achats'],
      datasets: [{
        type: 'bar',
        label: 'Juin 2022',
        data: [20, 10, 6, 1, 3, 70, 33, 27, 8, 2, 345],
        backgroundColor: [
          '#F2AC44',
          '#FFE169',
          '#EDC531',
          '#C9A227',
          '#A47E1B',
          '#FFE169',
          '#C9A227',
          '#A47E1B'
        ]
      }]
    };

    const twitchConfig = {
      type: 'scatter',
      data: twitchData,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const twitchChart = new Chart(
      twitch,
      twitchConfig
    );

    return (
      twitchChart
    );
  };

  renderTiktokCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'none';
    facebook.style.display = 'none';
    twitch.style.display = 'none';
    tiktok.style.display = 'block';

    instaBtn.className = '';
    facebookBtn.className = '';
    twitchBtn.className = '';
    tiktokBtn.className = 'pressed';

    const tiktokData = {
      labels: ['Total Abonnés', 'Abonnés 18-24 ans', 'Abonnés 25-34 ans', 'Abonnés 35-44 ans', 'Abonnés 45-54 ans', 'Total vues', 'Vues 18-24 ans', 'Vues 25-34 ans', 'Vues 35-44 ans', 'Vues 45-54 ans', 'Achats'],
      datasets: [{
        type: 'bar',
        label: 'Juin 2022',
        data: [20, 10, 6, 1, 3, 70, 33, 27, 8, 2, 345],
        backgroundColor: [
          '#F2AC44',
          '#FFE169',
          '#EDC531',
          '#C9A227',
          '#A47E1B',
          '#FFE169',
          '#C9A227',
          '#A47E1B'
        ]
      }]
    };

    const tiktokConfig = {
      type: 'scatter',
      data: tiktokData,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const tiktokChart = new Chart(
      tiktok,
      tiktokConfig
    );

    return (
      tiktokChart
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
              <div id="home-statistics-buttons">
                <button type="button" id="stat-insta-button">Instagram</button>
                <button type="button" id="stat-facebook-button">Facebook</button>
                <button type="button" id="stat-twitch-button">Twitch</button>
                <button type="button" id="stat-tiktok-button">Tiktok</button>
              </div>
              <div class="home-mixed-chart">
                <canvas id="chart-insta"></canvas>
              </div>
              <div class="home-mixed-chart">
                <canvas id="chart-facebook"></canvas>
              </div>
              <div class="home-mixed-chart">
                <canvas id="chart-twitch"></canvas>
              </div>
              <div class="home-mixed-chart">
                <canvas id="chart-tiktok"></canvas>
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
    this.renderInstaCharts();

    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    const tiktokBtn = document.querySelector('#stat-tiktok-button');

    instaBtn.addEventListener('click', () => {
      this.destroyChart();
      this.renderInstaCharts();
    });
    facebookBtn.addEventListener('click', () => {
      this.destroyChart();
      this.renderFacebookCharts();
    });
    twitchBtn.addEventListener('click', () => {
      this.destroyChart();
      this.renderTwitchCharts();
    });
    tiktokBtn.addEventListener('click', () => {
      this.destroyChart();
      this.renderTiktokCharts();
    });
  };
};

export default Homepage;
