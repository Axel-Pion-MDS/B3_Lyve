import './Errors.scss';
import logo from '../../../public/img/Logo-Lyve.svg';

const Error403 = class {
  constructor() {
    this.el = document.querySelector('#app');
  }

  render = () => (
    `
      <div class="error-logo">
        <div id="error">
          <h1 class="error-title">Erreur 403</h1>
          <p class="error-message">Vous n'êtes pas autorisé à accéder à cette page...</p>
        </div>
        <div class="logo">
          <img src="${logo}" alt="Lyve logo">
        </div>
      </div>
    `
  );

  run = () => { this.el.innerHTML = this.render(); };
};

export default Error403;
