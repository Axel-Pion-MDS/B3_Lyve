import './TopNavbar.scss';
import pp from '../../../../public/img/photo-1531746020798-e6953c6e8e04.png';
import notifimg from '../../../../public/img/photo-1570295999919-56ceb5ecca61.png';

const TopNavbar = class {
  constructor() {
    this.el = document.querySelector('#app-menu');
  }

  renderNotification = () => (
    `
      <div class="notification-box">
        <ul class="notification-messages">
          <li class="notification">
            <img src="${notifimg}" alt="profile picture">
            <p>Rendez-vous avec M. X Vendredi 27 juin à 14h50</p>
          </li>
          <li class="notification">
            <img src="${notifimg}" alt="profile picture">
            <p>Rendez-vous avec M. X Vendredi 27 juin à 15h50</p>
          </li>
          <li class="notification">
            <img src="${notifimg}" alt="profile picture">
            <p>Rendez-vous avec M. X Vendredi 27 juin à 16h50</p>
          </li>
        </ul>
      </div>
    `
  );

  render = () => (
    `
      <div id="menu">
        <div class="menu-icons">
          <div class="search-bar">
            <input type="text" class="search-input" placeholder="Rechercher" />
            <div class="search-icon">
              <i class="fa fa-magnifying-glass"></i>
            </div>
          </div>
          <div class="notif-profile">
            <div class="notif-blocks">
              <button class="notifications">
                <div class="notifications-circle notif-show" />
                <i class="fa fa-bell"></i>
              </button>
              <div id="notifications" class="hide">
              </div>
            </div>
            <div class="profile-button">
              <button class="profile"></button>
              <img src="${pp}" alt="profile picture">
            </div>
          </div>
        </div>
      </div>
    `
  );

  run = () => {
    this.el.innerHTML = this.render();

    const notif = document.querySelector('.notifications');
    const notifBlock = document.querySelector('#notifications');
    notif.addEventListener('click', () => {
      if (notifBlock.className === 'hide') {
        notif.style = 'background: #F2AC44';
        notifBlock.className = 'show';
        notifBlock.innerHTML = this.renderNotification();
      } else {
        const notifCircle = document.querySelector('.notifications-circle');
        notif.style = 'background: rgba(0, 0, 0, 0.15)';
        notifBlock.className = 'hide';
        notifCircle.className = 'notif-hide';
      }
    });
  };
};

export default TopNavbar;
