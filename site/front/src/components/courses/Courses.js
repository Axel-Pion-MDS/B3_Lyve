const Courses = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderSelectedLink = () => {
    const home = document.querySelector('#home-link');
    const timesheet = document.querySelector('#timesheet-link');
    const statistics = document.querySelector('#statistics-link');
    const courses = document.querySelector('#courses-link');
    home.className = '';
    timesheet.className = '';
    statistics.className = '';
    courses.className = 'selected';
  };

  render = () => ('<h2>Courses</h2>');

  run = () => {
    this.el.innerHTML = this.render();
    this.renderSelectedLink();
  };
};

export default Courses;
