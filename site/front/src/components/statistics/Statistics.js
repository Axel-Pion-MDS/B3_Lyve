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
import moment from 'moment';

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
    this.result = [];
    this.daysInMonth().forEach((day) => { this.result.push(day.format('DD/MM')); });
    this.tmpRandomViews = this.tmpViewsRandomizer();
    this.tmpRandomFollowers = this.tmpFollowersRandomizer();
    this.tmpRandomTopViews = this.tmpTopViewsRandomizer();
    this.tmpRandomSell = this.tmpSellRandomizer();
    this.tmpRandomConversion = this.tmpConversionRandomizer();
  }

  daysInMonth = () => {
    const days = moment().daysInMonth();
    const listOfDays = [];

    // eslint-disable-next-line no-plusplus
    for (let i = 1; i < days + 1; i++) {
      const currentDay = moment().date(i);
      listOfDays.push(currentDay);
    }

    return listOfDays;
  };

  tmpViewsRandomizer = () => {
    const days = moment().daysInMonth();
    const randomNumbers = [];

    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < days; i++) {
      randomNumbers[i] = Math.round(Math.floor(Math.random() * (1000 - 1 + 1)) + 1);
    }

    return randomNumbers;
  };

  tmpFollowersRandomizer = () => {
    const days = moment().daysInMonth();
    const randomNumbers = [];

    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < days; i++) {
      randomNumbers[i] = Math.round(Math.floor(Math.random() * (500 - 1 + 1)) + 1);
    }

    return randomNumbers;
  };

  tmpTopViewsRandomizer = () => {
    const days = moment().daysInMonth();
    const randomNumbers = [];

    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < days; i++) {
      randomNumbers[i] = Math.round(Math.floor(Math.random() * (1000 - 1 + 1)) + 1);
    }

    return randomNumbers;
  };

  tmpSellRandomizer = () => {
    const days = moment().daysInMonth();
    const randomNumbers = [];

    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < days; i++) {
      randomNumbers[i] = Math.round(Math.floor(Math.random() * (500 - 1 + 1)) + 1);
    }

    return randomNumbers;
  };

  tmpConversionRandomizer = () => {
    const days = moment().daysInMonth();
    const randomNumbers = [];

    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < days; i++) {
      randomNumbers[i] = Math.round(Math.floor(Math.random() * (20 - 1 + 1)) + 1);
    }

    return randomNumbers;
  };

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

  /**
   * render Instagram Charts
   *
   * @returns {Object}
   */
  renderInstaCharts = () => {
    const insta = document.querySelector('#instagram');
    const facebook = document.querySelector('#facebook');
    const twitch = document.querySelector('#twitch');
    // const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Pic du vues',
        data: this.tmpRandomTopViews,
        backgroundColor: '#f9c4ae',
        borderColor: '#fa5e1f'
      }, {
        type: 'line',
        label: '% taux de conversion',
        data: this.tmpRandomConversion,
        backgroundColor: '#b78680',
        borderColor: '#b81702'
      }, {
        type: 'bar',
        label: 'Total Abonnés',
        data: this.tmpRandomFollowers,
        backgroundColor: '#ffb950'
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: this.tmpRandomViews,
        backgroundColor: [
          '#ff931f'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: this.tmpRandomSell,
        backgroundColor: [
          '#7a0103'
        ]
      }],
      labels: this.result
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
    // const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Pic du vues',
        data: this.tmpRandomTopViews,
        backgroundColor: '#f9c4ae',
        borderColor: '#fa5e1f'
      }, {
        type: 'line',
        label: '% taux de conversion',
        data: this.tmpRandomConversion,
        backgroundColor: '#b78680',
        borderColor: '#b81702'
      }, {
        type: 'bar',
        label: 'Total Abonnés',
        data: this.tmpRandomFollowers,
        backgroundColor: '#ffb950'
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: this.tmpRandomViews,
        backgroundColor: [
          '#ff931f'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: this.tmpRandomSell,
        backgroundColor: [
          '#7a0103'
        ]
      }],
      labels: this.result
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
    // const tiktok = document.querySelector('#tiktok');
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
      borderColor: '#FEFEFE',
      datasets: [{
        type: 'line',
        label: 'Pic du vues',
        data: this.tmpRandomTopViews,
        backgroundColor: '#f9c4ae',
        borderColor: '#fa5e1f'
      }, {
        type: 'line',
        label: '% taux de conversion',
        data: this.tmpRandomConversion,
        backgroundColor: '#b78680',
        borderColor: '#b81702'
      }, {
        type: 'bar',
        label: 'Total Abonnés',
        data: this.tmpRandomFollowers,
        backgroundColor: '#ffb950'
      }, {
        type: 'bar',
        label: 'Total Vues',
        data: this.tmpRandomViews,
        backgroundColor: [
          '#ff931f'
        ]
      }, {
        type: 'bar',
        label: 'Achats',
        data: this.tmpRandomSell,
        backgroundColor: [
          '#7a0103'
        ]
      }],
      labels: this.result
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

  // renderTiktokCharts = () => {
  //   const insta = document.querySelector('#instagram');
  //   const facebook = document.querySelector('#facebook');
  //   const twitch = document.querySelector('#twitch');
  //   const tiktok = document.querySelector('#tiktok');
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
  //     borderColor: '#FEFEFE',
  //     datasets: [{
  //       type: 'line',
  //       label: 'Pic du vues',
  //       data: this.tmpRandomTopViews,
  //       backgroundColor: '#f9c4ae',
  //       borderColor: '#fa5e1f'
  //     }, {
  //       type: 'line',
  //       label: '% taux de conversion',
  //       data: this.tmpRandomConversion,
  //       backgroundColor: '#b78680',
  //       borderColor: '#b81702'
  //     }, {
  //       type: 'bar',
  //       label: 'Total Abonnés',
  //       data: this.tmpRandomFollowers,
  //       backgroundColor: '#ffb950'
  //     }, {
  //       type: 'bar',
  //       label: 'Total Vues',
  //       data: this.tmpRandomViews,
  //       backgroundColor: [
  //         '#ff931f'
  //       ]
  //     }, {
  //       type: 'bar',
  //       label: 'Achats',
  //       data: this.tmpRandomSell,
  //       backgroundColor: [
  //         '#7a0103'
  //       ]
  //     }],
  //     labels: this.result
  //   };

  //   const tiktokConfig = {
  //     type: 'scatter',
  //     data: tiktokData,
  //     options: {
  //       scales: {
  //         y: {
  //           beginAtZero: true
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

  renderSelectedLink = () => {
    const statistics = document.querySelector('#statistics-link');
    statistics.className = 'selected';
  };

  render = () => (
    `
      <div id="statistics">
        <div id="view-follower-charts">
          <div id="statistics-buttons">
            <button type="button" id="stat-insta-button">Instagram</button>
            <button type="button" id="stat-facebook-button">Facebook</button>
            <button type="button" id="stat-twitch-button">Twitch</button>
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
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();
    this.renderSelectedLink();
    this.renderInstaCharts();

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

export default Statistics;
