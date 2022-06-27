import './Errors.scss';
import logo from '../../../public/img/Logo-Lyve.svg';

const Error404 = class {
  constructor() {
    this.el = document.querySelector('#app');
  }

  render = () => (
    `
      <div class="error-logo">
        <div id="error">
          <h1 class="error-title">Erreur 404</h1>
          <p class="error-message">La page est introuvable...</p>
        </div>
        <div class="logo">
          <img src="${logo}" alt="Lyve logo">
        </div>
      </div>
    `
  );

  run = () => { this.el.innerHTML = this.render(); };
};

export default Error404;
