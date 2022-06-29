import axios from 'axios';

const Logout = class {
  getLoggedOut = () => {
    axios.get('https://lyve.local/security/logout', {
      host: 'lyve.local',
      headers: {
        Accept: '*/*'
      }
    }).catch((err) => { throw new Error(err); });

    window.localStorage.clear();
    window.location.href = 'login';
  };

  run = () => {
    this.getLoggedOut();
  };
};

export default Logout;
