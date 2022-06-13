const Statistics = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Statistics</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Statistics;
