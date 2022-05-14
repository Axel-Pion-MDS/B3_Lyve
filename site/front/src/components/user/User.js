import "./User.css";
import moment from "moment";
import React, {useEffect, useState} from "react";
import axios from "axios";
import {useParams} from "react-router-dom";

const User = () => {
  let { id } = useParams();
  const [datas, setDatas] = useState([]);

  useEffect(() =>  {
    axios.get(`http://lyve.local/user/show?id=${id}`)
      .then(res => {
        setDatas(res.data.data);
      })
  }, [])

  return (
    <div>
      <h1>User details</h1>
      {
        datas.map((data) => (
          <div key={`div_user_${data.id}`}>
            <label htmlFor={"id"}>ID : </label>
            <input type={"text"} id={"id"} key={`user_id_${data.id}`} value={data.id} readOnly />
            <label htmlFor={"firstname"}>Firstname : </label>
            <input type={"text"} id={"firstname"} key={`user_firstname_${data.id}`} value={data.firstname} readOnly />
            <label htmlFor={"lastname"}>Lastname : </label>
            <input type={"text"} id={"lastname"} key={`user_lastname_${data.id}`} value={data.lastname} readOnly />
            <label htmlFor={"email"}>Email : </label>
            <input type={"text"} id={"email"} key={`user_email_${data.id}`} value={data.email} readOnly />
            <label htmlFor={"birthdate"}>Birthdate : </label>
            <input type={"text"} id={"birthdate"} key={`user_birthdate_${data.id}`} value={moment(data.birthdate.date).format('Y-MM-DD')} readOnly />
            <label htmlFor={"number"}>Number : </label>
            <input type={"text"} id={"number"} key={`user_number_${data.id}`} value={data.number} readOnly />
            <label htmlFor={"role"}>Role : </label>
            <input type={"text"} id={"role"} key={`user_role_${data.id}`} value={data.role} readOnly />
            <label htmlFor={"offer"}>Offer : </label>
            <input type={"text"} id={"offer"} key={`user_offer_${data.id}`} value={data.offer} readOnly />
            <label htmlFor={"badge"}>Badge : </label>
            <input type={"text"} id={"badge"} key={`user_badge_${data.id}`} value={data.badge} readOnly />
          </div>
        ))
      }
    </div>
  )
}

export default User;
