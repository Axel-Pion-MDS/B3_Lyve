const Module = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Module</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Module;
