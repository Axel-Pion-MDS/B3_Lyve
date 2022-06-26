import './Login.scss';
import logo from '../../../../public/img/Logo-Lyve.svg';

const Login = class {
  constructor() {
    this.el = document.querySelector('#app');
  }

  renderLoginForm = () => (
    `
      <form>
        <label for="login-email">Mail</label>
        <input type="email" id="login-email" name="email" placeholder="Votre Mail">
        <label for="login-password">Mot de passe</label>
        <input type="password" id="login-password" name="password" placeholder="Renseigner un mot de passe">
        <div class="remember-forgot">
          <div class="remember-me">
            <input type="checkbox" id="remember-me" name="remember-me" value="remember">
            <label for="remember-me">Se souvenir de moi</label>
          </div>
          <a href="" class="forgot-password">Mot de passe oublié</a>
        </div>
        <button type="submit">Connexion</button>
        <p>Vous n'avez pas de compte ? <a href="" class="landing-link">Visitez notre site vitrine !</a></p>
      </form>
    `
  );

  render = () => (
    `
      <div class="login-logo">
        <div class="login">
          <h1>CONNEXION</h1>
          <p>Entrez vos identifiants</p>
          <div id="login-form">
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

    const login = document.querySelector('#login-form');
    login.innerHTML = this.renderLoginForm();
  };
};

export default Login;
