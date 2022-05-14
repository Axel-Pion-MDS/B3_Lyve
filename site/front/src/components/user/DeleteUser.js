import "./User.css";
import axios from "axios";
import {Navigate, useParams} from "react-router-dom";

const DeleteUser = () => {
  let {id} = useParams();

  axios.delete(`http://lyve.local/user/delete?id=${id}`)
    .then(() => {
    })
    .catch(err => console.log(err));

  return <Navigate to={"/api/users"}/>;
}

export default DeleteUser;
