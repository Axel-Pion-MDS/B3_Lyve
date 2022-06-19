import './Module.scss';

const Module = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  // ! TMP RENDER, MUST FETCH DATA FROM BACK
  renderChapters = () => (
    `
      <div class="chapter" onclick="location.href='chapter'">
        <div class="chapter-title">
          <i class="fa-solid fa-shield"></i>
          <p>Les opportunités qu'offre internet</p>
        </div>
        <div class="chapter-timer-status-button">
          <div class="chapter-timer">
            <i class="fa-solid fa-clock"></i>
            <p>13 heures</p>
          </div>
          <div class="chapter-status">
            <i class="fa-solid fa-circle-check"></i>
            <p class="done">Terminé</p>
          </div>
          <div class="chapter-button">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
      </div>
      <div class="chapter" onclick="location.href='chapter'">
        <div class="chapter-title">
          <i class="fa-solid fa-tv"></i>
          <p>Vos premiers pas vers le succès sur internet</p>
        </div>
        <div class="chapter-timer-status-button">
          <div class="chapter-timer">
            <i class="fa-solid fa-clock"></i>
            <p>13 heures</p>
          </div>
          <div class="chapter-status">
            <i class="fa-solid fa-circle-check"></i>
            <p class="done">Terminé</p>
          </div>
          <div class="chapter-button">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
      </div>
      <div class="chapter" id="spin" onclick="location.href='chapter'">
        <div class="chapter-title">
          <i class="fa-solid fa-magnifying-glass"></i>
          <p>Développez votre présence en ligne</p>
        </div>
        <div class="chapter-timer-status-button">
          <div class="chapter-timer">
            <i class="fa-solid fa-clock"></i>
            <p>13 heures</p>
          </div>
          <div class="chapter-status">
            <i class="fa-solid fa-spinner" id="spinner"></i>
            <p class="in-progress">En cours</p>
          </div>
          <div class="chapter-button">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
      </div>
      <div class="chapter" onclick="location.href='chapter'">
        <div class="chapter-title">
          <i class="fa-solid fa-chess"></i>
          <p>Planifiez votre stratégie commerciale sur le web</p>
        </div>
        <div class="chapter-timer-status-button">
          <div class="chapter-timer">
            <i class="fa-solid fa-clock"></i>
            <p>13 heures</p>
          </div>
          <div class="chapter-status">
            <i class="fa-solid fa-power-off"></i>
            <p class="todo">À faire</p>
          </div>
          <div class="chapter-button">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
      </div>
      <div class="chapter" onclick="location.href='chapter'">
        <div class="chapter-title">
          <i class="fa-solid fa-shield-check"></i>
          <p></p>
        </div>
        <div class="chapter-timer-status-button">
          <div class="chapter-timer">
            <i class="fa-solid fa-clock"></i>
            <p>13 heures</p>
          </div>
          <div class="chapter-status">
            <i class="fa-solid fa-power-off"></i>
            <p class="todo">À faire</p>
          </div>
          <div class="chapter-button">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
      </div>
    `
  );

  renderSelectedLink = () => {
    const courses = document.querySelector('#courses-link');
    courses.className = 'selected';
  };

  render = () => (
    `
      <div class="previous-title">
        <button type="button" class="previous-button" onclick="location.href='courses'">
          <i class="fa-solid fa-angle-left"></i>
        </button>
        <h2>Module 1 (26)</h2>
      </div>
      <div id="module-details">
      </div>
    `
  );

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

  run = () => {
    this.el.innerHTML = this.render();
    this.renderSelectedLink();

    const chapters = document.querySelector('#module-details');

    chapters.innerHTML = this.renderChapters();
  };
};

export default Module;
