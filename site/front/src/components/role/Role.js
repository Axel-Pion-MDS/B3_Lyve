const Role = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Role</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Role;
