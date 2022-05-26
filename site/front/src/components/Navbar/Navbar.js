import "./Navbar.css";

export const Navbar = () => {
  return (
    <div id={"navbar"}>
      <div className={"clear-navbar"}>
        <div id={"logo"}>
          <h1>
            <a href={"/"}>
              <img className="lyve-logo" src={"/img/Logo-Lyve.svg"} alt={"Lyve"} />
            </a>
          </h1>
        </div>
        <div id={"navbar-links"}>
          <ul>
            <li>
              {/*<img class={"navbar-icons"} src={""} alt={"home"} />*/}
              <a href={"/"}>Accueil</a>
            </li>
            <li>
              {/*<img className={"navbar-icons"} src={""} alt={"timesheet"}/>*/}
              <a href={"timesheet"}>Agenda</a>
            </li>
            <li>
              {/*<img className={"navbar-icons"} src={""} alt={"statistics"}/>*/}
              <a href={"statistics"}>Statistiques</a>
            </li>
            <li>
              {/*<img className={"navbar-icons"} src={""} alt={"courses"}/>*/}
              <a href={"courses"}>Formations</a>
            </li>
          </ul>
        </div>
      </div>
      <div className={"blur-border"}>
      </div>
    </div>
  )
}
