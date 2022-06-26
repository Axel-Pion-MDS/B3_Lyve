import './index.scss';
import Answer from './components/answer/Answer.js';
import Badge from './components/badge/Badge.js';
import Chapter from './components/chapter/Chapter.js';
import Homepage from './components/homepage/Homepage.js';
import Module from './components/module/Module.js';
import LeftNavbar from './components/navbar/left/LeftNavbar.js';
import TopNavbar from './components/navbar/top/TopNavbar.js';
import Offer from './components/offer/Offer.js';
import Part from './components/part/Part.js';
import Question from './components/question/Question.js';
import Role from './components/role/Role.js';
import User from './components/user/User.js';
import UserAnswer from './components/user_answer/UserAnswer.js';
import Error404 from './components/error/Error404.js';
import Timesheet from './components/timesheet/Timesheet.js';
import Statistics from './components/statistics/Statistics.js';
import Courses from './components/courses/Courses.js';
import Profile from './components/profile/Profile.js';
import Login from './components/security/login/Login.js';

const Routes = class Routing {
  getPath = () => {
    const arrayPath = window.location.pathname.split('/');
    arrayPath.shift();

    return arrayPath.join('/');
  };

  run = () => {
    const answer = new Answer();
    const badge = new Badge();
    const chapter = new Chapter();
    const homepage = new Homepage();
    const module = new Module();
    const leftNavbar = new LeftNavbar();
    const topNavbar = new TopNavbar();
    const offer = new Offer();
    const part = new Part();
    const question = new Question();
    const role = new Role();
    const user = new User();
    const userAnswer = new UserAnswer();
    const error404 = new Error404();
    const timesheet = new Timesheet();
    const statistics = new Statistics();
    const courses = new Courses();
    const profile = new Profile();
    const login = new Login();

    leftNavbar.run();
    topNavbar.run();

    switch (this.getPath()) {
      case '':
        homepage.run();
        break;
      case 'answer':
        answer.run();
        break;
      case 'badge':
        badge.run();
        break;
      case 'chapter':
        chapter.run();
        break;
      case 'module':
        module.run();
        break;
      case 'offer':
        offer.run();
        break;
      case 'part':
        part.run();
        break;
      case 'question':
        question.run();
        break;
      case 'role':
        role.run();
        break;
      case 'user':
        user.run();
        break;
      case 'user-answer':
        userAnswer.run();
        break;
      case 'timesheet':
        timesheet.run();
        break;
      case 'statistics':
        statistics.run();
        break;
      case 'courses':
        courses.run();
        break;
      case 'profile':
        profile.run();
        break;
      case 'login':
        login.run();
        break;
      default:
        error404.run();
    }
  };
};

const routes = new Routes();

routes.run();
