const Error404 = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Error404</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Error404;
