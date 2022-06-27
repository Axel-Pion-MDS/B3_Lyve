import './Errors.scss';
import logo from '../../../public/img/Logo-Lyve.svg';

const Error500 = class {
  constructor() {
    this.el = document.querySelector('#app');
  }

  render = () => (
    `
      <div class="error-logo">
        <div id="error">
          <h1 class="error-title">Erreur 500</h1>
          <p class="error-message">Oops ! Une erreur s'est produite...</p>
        </div>
        <div class="logo">
          <img src="${logo}" alt="Lyve logo">
        </div>
      </div>
    `
  );

  run = () => { this.el.innerHTML = this.render(); };
};

export default Error500;
