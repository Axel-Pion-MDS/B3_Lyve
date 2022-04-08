import './User.css'

import React, {useEffect, useState} from "react";
import axios from "axios";

const Users = () => {
  const [persons, setPersons] = useState([]);
  console.log(persons);

  useEffect(() =>  {
    axios.get(`http://lyve.local/api/users`)
      .then(res => {
        console.log(res.data['hydra:member']);
        setPersons(res.data['hydra:member']);
      })
  }, [])

  return (
    <div>
      <table>
        <thead>
        <tr>
          <th>ID</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
        </tr>
        </thead>
        <tbody>
        {
          persons.map((person) => (
            <tr key={"person_table_" + person.id}>
              <td key={"person_id_" + person.id}>{person.id}</td>
              <td key={"person_firstname_" + person.id}>{person.firstname}</td>
              <td key={"person_lastname_" + person.id}>{person.lastname}</td>
              <td key={"person_email_" + person.id}>{person.email}</td>
            </tr>
          ))
        }
        </tbody>
      </table>
    </div>
  )
}

export default Users;
