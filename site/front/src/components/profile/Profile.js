import './Profile.scss';
import pp from '../../../public/img/photo-1531746020798-e6953c6e8e04.png';

const Profile = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  cancelButton = () => {
    const background = document.querySelector('#rdv-background');
    const dialog = document.querySelector('#profile-dialog-box');

    background.className = 'hide';
    dialog.className = 'hide';
  };

  verifyClickOnButtons = () => {
    this.waitForElm('#submit-button').then(() => {
      const button = document.querySelector('#submit-button');

      button.addEventListener('click', () => {
        this.cancelButton();
      });
    });

    this.waitForElm('#exit-cross').then(() => {
      const cross = document.querySelector('#exit-cross');
      cross.addEventListener('click', () => this.cancelButton());
    });
  };

  renderModifyPicture = () => (
    `
      <h2>Modifier la photo de profil</h2>
      <div class="picture-link">
        <label for="picture-link">Lien de l'image</label>
        <input type="text" id="picture-link" name="picture-link">
      </div>
      <button type="button" id="submit-button" class="submit">Valider</button>
    `
  );

  renderModifyEmail = () => (
    `
      <h2>Modifier l'email</h2>
      <div class="new-email">
        <label for="new-email">Nouvel email</label>
        <input type="email" id="new-email" name="new-email">
      </div>
      <button type="button" id="submit-button" class="submit">Valider</button>
    `
  );

  renderModifyPassword = () => (
    `
      <h2>Modifier le mot de passe</h2>
      <div class="previous-password">
        <label for="previous-password">Ancien mot de passe</label>
        <input type="password" id="previous-password" name="previous-password">
      </div>
      <div class="new-password">
        <label for="new-password">Nouveau mot de passe</label>
        <input type="password" id="new-password" name="new-password">
      </div>
      <div class="repeat-new-password">
        <label for="repeat-new-password">Confirmer nouveau mot de passe</label>
        <input type="password" id="repeat-new-password" name="repeat-new-password">
      </div>
      <button type="button" id="submit-button" class="submit">Valider</button>
    `
  );

  renderModifyNumber = () => (
    `
      <h2>Modifier le numéro</h2>
      <div class="new-number">
        <label for="new-number">Nouveau numéro</label>
        <input type="text" id="new-number" name="new-number">
      </div>
      <button type="button" id="submit-button" class="submit">Valider</button>
    `
  );

  render = () => (
    `
      <div id="profile">
        <div id="rdv-background" class="hide">
        </div>
        <div id="profile-dialog-box" class="hide">
        </div>
        <div class="picture-name">
          <img src="${pp}" alt="Photo de profil">
          <h2>Jane Doe</h2>
          <button type="button" class="change-picture">Changer la photo de profil</button>  
        </div>
        <div class="profile-blocks">
          <div class="information-title">
            <h3>Informations</h3>
            <div class="informations">
              <div class="informations-box">
                <div class="email">
                  <h6>Email</h6>
                  <p>janedoe@gmail.com</p>
                </div>
                <button type="button" class="change-email">Modifier l'email</button>
                <div class="phone">
                  <h6>Téléphone</h6>
                  <p>0612345678</p>
                </div>
                <button type="button" class="change-number">Modifier le téléphone</button>
                <div class="password">
                  <h6>Mot de passe</h6>
                </div>
                <button type="button" class="change-password">Modifier le mot de passe</button>
              </div>
            </div>
          </div>
          <div class="offer-title">
            <h3>Offre</h3>
            <div class="offer">
              <div class="offer-box">
                <div class="actual-offer">
                  <h6>Offre actuelle</h6>
                  <p>Pack Streamin'genious</p>
                </div>
                <div class="inscription-date">
                  <h6>Date d'inscription</h6>
                  <p>12/06/2022</p>
                </div>
                <div class="coach">
                  <h6>Coach personnel</h6>
                  <p>Anne O'nyme</p>
                </div>
                <div class="coach-validity">
                  <h6>Fin de coaching personnel</h6>
                  <p>12/06/2023</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  );

  waitForElm(selector) {
    return new Promise((resolve) => {
      if (document.querySelector(selector)) {
        resolve(document.querySelector(selector));
      }

      const observer = new MutationObserver(() => {
        if (document.querySelector(selector)) {
          resolve(document.querySelector(selector));
          observer.disconnect();
        }
        return 1;
      });

      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
    });
  }

  run = () => {
    this.el.innerHTML = this.render();

    const background = document.querySelector('#rdv-background');
    const dialog = document.querySelector('#profile-dialog-box');
    const picture = document.querySelector('.change-picture');
    const email = document.querySelector('.change-email');
    const number = document.querySelector('.change-number');
    const password = document.querySelector('.change-password');

    picture.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 300px';
      dialog.innerHTML = this.renderModifyPicture();
      this.verifyClickOnButtons();
    });

    email.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 300px';
      dialog.innerHTML = this.renderModifyEmail();
      this.verifyClickOnButtons();
    });

    number.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 300px';
      dialog.innerHTML = this.renderModifyNumber();
      this.verifyClickOnButtons();
    });

    password.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 550px';
      dialog.innerHTML = this.renderModifyPassword();
      this.verifyClickOnButtons();
    });
  };
};

export default Profile;
