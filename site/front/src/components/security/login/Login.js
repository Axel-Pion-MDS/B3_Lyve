import axios from 'axios';
import './Login.scss';
import logo from '../../../../public/img/Logo-Lyve.svg';

const Login = class {
  constructor() {
    this.el = document.querySelector('#app');
  }

  postLogin = (email, password) => {
    axios.post('https://lyve.local/security/login', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        email,
        password
      }
    })
      .then((res) => {
        window.localStorage.setItem('user', res.data.data.user);
        window.localStorage.setItem('roles', res.data.data.roles);
        window.location.href = '/';
      })
      .catch((err) => { throw new Error(err); });
  };

  renderLoginForm = () => (
    `
      <div class="login-form">
        <label for="login-email">Email</label>
        <input type="email" id="login-email" name="email" placeholder="Votre email">
        <label for="login-password">Mot de passe</label>
        <input type="password" id="login-password" name="password" placeholder="Renseigner un mot de passe">
        <div class="remember-forgot">
          <div class="remember-me">
            <input type="checkbox" id="remember-me" name="remember-me" value="remember">
            <label for="remember-me">Se souvenir de moi</label>
          </div>
          <a href="recover" class="forgot-password">Mot de passe oublié</a>
        </div>
        <button type="button" id="connexion-button">Connexion</button>
        <p>Vous n'avez pas de compte ? <a href="" class="landing-link">Visitez notre site vitrine !</a></p>
      </div>
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

    const login = document.querySelector('#login-form');
    login.innerHTML = this.renderLoginForm();

    this.waitForElm('#connexion-button').then(() => {
      const connexion = document.querySelector('#connexion-button');

      connexion.addEventListener('click', () => {
        const email = document.querySelector('#login-email').value;
        const password = document.querySelector('#login-password').value;
        this.postLogin(email, password);
      });
    });
  };
};

export default Login;
