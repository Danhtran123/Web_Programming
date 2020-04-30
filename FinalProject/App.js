import React from 'react';
import './App.css';

function App() {
  return (
  <div>
    <button className="newEventButton">Create a New Event</button>
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
