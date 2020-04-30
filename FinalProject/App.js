import React from 'react';
import './App.css';

function App() {
  return (
  <div>
    <a href={process.env.PUBLIC_URL + "/eventForm.js"}>
		<button className="newEventButton">
			Create a New Event
		</button>
	</a>	
	<div className="event" style={{left:"2%"}}>
		EVENT 1
		<div className="eventBodyText">
			This is some example body text.
		</div>
	</div>
	<div className="event" style={{left:"35%"}}>
		EVENT 2
		<div className="eventBodyText">
			This is some example body text.
		</div>
	</div>
	<div className="event" style={{left:"68%"}}>
		EVENT 3
		<div className="eventBodyText">
			This is some example body text.
		</div>
	</div>
  </div>
  );
}

export default App;
