import './Part.scss';

const Part = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  renderPart = () => (
    `
      <div class="details">
        <div class="video-p">
          <iframe width="769" height="407" src="https://www.youtube.com/embed/N9LV0BGDYIo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p class="error-message">Vidéo d'exemple. Crédit de la vidéo : BetterStudy Formation en comptabilité suisse, <a href="https://www.youtube.com/c/betterstudy" target="_blank">lien de la chaine</a></p>
        </div>
        <div class="button-p">
          <button type=button" onclick="location.href='question'">Testez vos connaissances</button>
          <h6>Points clefs</h6>
          <p>Adresser des e-mails et des offres spéciales aux clients peur jouer un rôle clé dans votre stratégie marketing globale, et vous permettre d’établir et de renforcer vos relations avec eux. Dans cette vidéo, nous vous expliquerons comment:
            <ul>
              <li>
                développer une liste de contacts;
              </li>
              <li>
                cibler un public spécifique en fonction de ses centres d’intérêt;
              </li>
              <li>
                construire une relation durable avec les clients.
              </li>
            </ul>
          </p>
        </button>
      </div>
    `
  );

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
        <h2>Part 5: Analyse de la cible</h2>
      </div>
      <div id="part-details">
      </div>
    `
  );

  run = () => {
    this.renderSelectedLink();
    this.el.innerHTML = this.render();

    const part = document.querySelector('#part-details');
    part.innerHTML = this.renderPart();
  };
};

export default Part;
