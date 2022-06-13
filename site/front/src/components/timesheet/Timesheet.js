const Timesheet = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Timesheet</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Timesheet;
