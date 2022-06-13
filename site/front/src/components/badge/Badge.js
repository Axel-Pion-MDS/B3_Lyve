const Badge = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Badge</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Badge;
