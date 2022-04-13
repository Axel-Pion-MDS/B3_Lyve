import "./User.css";
import {useEffect, useState} from "react";
import axios from "axios";

const AddUser = () => {
  const [fname, setFname] = useState('')
  const [lname, setLname] = useState('')
  const [email, setEmail] = useState('')
  const [birthdate, setBirthdate] = useState('')
  const [number, setNumber] = useState('')
  const [selectedRole, setSelectedRole] = useState([]);
  const [selectedOffer, setSelectedOffer] = useState([]);
  const [selectedBadges, setSelectedBadges] = useState([]);
  const [selectedModules, setSelectedModules] = useState([]);
  const [count, setCount] = useState(0);
  let roles = [];
  let offers = [];
  let badges = [];
  let modules = [];

  // useEffect(() => {
  //   console.log(count);
  //   setCount(1);
  // }, [])

  const getRoles = () => {
    axios.get(`http://lyve.local/api/roles`, {
      headers: {
        Accept: 'application/ld+json',
        'Content-Type': 'application/json',
      },
    })
      .then(res => {
        return roles = res.data['hydra:member'];
      });
  };

  const getOffers = () => {
    axios.get(`http://lyve.local/api/offers`, {
      headers: {
        Accept: 'application/ld+json',
        'Content-Type': 'application/json',
      },
    })
      .then(res => {
        return offers = res.data['hydra:member'];
      });
  };

  const getBadges = () => {
    axios.get(`http://lyve.local/api/badges`, {
      headers: {
        Accept: 'application/ld+json',
        'Content-Type': 'application/json',
      },
    })
      .then(res => {
        return badges = res.data['hydra:member'];
      });
  };

  const getModules = () => {
    axios.get(`http://lyve.local/api/modules`, {
      headers: {
        Accept: 'application/ld+json',
        'Content-Type': 'application/json',
      },
    })
      .then(res => {
        return modules = res.data['hydra:member'];
      });
  };

  // const getPersons = () => {
  //   axios.get(`http://lyve.local/api/users`)
  //     .then(res => {
  //       setPersons(res.data['hydra:member']);
  //     });
  // };

  const handleSubmit = (event) => {
    event.preventDefault();
    let data = {
      'firstname': fname,
      'lastname': lname,
      'email': email,
      'birthdate': birthdate,
      'number': number,
      'role': selectedRole,
      'offer': selectedOffer,
      'badges': selectedBadges,
      'modules': selectedModules,
    }

    axios.put(`http://lyve.local/api/users/new/${email}`, {
      headers: {
        Accept: 'application/ld+json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data)
    })
      .then(res => (res.statusText))
      .then(
        (res) => {
          return res;
        }
      )
  }

  return (
    <div className={"addUser"}>
      <h1>Add User</h1>
      <form onSubmit={handleSubmit}>
        <label htmlFor={"firstname"}>
          <span className={"firstname"}>Prénom</span>
          <input type={"text"} className={"firstname"} id={"firstname"} placeholder={"Anne"} onChange={(e) => setFname(e.target.value)} required/>
        </label>
        <label htmlFor={"lastname"}>
          <span className={"lastname"}>Nom</span>
          <input type={"text"} className={"lastname"} id={"lastname"} placeholder={"O'nyme"} onChange={(e) => setLname(e.target.value)} required/>
        </label>
        <label htmlFor={"email"}>
          <span className={"email"}>Email</span>
          <input type={"text"} className={"email"} id={"email"} placeholder={"anne.o-nyme@gmail.com"} onChange={(e) => setEmail(e.target.value)} required/>
        </label>
        <label htmlFor={"birthdate"}>
          <span className={"birthdate"}>Date de naissance</span>
          <input type={"date"} className={"birthdate"} id={"birthdate"} onChange={(e) => setBirthdate(e.target.value)} required/>
        </label>
        <label htmlFor={"number"}>
          <span className={"number"}>Numéro de téléphone</span>
          <input type={"text"} className={"number"} id={"number"} placeholder={"0612345678"} onChange={(e) => setNumber(e.target.value)} required/>
        </label>
        <label htmlFor={"role"} >
          <span className={"role"}>Rôle</span>
          {roles = getRoles()}
          <select name={"role"} id={"role"} onChange={(e) => setSelectedRole(e.target.value)}>
            <option value={""} key={"role_default"}>Choisir un rôle</option>
            {
              roles.sort((a, b) => a.id - b.id).map((role) => (
                <option value={role.title} key={role.id}>{role.title}</option>
              ))
            }
          </select>
        </label>
        <label htmlFor={"offer"}>
          <span className={"offer"}>Offre</span>
          {getOffers()}
          <select name={"offer"} id={"offer"} onChange={(e) => setSelectedOffer(e.target.value)}>
            <option value={""} key={"role_default"}>Choisir une offre</option>
            {
              offers.sort((a, b) => a.id - b.id).map((offer) => (
                <option value={offer.title} key={offer.id}>{offer.title}</option>
              ))
            }
          </select>
        </label>
        <label htmlFor={"badge"}>
          <span className={"badge"}>Badge</span>
          {getBadges()}
          <select name={"badge"} id={"badge"} onChange={(e) => setSelectedBadges(e.target.value)} multiple>
            {
              badges.sort((a, b) => a.id - b.id).map((badge) => (
                <option value={badge.title} key={badge.id}>{badge.title}</option>
              ))
            }
          </select>
        </label>
        <label htmlFor={"module"}>
          <span className={"module"}>Module</span>
          {getModules()}
          <select name={"module"} id={"module"} onChange={(e) => setSelectedModules(e.target.value)} multiple>
            {
              modules.sort((a, b) => a.id - b.id).map((module) => (
                <option value={module.title} key={module.id}>{module.title}</option>
              ))
            }
          </select>
        </label>
        <button type={"submit"} id={"submit"} value={"submit"}>Valider</button>
      </form>
    </div>
  );
}

export default AddUser;
