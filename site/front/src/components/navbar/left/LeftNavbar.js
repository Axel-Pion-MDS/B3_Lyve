import './LeftNavbar.scss';
import logo from '../../../public/images/Logo-Lyve.svg';

const LeftNavbar = class {
  constructor() {
    this.el = document.querySelector('#navbar');
  }

  render = () => (
    `
      <div id="navbar">
      <div class="clear-navbar">
        <div id="logo">
          <h1>
            <a href="/">
              <img class="lyve-logo" src="${logo}" alt="Lyve" />
            </a>
          </h1>
        </div>
        <div id="navbar-links">
          <ul>
            <li>
              <i class="fa fa-house"></i>
              <a href="/">
                Accueil
              </a>
            </li>
            <li>
              <i class="fa fa-calendar"></i>
              <a href="timesheet">
                Agenda
              </a>
            </li>
            <li>
              <i class="fa fa-chart-simple"></i>
              <a href="statistics">
                Statistiques
              </a>
            </li>
            <li>
              <i class="fa fa-graduation-cap"></i>
              <a href="courses">
                Formations
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="blur-border">
      </div>
    </div>
  `
  );

  run = () => { this.el.innerHTML = this.render(); };
};

export default LeftNavbar;
