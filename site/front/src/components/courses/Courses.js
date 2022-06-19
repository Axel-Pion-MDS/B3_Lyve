import './Courses.scss';
import ProgressBar from 'progressbar.js';
import img1 from '../../../public/img/cc7cc34a22ed5621635d443d0a87a1cb.png';
import img2 from '../../../public/img/1dace212e092ea819120fbea6b8c2417.png';
import img3 from '../../../public/img/87080f0f73b8f4d89776127c1cf07bba.png';
import img4 from '../../../public/img/e83c5c6372b33278248e0355c67e6eaa.png';
import img5 from '../../../public/img/025293f1c49b49d4eaf77c07c31d68fd.png';
import img6 from '../../../public/img/74b66800d2cc532579f1ba069de50c96.png';

const Courses = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderBadges = () => (
    `
      <div class="unclickable-badge-button">
        <img class="badge-img" src="${img1}" alt="badge image">
      </div>
      <div class="unclickable-badge-button">
        <img class="badge-img" src="${img2}" alt="badge image">
      </div>
      <div class="unclickable-badge-button">
        <img class="badge-img" src="${img3}" alt="badge image">
      </div>
      <div class="unclickable-badge-button">
        <img class="badge-img" src="${img4}" alt="badge image">
      </div>
      <div class="unclickable-badge-button">
        <img class="badge-img" src="${img5}" alt="badge image">
      </div>
      <div class="unclickable-badge-button">
        <img class="badge-img" src="${img6}" alt="badge image">
      </div>
    `
  );

  renderInformations = () => (
    `
      <div class="modules-number">
        <h6>Nombre de modules</h6>
        <div class="unclickable-button">
          <p>26</p>
        </div>
      </div>
      <div class="modules-time">
        <h6>Temps estimé</h6>
        <div class="unclickable-button">
          <p>135h</p>
        </div>
      </div>
      <div class="modules-level">
        <h6>Niveau de formation</h6>
        <div class="unclickable-button">
          <p>Débutant</p>
        </div>
      </div>
    `
  );

  renderModules = (number, locked) => {
    const isLocked = locked === true ? 'locked' : 'unlocked';
    const link = locked === true ? '' : 'module';

    return `
      <button type="button" class="module-${number} ${isLocked}" onclick="location.href='${link}';">
        Module ${number} <i class="fa-solid fa-lock ${isLocked}"></i>
      </button>
    `;
  };

  renderProgressionBar = () => {
    const progressBar = document.querySelector('#progression-bar');
    const percent = 0.25;
    const bar = new ProgressBar.Line(progressBar, {
      strokeWidth: 4,
      easing: 'easeInOut',
      duration: 1400,
      color: '#D11800',
      trailColor: '#FFF',
      trailWidth: 1,
      svgStyle: {
        width: '600px',
        height: '30px',
        border: '1px solid #D11800',
        borderRadius: '10px'
      },
      text: {
        style: {
          // Text color.
          // Default: same as stroke color (options.color)
          color: '#999',
          position: 'relative',
          left: '630px',
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
      <h2>[Titre Formation]</h2>
      <div class="course-informations-block">
        <div class="progression-modules">
          <div class="course-progression-bar">
            <h4>Avancée globale de la formation</h4>
            <div id="progression-bar">
            </div>
          </div>
          <div class="course-modules-list">
            <h4>Modules</h4>
            <div id="modules-list">
            </div>
          </div>
        </div>
        <div class="separator"></div>
        <div class="informations-badges">
          <div class="course-informations">
            <h4>Informations pratiques</h4>
            <div id="informations">
            </div>
          </div>
          <div class="course-badges">
            <h4>Badges déblocables</h4>
            <div id="badges">
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

    const moduleList = document.querySelector('#modules-list');

    // ! TEMPORARY FOR LOOP, MUST BE REPLACED WITH A GET COURSE FROM BACK
    // eslint-disable-next-line no-plusplus
    for (let i = 1; i < 26 + 1; i++) {
      const locked = i > 4;
      moduleList.innerHTML += this.renderModules(i, locked);
    }

    const informations = document.querySelector('#informations');
    informations.innerHTML = this.renderInformations();

    const badges = document.querySelector('#badges');
    badges.innerHTML = this.renderBadges();
  };
};

export default Courses;
