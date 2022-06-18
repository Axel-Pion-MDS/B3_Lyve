import './LeftNavbar.scss';
import logo from '../../../../public/img/Logo-Lyve.svg';

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
              <a href="/" id="home-link">
                <i class="fa fa-house"></i>
                Accueil
              </a>
            </li>
            <li>
              <a href="timesheet" id="timesheet-link">
                <i class="fa fa-calendar"></i>
                Agenda
              </a>
            </li>
            <li>
              <a href="statistics" id="statistics-link">
                <i class="fa fa-chart-simple"></i>
                Statistiques
              </a>
            </li>
            <li>
              <a href="courses" id="courses-link">
                <i class="fa fa-graduation-cap"></i>
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

  run = () => {
    this.el.innerHTML = this.render();
  };
};

export default LeftNavbar;
