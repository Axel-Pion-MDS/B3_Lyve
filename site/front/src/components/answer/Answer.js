const Answer = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Answer</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Answer;
