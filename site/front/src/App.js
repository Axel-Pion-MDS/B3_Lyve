import logo from './logo.svg';
import './App.css';
import LogIn from "./components/Dashboard/Connection/LogIn/LogIn";
import Err404 from "./components/Errors/404";
import ListUsers from "./components/Admin/User/List/Users";
import ShowUser from "./components/Admin/User/Show/User";
import AddUser from "./components/Admin/User/Add/AddUser";
import EditUser from "./components/Admin/User/UpdateUser";
import DeleteUser from "./components/Admin/User/Delete/DeleteUser";
import {Routes, Route} from "react-router-dom";

const App = () => {
  return (
    <Routes>
      <Route path={"/"} />
      <Route path={"login"} element={<LogIn />} />
      <Route path={"api"} >
        <Route path={"users"} element={<ListUsers />} />
        <Route path={"user"}>
          <Route path={"add"} element={<AddUser />} />
          <Route path={":id"} element={<ShowUser />} />
          <Route path={"update/:id"} element={<EditUser />} />
          <Route path={"delete/:id"} element={<DeleteUser />} />
        </Route>
      </Route>
      <Route path={"*"} element={<Err404 />} />
    </Routes>
  )
}

export default App;
