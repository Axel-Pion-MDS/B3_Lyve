import './User.css'

import React, {useEffect, useState} from "react";
import axios from "axios";

const Users = () => {
  const [persons, setPersons] = useState([]);

  useEffect(() =>  {
    axios.get(`http://lyve.local/api/users`)
      .then(res => {
        setPersons(res.data['hydra:member']);
      })
  }, [])

  return (
    <div>
      <a className={"button"} href={"user/add"}>Ajouter</a>
      <table>
        <thead>
        <tr>
          <th>ID</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {
          persons.sort((a, b) => a.id - b.id).map((person) => (
            <tr key={`person_table_${person.id}`}>
              <td key={`person_id_${person.id}`}>{person.id}</td>
              <td key={`person_firstname_${person.id}`}>{person.firstname}</td>
              <td key={`person_lastname_${person.id}`}>{person.lastname}</td>
              <td key={`person_email_${person.id}`}>{person.email}</td>
              <td key={`action_btn_${person.id}`}>
                <a className={"button"} href={`/api/user/${person.email}`}>Voir</a>
                <a className={"button"} href={`/api/user/update/${person.email}`}>Modifier</a>
                <a className={"button"} href={`/api/user/delete/${person.email}`}>Supprimer</a>
              </td>
            </tr>
          ))
        }
        </tbody>
      </table>
    </div>
  )
}

export default Users;
