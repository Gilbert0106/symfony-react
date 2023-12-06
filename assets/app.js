import React from "react";
import { createRoot } from 'react-dom/client';
import './styles/app.css';

class App extends React.Component {
  render() {
    return (
      <h1>Hello</h1>
    )
  }
}

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<App/>);