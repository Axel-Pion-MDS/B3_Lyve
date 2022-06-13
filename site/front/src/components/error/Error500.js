const Error500 = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Error500</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Error500;
