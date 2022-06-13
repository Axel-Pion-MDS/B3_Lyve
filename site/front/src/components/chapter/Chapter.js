const Chapter = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Chapter</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Chapter;
