const Offer = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  render = () => ('<h2>Offer</h2>');

  run = () => { this.el.innerHTML = this.render(); };
};

export default Offer;
