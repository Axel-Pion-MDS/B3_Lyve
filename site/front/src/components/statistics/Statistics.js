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

  renderInstaCharts = () => {
    const insta = document.querySelector('#instagram');

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
    const facebook = document.querySelector('#facebook');

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
    const twitch = document.querySelector('#twitch');

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
    const tiktok = document.querySelector('#tiktok');

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
        <div class="mixed-chart">
          <h5>Instagram</h5>
          <canvas id="instagram"></canvas>
        </div>
        <div class="mixed-chart">
          <h5>Facebook</h5>
          <canvas id="facebook"></canvas>
        </div>
        <div class="mixed-chart">
          <h5>Twitch</h5>
          <canvas id="twitch"></canvas>
        </div>
        <div class="mixed-chart">
          <h5>Tiktok</h5>
          <canvas id="tiktok"></canvas>
        </div>
      </div>
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();
    this.renderInstaCharts();
    this.renderFacebookCharts();
    this.renderTwitchCharts();
    this.renderTiktokCharts();
  };
};

export default Statistics;
