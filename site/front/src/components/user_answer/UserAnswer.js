const UserAnswer = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>UserAnswer</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default UserAnswer;
