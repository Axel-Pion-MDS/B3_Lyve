const Courses = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Courses</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Courses;
