import './Recover.scss';
import logo from '../../../../public/img/Logo-Lyve.svg';

const Recover = class {
  constructor() {
    this.el = document.querySelector('#app');
  }

  renderRecoverForm = () => (
    `
      <form>
        <label for="recover-email">Email</label>
        <input type="email" id="recover-email" name="email" placeholder="Votre email">
        <button type="submit">Réinitialiser le mot de passe</button>
      </form>
    `
  );

  render = () => (
    `
      <div class="login-logo">
        <div class="login">
          <h1>MOT DE PASSE OUBLIÉ</h1>
          <p>Entrez votre e-mail pour recevoir un lien pour réinitialiser votre mot de passe</p>
          <div id="recover-form">
          </div>
        </div>
        <div class="logo">
          <img src="${logo}" alt="Lyve logo">
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();

    const login = document.querySelector('#recover-form');
    login.innerHTML = this.renderRecoverForm();
  };
};

export default Recover;
