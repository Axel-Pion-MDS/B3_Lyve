import './Statistics.scss';
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

const Statistics = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  destroyChart = () => {
    switch (true) {
      case Chart.getChart('instagram') !== undefined:
        Chart.getChart('instagram').destroy();
        break;
      case Chart.getChart('facebook') !== undefined:
        Chart.getChart('facebook').destroy();
        break;
      case Chart.getChart('twitch') !== undefined:
        Chart.getChart('twitch').destroy();
        break;
      case Chart.getChart('tiktok') !== undefined:
        Chart.getChart('tiktok').destroy();
        break;
      default:
    }
  };

  renderInstaCharts = () => {
    const insta = document.querySelector('#instagram');
    const facebook = document.querySelector('#facebook');
    const twitch = document.querySelector('#twitch');
    const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Total Abonnés',
        data: [2, 10, 55, 12, 70, 20, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#D11800'
        ],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 18 - 24 ans',
        data: [1, 3, 12, 5, 47, 10, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F08080'
        ],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 25 - 34 ans',
        data: [1, 4, 35, 4, 14, 6, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F4978E'
        ],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 35 - 44 ans',
        data: [0, 2, 5, 1, 6, 1, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F8AD9D'
        ],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 45 - 54 ans',
        data: [0, 0, 3, 2, 3, 3, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#FBC4AB'
        ],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: [10, 50, 200, 150, 300, 70, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'bar',
        label: 'Vues 18 - 24 ans',
        data: [6, 29, 57, 47, 139, 33, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'bar',
        label: 'Vues 25 - 34 ans',
        data: [3, 12, 83, 100, 101, 27, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'bar',
        label: 'Vues 35 - 44 ans',
        data: [1, 7, 21, 2, 63, 8, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'bar',
        label: 'Vues 45 - 54 ans',
        data: [0, 2, 39, 11, 37, 2, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: [123, 97, 154, 332, 546, 125, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#9B2226'
        ]
      }],
      labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre']
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
    const insta = document.querySelector('#instagram');
    const facebook = document.querySelector('#facebook');
    const twitch = document.querySelector('#twitch');
    const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Total Abonnés',
        data: [2, 10, 55, 12, 70, 20, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#D11800'
        ],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 18 - 24 ans',
        data: [1, 3, 12, 5, 47, 10, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F08080'
        ],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 25 - 34 ans',
        data: [1, 4, 35, 4, 14, 6, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F4978E'
        ],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 35 - 44 ans',
        data: [0, 2, 5, 1, 6, 1, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F8AD9D'
        ],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 45 - 54 ans',
        data: [0, 0, 3, 2, 3, 3, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#FBC4AB'
        ],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: [10, 50, 200, 150, 300, 70, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'bar',
        label: 'Vues 18 - 24 ans',
        data: [6, 29, 57, 47, 139, 33, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'bar',
        label: 'Vues 25 - 34 ans',
        data: [3, 12, 83, 100, 101, 27, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'bar',
        label: 'Vues 35 - 44 ans',
        data: [1, 7, 21, 2, 63, 8, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'bar',
        label: 'Vues 45 - 54 ans',
        data: [0, 2, 39, 11, 37, 2, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: [123, 97, 154, 332, 546, 125, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#9B2226'
        ]
      }],
      labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre']
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
    const insta = document.querySelector('#instagram');
    const facebook = document.querySelector('#facebook');
    const twitch = document.querySelector('#twitch');
    const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Total Abonnés',
        data: [2, 10, 55, 12, 70, 20, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#D11800'
        ],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 18 - 24 ans',
        data: [1, 3, 12, 5, 47, 10, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F08080'
        ],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 25 - 34 ans',
        data: [1, 4, 35, 4, 14, 6, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F4978E'
        ],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 35 - 44 ans',
        data: [0, 2, 5, 1, 6, 1, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F8AD9D'
        ],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 45 - 54 ans',
        data: [0, 0, 3, 2, 3, 3, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#FBC4AB'
        ],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: [10, 50, 200, 150, 300, 70, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'bar',
        label: 'Vues 18 - 24 ans',
        data: [6, 29, 57, 47, 139, 33, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'bar',
        label: 'Vues 25 - 34 ans',
        data: [3, 12, 83, 100, 101, 27, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'bar',
        label: 'Vues 35 - 44 ans',
        data: [1, 7, 21, 2, 63, 8, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'bar',
        label: 'Vues 45 - 54 ans',
        data: [0, 2, 39, 11, 37, 2, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: [123, 97, 154, 332, 546, 125, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#9B2226'
        ]
      }],
      labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre']
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
    const insta = document.querySelector('#instagram');
    const facebook = document.querySelector('#facebook');
    const twitch = document.querySelector('#twitch');
    const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Total Abonnés',
        data: [2, 10, 55, 12, 70, 20, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#D11800'
        ],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 18 - 24 ans',
        data: [1, 3, 12, 5, 47, 10, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F08080'
        ],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 25 - 34 ans',
        data: [1, 4, 35, 4, 14, 6, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F4978E'
        ],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 35 - 44 ans',
        data: [0, 2, 5, 1, 6, 1, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#F8AD9D'
        ],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'line',
        label: 'Abonnés 45 - 54 ans',
        data: [0, 0, 3, 2, 3, 3, 0, 0, 0, 0, 0, 0],
        borderColor: [
          '#FBC4AB'
        ],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: [10, 50, 200, 150, 300, 70, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#F2AC44'
        ]
      }, {
        type: 'bar',
        label: 'Vues 18 - 24 ans',
        data: [6, 29, 57, 47, 139, 33, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#FFE169'
        ]
      }, {
        type: 'bar',
        label: 'Vues 25 - 34 ans',
        data: [3, 12, 83, 100, 101, 27, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#EDC531'
        ]
      }, {
        type: 'bar',
        label: 'Vues 35 - 44 ans',
        data: [1, 7, 21, 2, 63, 8, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#C9A227'
        ]
      }, {
        type: 'bar',
        label: 'Vues 45 - 54 ans',
        data: [0, 2, 39, 11, 37, 2, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#A47E1B'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: [123, 97, 154, 332, 546, 125, 0, 0, 0, 0, 0, 0],
        backgroundColor: [
          '#9B2226'
        ]
      }],
      labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre']
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

  render = () => (
    `
      <div id="statistics">
        <div id="view-follower-charts">
          <div id="statistics-buttons">
            <button type="button" id="stat-insta-button">Instagram</button>
            <button type="button" id="stat-facebook-button">Facebook</button>
            <button type="button" id="stat-twitch-button">Twitch</button>
            <button type="button" id="stat-tiktok-button">Tiktok</button>
          </div>
          <div class="mixed-chart">
            <canvas id="instagram"></canvas>
          </div>
          <div class="mixed-chart">
            <canvas id="facebook"></canvas>
          </div>
          <div class="mixed-chart">
            <canvas id="twitch"></canvas>
          </div>
          <div class="mixed-chart">
            <canvas id="tiktok"></canvas>
          </div>
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();
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

export default Statistics;
