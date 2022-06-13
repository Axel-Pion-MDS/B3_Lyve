import './TopNavbar.scss';

const TopNavbar = class {
  constructor() {
    this.el = document.querySelector('#app-menu');
  }

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
          <button class="notifications">
            <div class="notifications-circle notif-show" />
            <i class="fa fa-bell"></i>
          </button>
          <button class="profile">

          </button>
        </div>
      </div>
    `
  );

  run = () => { this.el.innerHTML = this.render(); };
};

export default TopNavbar;
