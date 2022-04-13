import "./User.css";
import {useEffect, useState} from "react";
import axios from "axios";
import {useParams} from "react-router-dom";

const User = () => {
  let { id } = useParams();
  const [datas, setDatas] = useState([]);

  useEffect(() =>  {
    axios.get(`http://lyve.local/api/user/${id}`)
      .then(res => {
        console.log(res.data['hydra:member']);
        setDatas(res.data['hydra:member']);
      })
  }, [])

  return (
    <div>
      <h1>User</h1>

    </div>
  )
}

export default User;
