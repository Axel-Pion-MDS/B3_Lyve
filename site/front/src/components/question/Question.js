import './Question.scss';

const Question = class {
  constructor() {
    this.app = document.querySelector('#app');
    this.el = document.querySelector('#body');
  }

  renderResult = () => (
    `
      <h2>Bien joué !</h2>
      <p class="good-result">1/1</p>
      <button type="button" class="next-button">Suivant</button>
    `
  );

  renderQuestion = () => (
    `
      <div class="question">
        <div class="question-titles">
          <h6>Question 1</h6>
          <h5>Quel facteur permet à un moteur de recherche de déterminer si votre entreprise est locale ?</h5>
        </div>
        <div class="separator"></div>
        <div class="question-choices">
          <div class="icon-border">
            <i class="fa-solid fa-a"></i>
          </div>
          <input type="checkbox" id="answer-a" name="answer-a">
          <label for="answer-a" class="answer-a">Les informations géographiques figurant sur le site Web, la qualité du contenu et l’adéquation du site Web aux mobiles.</label>
        </div>
        <div class="separator"></div>
        <div class="question-choices">
          <div class="icon-border">
            <i class="fa-solid fa-b"></i>
          </div>
          <input type="checkbox" id="answer-b" name="answer-b">
          <label for="answer-b" class="answer-b">Les informations géographiques figurant sur le site Web, la qualité du contenu et l’adéquation du site Web aux mobiles.</label>
        </div>
        <div class="separator"></div>
        <div class="question-choices">
          <div class="icon-border">
            <i class="fa-solid fa-c"></i>
          </div>
          <input type="checkbox" id="answer-c" name="answer-c">
          <label for="answer-c" class="answer-c">Les informations géographiques figurant sur le site Web, la qualité du contenu et l’adéquation du site Web aux mobiles.</label>
        </div>
        <div class="separator"></div>
        <div class="question-choices">
          <div class="icon-border">
            <i class="fa-solid fa-d"></i>
          </div>
          <input type="checkbox" id="answer-d" name="answer-d">
          <label for="answer-d" class="answer-d">Les informations géographiques figurant sur le site Web, la qualité du contenu et l’adéquation du site Web aux mobiles.</label>
        </div>
        <div class="separator"></div>
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
      </div>
      <div class="survey">
        <div id="question-details">
        </div>
        <button type="button" class="valid-answers">Valider les réponses</button>
        <div id="rdv-background" class="hide">
        </div>
        <div id="question-result" class="hide">
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
    this.renderSelectedLink();

    const questions = document.querySelector('#question-details');
    questions.innerHTML = this.renderQuestion();

    this.waitForElm('.answer-a').then(() => {
      const answerA = document.querySelector('.answer-a');

      answerA.addEventListener('click', () => {
        if (!answerA.attributes.checked) {
          answerA.setAttribute('checked', 'checked');
        } else {
          answerA.removeAttribute('checked');
        }
      });
    });

    this.waitForElm('.answer-b').then(() => {
      const answerB = document.querySelector('.answer-b');

      answerB.addEventListener('click', () => {
        if (!answerB.attributes.checked) {
          answerB.setAttribute('checked', 'checked');
        } else {
          answerB.removeAttribute('checked');
        }
      });
    });

    this.waitForElm('.answer-c').then(() => {
      const answerC = document.querySelector('.answer-c');

      answerC.addEventListener('click', () => {
        if (!answerC.attributes.checked) {
          answerC.setAttribute('checked', 'checked');
        } else {
          answerC.removeAttribute('checked');
        }
      });
    });

    this.waitForElm('.answer-d').then(() => {
      const answerD = document.querySelector('.answer-d');

      answerD.addEventListener('click', () => {
        if (!answerD.attributes.checked) {
          answerD.setAttribute('checked', 'checked');
        } else {
          answerD.removeAttribute('checked');
        }
      });
    });

    const validButton = document.querySelector('.valid-answers');

    validButton.addEventListener('click', () => {
      const result = document.querySelector('#question-result');
      const background = document.querySelector('#rdv-background');
      background.className = 'show';
      result.className = 'show';
      result.innerHTML = this.renderResult();

      this.waitForElm('.next-button').then(() => {
        const next = document.querySelector('.next-button');

        next.addEventListener('click', () => {
          // eslint-disable-next-line no-restricted-globals
          location.href = 'chapter';
        });
      });
    });
  };
};

export default Question;
