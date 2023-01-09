import './Chapter.scss';
import ProgressBar from 'progressbar.js';
import img1 from '../../../public/img/76582454b819dde64b1f9a4d0e5eb86f.png';

const Chapter = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderPartList = (number) => {
    let icon = '';
    switch (true) {
      case number <= 4:
        icon = `
          <i class="fa-solid fa-circle-check"></i>
          <p class="done">Terminé</p>
        `;
        break;
      case number === 5:
        icon = `
          <i class="fa-solid fa-spinner"></i>
          <p class="in-progress">En cours</p>
        `;
        break;
      default:
        icon = `
          <i class="fa-solid fa-power-off"></i>
          <p class="todo">À faire</p>
        `;
    }

    return (
      `
        <div class="part">
          <p class="title">Partie ${number}</p>
          <div class="status" onclick="location.href='part'">
            ${icon}
          </div>
        </div>
      `
    );
  };

  renderChapterDetails = () => (
    `
      <div class="picture-description">
        <img src="${img1}" alt="Hand holding the chess queen">
        <div class="description">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae lacus et ex sodales pellentesque non sed augue. Aliquam pulvinar sapien vitae ipsum faucibus bibendum. Aliquam pulvinar sapien vitae ipsum faucibus bibendum.</p>
        </div>
      </div>
    `
  );

  renderProgressionBar = () => {
    const progressBar = document.querySelector('#progression-bar');
    const percent = ((12 * 100) / 104) / 100;
    const bar = new ProgressBar.Line(progressBar, {
      strokeWidth: 4,
      easing: 'easeInOut',
      duration: 1400,
      color: '#D11800',
      trailColor: '#FFF',
      trailWidth: 1,
      svgStyle: {
        width: '300px',
        height: '30px',
        border: '1px solid #D11800',
        borderRadius: '10px',
        marginLeft: '20px'
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

  renderSelectedLink = () => {
    const courses = document.querySelector('#courses-link');
    courses.className = 'selected';
  };

  render = () => (
    `
      <div class="previous-title">
        <button type="button" class="previous-button" onclick="location.href='module'">
          <i class="fa-solid fa-angle-left"></i>
        </button>
        <h2>Développez votre présence en ligne</h2>
      </div>
      <div class="left-right">
        <div class="left-side">
          <div id="chapter-details">
          </div>
          <div id="parts-list">
          </div>
        </div>
        <div class="right-side">
          <div class="chapter-informations">
            <div class="parts">
              <i class="fa-solid fa-folder-tree"></i>
              <p>12 parties</p>
            </div>
            <div class="timer">
              <i class="fa-solid fa-clock"></i>
              <p>Environs 13 heures</p>
            </div>
            <div class="progress">
              <i class="fa-solid fa-percent"></i>
              <div id="progression-bar">
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();
    this.renderSelectedLink();
    this.renderProgressionBar();

    const chapterDetails = document.querySelector('#chapter-details');
    chapterDetails.innerHTML = this.renderChapterDetails();

    const partList = document.querySelector('#parts-list');
    // eslint-disable-next-line no-plusplus
    for (let i = 1; i < 13; i++) {
      partList.innerHTML += this.renderPartList(i);
    }
  };
};

export default Chapter;
