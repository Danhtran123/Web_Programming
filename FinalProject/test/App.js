import React from 'react';
import './App.css';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";
import {useForm} from "react-hook-form";
export default function App() {
	return (
		<Router>
			<div className="bodyContainer">
				<Link to="/home" className="newEventButton" style={{right:"25%"}}>Home Page</Link>
				<Link to="/newevent" className="newEventButton" style={{right:"10%"}}>Create a New Event</Link>
				<Switch>
					<Route path="/home">
						<HomePage />
					</Route>
					<Route path="/newevent">
						<EventForm />
					</Route>
				</Switch>
			</div>
		</Router>
	);
}
function HomePage() {
	return (
		<div>
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
function EventForm() {
	const{register,handleSubmit}=useForm();
	const onSubmit=data=>console.log(data);
	return (
		<form onSubmit={handleSubmit(onSubmit)}>
			<label>
				<p>Event Name:</p>
				<p><input ref={register} name="eventName" type="text" className="inputBox"/></p>
			</label>
			<label>
				<p>Event Description:</p>
				<p><input ref={register} name="description" type="text" className="inputBox" style={{height:"2.5cm"}}/></p>
			</label>
			<label>
				<p>Start Date:</p>
				<p><input ref={register} name="startdate" type="date" className="inputBox"/></p>
			</label>
			<label>
				<p>End Date:</p>
				<p><input ref={register} name="enddate" type="date" className="inputBox"/></p>
			</label>
			<label>
				<p>Upload Attendance File:</p>
				<p><input ref={register} type="file" name="attendancefile"/></p>
			</label>
			<input type="submit" className="submitButton"/>
		</form>
	);
}