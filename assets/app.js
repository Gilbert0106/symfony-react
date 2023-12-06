import React from "react";
import "./styles/app.css";
import { createRoot } from "react-dom/client";
import ProductList from "./components/ProductList";

class App extends React.Component {
  render() {
    return (<ProductList></ProductList>);
  }
}

const container = document.getElementById("root");
const root = createRoot(container);
root.render(<App />);
