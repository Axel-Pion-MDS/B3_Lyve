import './Menu.css';
import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons/faMagnifyingGlass";
import { faBell } from "@fortawesome/free-regular-svg-icons/faBell";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

export const Menu = () => {
  return (
    <div id={"menu"}>
      <div className={"menu-icons"}>
        <div className={"search-bar"}>
          <input type={"text"} className={"search-input"} placeholder={"Rechercher"} />
          <div className={"search-icon"}>
            <FontAwesomeIcon icon={faMagnifyingGlass} />
          </div>
        </div>
        <button className={"notifications"}>
          <div className={"notifications-circle notif-show"} />
          <FontAwesomeIcon className={"notifications-icon"} icon={faBell} />
        </button>
        <button className={"profile"}>

        </button>
      </div>
    </div>
  )
}
