import logo from './logo.svg';
import './App.css';
import LogIn from "./components/logIn/LogIn";
import Err404 from "./components/Errors/404";
import Users from "./components/user/Users";
import User from "./components/user/User";
import AddUser from "./components/user/AddUser";
import UpdateUser from "./components/user/UpdateUser";
import DeleteUser from "./components/user/DeleteUser";
import {Routes, Route} from "react-router-dom";

const App = () => {
  return (
    <Routes>
      <Route path={"/"} />
      <Route path={"login"} element={<LogIn />} />
      <Route path={"api"} >
        <Route path={"users"} element={<Users />} />
        <Route path={"user"}>
          <Route path={"add"} element={<AddUser />} />
          <Route path={":id"} element={<User />} />
          <Route path={"update/:id"} element={<UpdateUser />} />
          <Route path={"delete/:id"} element={<DeleteUser />} />
        </Route>
      </Route>
      <Route path={"*"} element={<Err404 />} />
    </Routes>
  )
}

export default App;
