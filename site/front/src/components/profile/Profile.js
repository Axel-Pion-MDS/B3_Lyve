const Profile = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Profile</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Profile;
