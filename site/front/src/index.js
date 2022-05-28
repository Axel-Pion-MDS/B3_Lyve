import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import {BrowserRouter} from "react-router-dom";
import {Navbar} from "./components/Navbar/Left/Navbar";
import {Menu} from "./components/Navbar/Top/Menu";

ReactDOM.render(
  <BrowserRouter>
    <Navbar />
    <div className={"menu-app"}>
      <Menu />
      <App />
    </div>
  </BrowserRouter>,
  document.getElementById('root')
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals(console.log);
