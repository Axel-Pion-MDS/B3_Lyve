import axios from 'axios';
import './Profile.scss';
import pp from '../../../public/img/photo-1531746020798-e6953c6e8e04.png';

const Profile = class {
  constructor() {
    this.el = document.querySelector('#body');
  }

  getUserInformations = async () => {
    const profile = document.querySelector('#profile');
    await axios.post('https://lyve.local/user/show', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        email: window.localStorage.length > 0 ? window.localStorage.getItem('user') : window.sessionStorage.getItem('user')
      }
    }).then((res) => {
      if (res.data.result === 'success') {
        profile.innerHTML = this.renderUser(res.data.data[0]);
      }

      return null;
    });
  };

  editEmail = (email) => {
    axios.patch('https://lyve.local/user/editmail', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        user: window.localStorage.length > 0 ? window.localStorage.getItem('user') : window.sessionStorage.getItem('user'),
        email
      }
    });
  };

  editNumber = (number) => {
    axios.patch('https://lyve.local/user/editnumber', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        user: window.localStorage.length > 0 ? window.localStorage.getItem('user') : window.sessionStorage.getItem('user'),
        number
      }
    });
  };

  editPassword = (actualPassword, newPassword, repeatNewPassword) => {
    axios.patch('https://lyve.local/user/editmail', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*',
        'content-type': 'application/json'
      },
      body: {
        user: window.localStorage.length > 0 ? window.localStorage.getItem('user') : window.sessionStorage.getItem('user'),
        actualPassword,
        newPassword,
        repeatNewPassword
      }
    });
  };

  ButtonListening = () => {
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
    });

    email.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 300px';
      dialog.innerHTML = this.renderModifyEmail();
    });

    number.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 300px';
      dialog.innerHTML = this.renderModifyNumber();
    });

    password.addEventListener('click', () => {
      background.className = 'show';
      dialog.className = 'show';
      dialog.style = 'height: 550px';
      dialog.innerHTML = this.renderModifyPassword();
    });

    this.waitForElm('#submit-button-picture').then(() => {
      const pictureForm = document.querySelector('#submit-button-picture');
      const cross = document.querySelector('#exit-cross');

      pictureForm.addEventListener('click', () => {
        // this.editPicture(picture);
        this.cancelButton();
      });

      cross.addEventListener('click', () => {
        this.cancelButton();
      });
    });

    this.waitForElm('#submit-button-email').then(() => {
      const emailForm = document.querySelector('#submit-button-email');
      const cross = document.querySelector('#exit-cross');

      emailForm.addEventListener('click', () => {
        const newEmail = document.querySelector('#new-email').value;

        this.editEmail(newEmail);
        this.cancelButton();
      });

      cross.addEventListener('click', () => {
        this.cancelButton();
      });
    });

    this.waitForElm('#submit-button-number').then(() => {
      const numberForm = document.querySelector('#submit-button-number');
      const cross = document.querySelector('#exit-cross');

      numberForm.addEventListener('click', () => {
        const newNumber = document.querySelector('#new-number').value;

        this.editNumber(newNumber);
        this.cancelButton();
      });

      cross.addEventListener('click', () => {
        this.cancelButton();
      });
    });

    this.waitForElm('#submit-button-password').then(() => {
      const passwordForm = document.querySelector('#submit-button-password');
      const cross = document.querySelector('#exit-cross');

      passwordForm.addEventListener('click', () => {
        const actualPassword = document.querySelector('#previous-password').value;
        const newPassword = document.querySelector('#new-password').value;
        const repeatNewPassword = document.querySelector('#repeat-new-password').value;

        this.editPassword(actualPassword, newPassword, repeatNewPassword);
        this.cancelButton();
      });

      cross.addEventListener('click', () => {
        this.cancelButton();
      });
    });
  };

  cancelButton = () => {
    const background = document.querySelector('#rdv-background');
    const dialog = document.querySelector('#profile-dialog-box');

    background.className = 'hide';
    dialog.className = 'hide';
  };

  verifyClickOnButtons = () => {
    this.waitForElm('#submit-button-email').then(() => {
      const emailForm = document.querySelector('#submit-button-email');
      const newEmail = document.querySelector('#new-email').value;

      emailForm.addEventListener('click', () => {
        this.editEmail(newEmail);
        this.cancelButton();
      });
    });

    this.waitForElm('#submit-button-number').then(() => {
      const numberForm = document.querySelector('#submit-button-number');
      const newNumber = document.querySelector('#new-number').value;

      numberForm.addEventListener('click', () => {
        this.editNumber(newNumber);
        this.cancelButton();
      });
    });

    this.waitForElm('#submit-button-password').then(() => {
      const passwordForm = document.querySelector('#submit-button-password');
      const actualPassword = document.querySelector('#previous-password').value;
      const newPassword = document.querySelector('#new-password').value;
      const repeatNewPassword = document.querySelector('#repeat-new-password').value;

      passwordForm.addEventListener('click', () => {
        this.editPassword(actualPassword, newPassword, repeatNewPassword);
        this.cancelButton();
      });
    });

    this.waitForElm('#exit-cross').then(() => {
      const cross = document.querySelector('#exit-cross');
      cross.addEventListener('click', () => {
        this.cancelButton();
      });
    });
  };

  renderModifyPicture = () => (
    `
      <div class="title-cross">
        <h2>Modifier la photo de profil</h2>
        <span id="exit-cross">X</span>
      </div>
      <div class="picture-link">
        <label for="picture-link">Lien de l'image</label>
        <input type="text" id="picture-link" name="picture-link">
      </div>
      <button type="button" id="submit-button-picture" class="submit">Valider</button>
    `
  );

  renderModifyEmail = () => (
    `
      <div class="title-cross">
        <h2>Modifier l'email</h2>
        <span id="exit-cross">X</span>
      </div>
      <div class="new-email">
        <label for="new-email">Nouvel email</label>
        <input type="email" id="new-email" name="new-email">
      </div>
      <button type="button" id="submit-button-email" class="submit">Valider</button>
    `
  );

  renderModifyPassword = () => (
    `
      <div class="title-cross">
        <h2>Modifier le mot de passe</h2>
        <span id="exit-cross">X</span>
      </div>
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
      <button type="button" id="submit-button-password" class="submit">Valider</button>
    `
  );

  renderModifyNumber = () => (
    `
      <div class="title-cross">
        <h2>Modifier le téléphone</h2>
        <span id="exit-cross">X</span>
      </div>
      <div class="new-number">
        <label for="new-number">Nouveau numéro</label>
        <input type="text" id="new-number" name="new-number">
      </div>
      <button type="button" id="submit-button-number" class="submit">Valider</button>
    `
  );

  renderUser = (userData) => {
    const {
      firstname,
      lastname,
      email,
      number,
      offer,
      createdAt
    } = userData;

    return `
      <div id="rdv-background" class="hide">
      </div>
      <div id="profile-dialog-box" class="hide">
      </div>
      <div class="picture-name">
        <img src="${pp}" alt="Photo de profil">
        <h2>${firstname} ${lastname}</h2>
        <button type="button" class="change-picture">Changer la photo de profil</button>  
      </div>
      <div class="profile-blocks">
        <div class="information-title">
          <h3>Informations</h3>
          <div class="informations">
            <div class="informations-box">
              <div class="email">
                <h6>Email</h6>
                <p>${email}</p>
              </div>
              <button type="button" class="change-email">Modifier l'email</button>
              <div class="phone">
                <h6>Téléphone</h6>
                <p>${number}</p>
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
                <p>${offer ?? 'Aucune'}</p>
              </div>
              <div class="inscription-date">
                <h6>Date d'inscription</h6>
                <p>${createdAt}</p>
              </div>
              <div class="coach">
                <h6>Coach personnel</h6>
                <p>${offer ?? 'Aucun'}</p>
              </div>
              <div class="coach-validity">
                <h6>Fin de coaching personnel</h6>
                <p>${offer ?? 'Inconnu'}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
  };

  render = () => (
    `
      <div id="profile">
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

  run = async () => {
    this.el.innerHTML = this.render();
    await this.getUserInformations();

    this.waitForElm('#rdv-background').then(() => {
      this.ButtonListening();
    });
  };
};

export default Profile;
