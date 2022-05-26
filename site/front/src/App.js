import logo from './logo.svg';
import './App.css';
import {Homepage} from "./components/Dashboard/Homepage/Homepage";
import {AdminHomepage} from "./components/Admin/Homepage/AdminHomepage";
import {LogIn} from "./components/Dashboard/Connection/LogIn/LogIn";
import {LogOut} from "./components/Dashboard/Connection/LogOut/LogOut";
import {SignIn} from "./components/Dashboard/Connection/SignIn/SignIn";
import {PasswordRecovery} from "./components/Dashboard/Connection/PasswordRecovery/PasswordRecovery";
import {Err404} from "./components/Errors/404";
import {ListAnswers} from "./components/Admin/Answer/List/ListAnswers";
import {ShowAnswer} from "./components/Admin/Answer/Show/ShowAnswer";
import {AddAnswer} from "./components/Admin/Answer/Add/AddAnswer";
import {EditAnswer} from "./components/Admin/Answer/Edit/EditAnswer";
import {DeleteAnswer} from "./components/Admin/Answer/Delete/DeleteAnswer";
import {ListBadges} from "./components/Admin/Badge/List/ListBadges";
import {ShowBadge} from "./components/Admin/Badge/Show/ShowBadge";
import {AddBadge} from "./components/Admin/Badge/Add/AddBadge";
import {EditBadge} from "./components/Admin/Badge/Edit/EditBadge";
import {DeleteBadge} from "./components/Admin/Badge/Delete/DeleteBadge";
import {ListChapters} from "./components/Admin/Chapter/List/ListChapters";
import {ShowChapter} from "./components/Admin/Chapter/Show/ShowChapter";
import {AddChapter} from "./components/Admin/Chapter/Add/AddChapter";
import {EditChapter} from "./components/Admin/Chapter/Edit/EditChapter";
import {DeleteChapter} from "./components/Admin/Chapter/Delete/DeleteChapter";
import {ListModules} from "./components/Admin/Module/List/ListModules";
import {ShowModule} from "./components/Admin/Module/Show/ShowModule";
import {AddModule} from "./components/Admin/Module/Add/AddModule";
import {EditModule} from "./components/Admin/Module/Edit/EditModule";
import {DeleteModule} from "./components/Admin/Module/Delete/DeleteModule";
import {ListOffers} from "./components/Admin/Offer/List/ListOffers";
import {ShowOffer} from "./components/Admin/Offer/Show/ShowOffer";
import {AddOffer} from "./components/Admin/Offer/Add/AddOffer";
import {EditOffer} from "./components/Admin/Offer/Edit/EditOffer";
import {DeleteOffer} from "./components/Admin/Offer/Delete/DeleteOffer";
import {ListParts} from "./components/Admin/Part/List/ListParts";
import {ShowPart} from "./components/Admin/Part/Show/ShowPart";
import {AddPart} from "./components/Admin/Part/Add/AddPart";
import {EditPart} from "./components/Admin/Part/Edit/EditPart";
import {DeletePart} from "./components/Admin/Part/Delete/DeletePart";
import {ListQuestions} from "./components/Admin/Question/List/ListQuestions";
import {ShowQuestion} from "./components/Admin/Question/Show/ShowQuestion";
import {AddQuestion} from "./components/Admin/Question/Add/AddQuestion";
import {EditQuestion} from "./components/Admin/Question/Edit/EditQuestion";
import {DeleteQuestion} from "./components/Admin/Question/Delete/DeleteQuestion";
import {ListRoles} from "./components/Admin/Role/List/ListRoles";
import {ShowRole} from "./components/Admin/Role/Show/ShowRole";
import {AddRole} from "./components/Admin/Role/Add/AddRole";
import {EditRole} from "./components/Admin/Role/Edit/EditRole";
import {DeleteRole} from "./components/Admin/Role/Delete/DeleteRole";
import {ListTimesheets} from "./components/Admin/Timesheet/List/ListTimesheets";
import {ShowTimesheet} from "./components/Admin/Timesheet/Show/ShowTimesheet";
import {AddTimesheet} from "./components/Admin/Timesheet/Add/AddTimesheet";
import {EditTimesheet} from "./components/Admin/Timesheet/Edit/EditTimesheet";
import {DeleteTimesheet} from "./components/Admin/Timesheet/Delete/DeleteTimesheet";
import {ListUsers} from "./components/Admin/User/List/ListUsers";
import {ShowUser} from "./components/Admin/User/Show/ShowUser";
import {AddUser} from "./components/Admin/User/Add/AddUser";
import {EditUser} from "./components/Admin/User/Edit/EditUser";
import {DeleteUser} from "./components/Admin/User/Delete/DeleteUser";
import {Err403} from "./components/Errors/403";
import {Err500} from "./components/Errors/500";
import {Routes, Route} from "react-router-dom";
import {Answer} from "./components/Admin/Answer/Answer";
import {Badge} from "./components/Admin/Badge/Badge";
import {Chapter} from "./components/Admin/Chapter/Chapter";
import {Module} from "./components/Admin/Module/Module";
import {Offer} from "./components/Admin/Offer/Offer";
import {Part} from "./components/Admin/Part/Part";
import {AdminStatistics} from "./components/Admin/Statistics/AdminStatistics";
import {AdminTimesheet} from "./components/Admin/Timesheet/AdminTimesheet";
import {User} from "./components/Admin/User/User";
import {Courses} from "./components/Dashboard/Courses/Courses";
import {Notifications} from "./components/Dashboard/Notifications/Notifications";
import {Profile} from "./components/Dashboard/Profile/Profile";
import {Statistics} from "./components/Dashboard/Statistics/Statistics";
import {Timesheet} from "./components/Dashboard/Timesheet/Timesheet";

const App = () => {
  return (
    <div id={"app"}>
      <Routes>
        <Route path={"/"} element={<Homepage />} />
        <Route path={"login"} element={<LogIn />} />
        <Route path={"signin"} element={<SignIn />} />
        <Route path={"logout"} element={<LogOut />} />
        <Route path={"recover"} element={<PasswordRecovery />} />
        <Route path={"courses"} element={<Courses />} >

        </Route>
        <Route path={"notifications"} element={<Notifications />} />
        <Route path={"profile"} element={<Profile />} />
        <Route path={"statistics"} element={<Statistics />} />
        <Route path={"timesheet"} element={<Timesheet />} />
        <Route path={"admin"} >
          <Route path={"homepage"} element={<AdminHomepage />} />
          <Route path={"answer"} element={<Answer />} />
          <Route path={"badge"} element={<Badge />} />
          <Route path={"chapter"} element={<Chapter />} />
          <Route path={"module"} element={<Module />} />
          <Route path={"offer"} element={<Offer />} />
          <Route path={"part"} element={<Part />} />
          <Route path={"statistics"} element={<AdminStatistics />} />
          <Route path={"timesheet"} element={<AdminTimesheet />} />
          <Route path={"user"} element={<User />} />
        </Route>
        <Route path={"api"} >
          <Route path={"answer"}>
            <Route path={"list"} element={<ListAnswers />} />
            <Route path={"show/:id"} element={<ShowAnswer />} />
            <Route path={"add"} element={<AddAnswer />} />
            <Route path={"update"} element={<EditAnswer />} />
            <Route path={"delete/:id"} element={<DeleteAnswer />} />
          </Route>
          <Route path={"badge"}>
            <Route path={"list"} element={<ListBadges />} />
            <Route path={"show/:id"} element={<ShowBadge />} />
            <Route path={"add"} element={<AddBadge />} />
            <Route path={"update"} element={<EditBadge />} />
            <Route path={"delete/:id"} element={<DeleteBadge />} />
          </Route>
          <Route path={"chapter"}>
            <Route path={"list"} element={<ListChapters />} />
            <Route path={"show/:id"} element={<ShowChapter />} />
            <Route path={"add"} element={<AddChapter />} />
            <Route path={"update"} element={<EditChapter />} />
            <Route path={"delete/:id"} element={<DeleteChapter />} />
          </Route>
          <Route path={"module"}>
            <Route path={"list"} element={<ListModules />} />
            <Route path={"show/:id"} element={<ShowModule />} />
            <Route path={"add"} element={<AddModule />} />
            <Route path={"update"} element={<EditModule />} />
            <Route path={"delete/:id"} element={<DeleteModule />} />
          </Route>
          <Route path={"offer"}>
            <Route path={"list"} element={<ListOffers />} />
            <Route path={"show/:id"} element={<ShowOffer />} />
            <Route path={"add"} element={<AddOffer />} />
            <Route path={"update"} element={<EditOffer />} />
            <Route path={"delete/:id"} element={<DeleteOffer />} />
          </Route>
          <Route path={"part"}>
            <Route path={"list"} element={<ListParts />} />
            <Route path={"show/:id"} element={<ShowPart />} />
            <Route path={"add"} element={<AddPart />} />
            <Route path={"update"} element={<EditPart />} />
            <Route path={"delete/:id"} element={<DeletePart />} />
          </Route>
          <Route path={"question"}>
            <Route path={"list"} element={<ListQuestions />} />
            <Route path={"show/:id"} element={<ShowQuestion />} />
            <Route path={"add"} element={<AddQuestion />} />
            <Route path={"update"} element={<EditQuestion />} />
            <Route path={"delete/:id"} element={<DeleteQuestion />} />
          </Route>
          <Route path={"role"}>
            <Route path={"list"} element={<ListRoles />} />
            <Route path={"show/:id"} element={<ShowRole />} />
            <Route path={"add"} element={<AddRole />} />
            <Route path={"update"} element={<EditRole />} />
            <Route path={"delete/:id"} element={<DeleteRole />} />
          </Route>
          <Route path={"timesheet"}>
            <Route path={"list"} element={<ListTimesheets />} />
            <Route path={"show/:id"} element={<ShowTimesheet />} />
            <Route path={"add"} element={<AddTimesheet />} />
            <Route path={"update"} element={<EditTimesheet />} />
            <Route path={"delete/:id"} element={<DeleteTimesheet />} />
          </Route>
          <Route path={"user"}>
            <Route path={"list"} element={<ListUsers />} />
            <Route path={"show/:id"} element={<ShowUser />} />
            <Route path={"add"} element={<AddUser />} />
            <Route path={"update"} element={<EditUser />} />
            <Route path={"delete/:id"} element={<DeleteUser />} />
          </Route>
        </Route>
        <Route path={"error403"} element={<Err403 />} />
        <Route path={"error500"} element={<Err500 />} />
        <Route path={"*"} element={<Err404 />} />
      </Routes>
    </div>
  )
}

export default App;
