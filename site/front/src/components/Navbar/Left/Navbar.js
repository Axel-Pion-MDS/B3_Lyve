import "./Navbar.css";

import {faHouseUser} from "@fortawesome/free-solid-svg-icons/faHouseUser";
import {faCalendar} from "@fortawesome/free-regular-svg-icons/faCalendar";
import {faChartSimple} from "@fortawesome/free-solid-svg-icons/faChartSimple";
import {faGraduationCap} from "@fortawesome/free-solid-svg-icons/faGraduationCap";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faMagnifyingGlass} from "@fortawesome/free-solid-svg-icons/faMagnifyingGlass";

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
              <FontAwesomeIcon icon={faHouseUser} />
              <a href={"/"}>
                Accueil
              </a>
            </li>
            <li>
              <FontAwesomeIcon icon={faCalendar} />
              <a href={"timesheet"}>
                Agenda
              </a>
            </li>
            <li>
              <FontAwesomeIcon icon={faChartSimple} />
              <a href={"statistics"}>
                Statistiques
              </a>
            </li>
            <li>
              <FontAwesomeIcon icon={faGraduationCap} />
              <a href={"courses"}>
                Formations
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div className={"blur-border"}>
      </div>
    </div>
  )
}
