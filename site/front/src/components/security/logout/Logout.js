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
    window.sessionStorage.clear();
    window.location.href = '';
  };

  run = () => {
    this.getLoggedOut();
  };
};

export default Logout;
