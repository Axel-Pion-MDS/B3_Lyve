const User = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>User</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default User;
