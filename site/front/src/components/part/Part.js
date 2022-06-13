const Part = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Part</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Part;
