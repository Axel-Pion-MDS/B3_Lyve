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
import ProgressBar from 'progressbar.js';
import img1 from '../../../public/img/cc7cc34a22ed5621635d443d0a87a1cb.png';
import img2 from '../../../public/img/1dace212e092ea819120fbea6b8c2417.png';
import img4 from '../../../public/img/e83c5c6372b33278248e0355c67e6eaa.png';
import img3 from '../../../public/img/66bb01e815194f1329512143ef3cc9c6.png';

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

  /**
   * Destroy chart
   */
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
      // case Chart.getChart('chart-tiktok') !== undefined:
      //   Chart.getChart('chart-tiktok').destroy();
      //   break;
      default:
    }
  };

  /**
   * render a progress bar
   *
   * @param {int} percent
   */
  renderProgressBar = (percent) => {
    const progressBar = document.querySelector('#progress-bar');
    const bar = new ProgressBar.Line(progressBar, {
      strokeWidth: 4,
      easing: 'easeInOut',
      duration: 1400,
      color: '#D11800',
      trailColor: '#FFF',
      trailWidth: 1,
      svgStyle: {
        width: '310px',
        height: '22px',
        border: '1px solid #D11800',
        borderRadius: '10px'
      },
      text: {
        style: {
          // Text color.
          // Default: same as stroke color (options.color)
          color: '#999',
          position: 'relative',
          left: '330px',
          top: '-25px',
          padding: 0,
          margin: 0,
          transform: null
        },
        autoStyleContainer: false
      },
      step: (state, progress) => {
        progress.setText(`${Math.round(progress.value() * 100)} %`);
      }
    });

    bar.animate(percent); // Number from 0.0 to 1.0
  };

  /**
   * Render insta chart
   *
   * @returns {*}
   */
  renderInstaCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    // const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    // const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'block';
    facebook.style.display = 'none';
    twitch.style.display = 'none';
    // tiktok.style.display = 'none';

    instaBtn.className = 'pressed';
    facebookBtn.className = '';
    twitchBtn.className = '';
    // tiktokBtn.className = '';

    const instaData = {
      labels: ['Total abonnés', 'Total vues', 'Pic de vues', '% Taux de conversion', 'Achats'],
      datasets: [{
        data: [250, 700, 436, 10.7, 159],
        fill: true,
        backgroundColor: [
          '#ffb950',
          '#ff931f',
          '#fa5e1f',
          '#b81702',
          '#7a0103'
        ]
      }]
    };

    const instaConfig = {
      type: 'doughnut',
      data: instaData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
          line: {
            borderWidth: 3
          }
        },
        plugins: {
          legend: true,
          title: {
            text: 'Juin 2022',
            display: true
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

  /**
   * Render facebook chart
   *
   * @returns {*}
   */
  renderFacebookCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    // const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    // const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'none';
    facebook.style.display = 'block';
    twitch.style.display = 'none';
    // tiktok.style.display = 'none';

    instaBtn.className = '';
    facebookBtn.className = 'pressed';
    twitchBtn.className = '';
    // tiktokBtn.className = '';

    const facebookData = {
      labels: ['Total abonnés', 'Total vues', 'Pic de vues', '% Taux de conversion', 'Achats'],
      datasets: [{
        data: [250, 700, 436, 10.7, 159],
        fill: true,
        backgroundColor: [
          '#ffb950',
          '#ff931f',
          '#fa5e1f',
          '#b81702',
          '#7a0103'
        ]
      }]
    };

    const facebookConfig = {
      type: 'doughnut',
      data: facebookData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
          line: {
            borderWidth: 3
          }
        },
        plugins: {
          legend: true,
          title: {
            text: 'Juin 2022',
            display: true
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

  /**
   * render twitch chart
   *
   * @returns {*}
   */
  renderTwitchCharts = () => {
    const insta = document.querySelector('#chart-insta');
    const facebook = document.querySelector('#chart-facebook');
    const twitch = document.querySelector('#chart-twitch');
    // const tiktok = document.querySelector('#chart-tiktok');
    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    // const tiktokBtn = document.querySelector('#stat-tiktok-button');

    insta.style.display = 'none';
    facebook.style.display = 'none';
    twitch.style.display = 'block';
    // tiktok.style.display = 'none';

    instaBtn.className = '';
    facebookBtn.className = '';
    twitchBtn.className = 'pressed';
    // tiktokBtn.className = '';

    const twitchData = {
      labels: ['Total abonnés', 'Total vues', 'Pic de vues', '% Taux de conversion', 'Achats'],
      datasets: [{
        data: [250, 700, 436, 10.7, 159],
        fill: true,
        backgroundColor: [
          '#ffb950',
          '#ff931f',
          '#fa5e1f',
          '#b81702',
          '#7a0103'
        ]
      }]
    };

    const twitchConfig = {
      type: 'doughnut',
      data: twitchData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
          line: {
            borderWidth: 3
          }
        },
        plugins: {
          legend: true,
          title: {
            text: 'Juin 2022',
            display: true
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

  // renderTiktokCharts = () => {
  //   const insta = document.querySelector('#chart-insta');
  //   const facebook = document.querySelector('#chart-facebook');
  //   const twitch = document.querySelector('#chart-twitch');
  //   const tiktok = document.querySelector('#chart-tiktok');
  //   const instaBtn = document.querySelector('#stat-insta-button');
  //   const facebookBtn = document.querySelector('#stat-facebook-button');
  //   const twitchBtn = document.querySelector('#stat-twitch-button');
  //   const tiktokBtn = document.querySelector('#stat-tiktok-button');

  //   insta.style.display = 'none';
  //   facebook.style.display = 'none';
  //   twitch.style.display = 'none';
  //   tiktok.style.display = 'block';

  //   instaBtn.className = '';
  //   facebookBtn.className = '';
  //   twitchBtn.className = '';
  //   tiktokBtn.className = 'pressed';

  //   const tiktokData = {
  //     labels: ['Total abonnés', 'Total vues', 'Pic de vues', '% Taux de conversion', 'Achats'],
  //     datasets: [{
  //       data: [250, 700, 436, 10.7, 159],
  //       fill: true,
  //       backgroundColor: [
  //         '#ffb950',
  //         '#ff931f',
  //         '#fa5e1f',
  //         '#b81702',
  //         '#7a0103'
  //       ]
  //     }]
  //   };

  //   const tiktokConfig = {
  //     type: 'doughnut',
  //     data: tiktokData,
  //     options: {
  //       responsive: true,
  //       maintainAspectRatio: false,
  //       elements: {
  //         line: {
  //           borderWidth: 3
  //         }
  //       },
  //       plugins: {
  //         legend: true,
  //         maintainAspectRatio: false,
  //         title: {
  //           text: 'Juin 2022',
  //           display: true
  //         }
  //       }
  //     }
  //   };

  //   const tiktokChart = new Chart(
  //     tiktok,
  //     tiktokConfig
  //   );

  //   return (
  //     tiktokChart
  //   );
  // };

  /**
   * Render calendar
   *
   * @returns {*}
   */
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

  /**
   * Render selected link on the left navbar
   */
  renderSelectedLink = () => {
    const home = document.querySelector('#home-link');
    home.className = 'selected';
  };

  /**
   * Render the homepage
   *
   * @returns {*}
   */
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
          </div>
          <div class="stats">
            <div class="charts">
              <h4>Aperçu vue d'ensemble des stats</h4>
              <div id="home-statistics-buttons">
                <button type="button" id="stat-insta-button">Instagram</button>
                <button type="button" id="stat-facebook-button">Facebook</button>
                <button type="button" id="stat-twitch-button">Twitch</button>
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
            </div>
          </div>
        </div>
        <div class="badges-courses">
          <div class="badge-list">
            <h4>Badges acquis</h4>
            <div class="badges">
              <h6>1</h6>
              <img src="${img1}" />
              <p>Les 5 clefs pour réussir en marketing</p>
            </div>
            <div class="badges">
              <h6>2</h6>
              <img src="${img2}" />
              <p>Les faux-pas à éviter</p>
            </div>
            <div class="badges">
              <h6>3</h6>
              <img src="${img3}" />
              <p>Comment augmenter son nombre de followers</p>
            </div>
            <div class="badges">
              <h6>4</h6>
              <img src="${img4}" />
              <p>Avoir plus de visibilité</p>
            </div>
          </div>
          <div class="course-list">
            <h4>Aperçu formation actuelle</h4>
            <div class=home-course">
              <p>Fidéliser les clients</p>
              <div id="progress-bar"></div>
            </div>
          </div>
        </div>
      </div>
    `
  );

  /**
   * Run the script
   */
  run = () => {
    this.el.innerHTML = this.render();
    this.renderSelectedLink();
    this.renderCalendar();
    this.renderInstaCharts();
    this.renderProgressBar(0.25);

    const instaBtn = document.querySelector('#stat-insta-button');
    const facebookBtn = document.querySelector('#stat-facebook-button');
    const twitchBtn = document.querySelector('#stat-twitch-button');
    // const tiktokBtn = document.querySelector('#stat-tiktok-button');

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
    // tiktokBtn.addEventListener('click', () => {
    //   this.destroyChart();
    //   this.renderTiktokCharts();
    // });
  };
};

export default Homepage;
