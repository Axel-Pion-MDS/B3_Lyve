const Error403 = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Error403</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Error403;
