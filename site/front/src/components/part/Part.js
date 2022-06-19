const Part = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderSelectedLink = () => {
    const courses = document.querySelector('#courses-link');
    courses.className = 'selected';
  };

  render = () => (
    `
    <div class="previous-title">
      <button type="button" class="previous-button" onclick="location.href='chapter'">
        <i class="fa-solid fa-angle-left"></i>
      </button>
      <h2>Part 1</h2>
    </div>
    <div id="part-details">
    </div>
    `
  );

  run = () => {
    this.renderSelectedLink();
    this.el.innerHTML = this.render();
  };
};

export default Part;
