const Question = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Question</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Question;
