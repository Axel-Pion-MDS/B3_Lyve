import './ListUsers.css'

import React, {useEffect, useState} from "react";
import {Link} from "react-router-dom";
import axios from "axios";

export const ListUsers = () => {
  const [persons, setPersons] = useState([]);

  useEffect(() => {
    axios.get(`http://lyve.local/user/list`)
      .then(res => {
        setPersons(res.data.data);
      })
  }, [])

  return (
    <div>
      <Link to={"user/add"}>Add</Link>
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
                  <Link to={`/api/user/${person.id}`}>See</Link>
                  <Link to={`/api/user/update/${person.id}`}>Edit</Link>
                  <Link to={`/api/user/delete/${person.id}`}>Delete</Link>
              </td>
            </tr>
          ))
        }
        </tbody>
      </table>
    </div>
  )
}
