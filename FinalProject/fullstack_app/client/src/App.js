// /client/App.js
import React, { Component } from 'react';
import axios from 'axios';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  Redirect
} from "react-router-dom";
import {useForm} from "react-hook-form";
import './App.css';
var parseXls = require('./ParseXls.js');

class App extends Component {
  // initialize our state
  state = {
    data: [],
	eventName: null,
	description: null,
	startdate: null,
	enddate: null,
    intervalIsSet: false,
    idToDelete: null,
    idToUpdate: null,
    objectToUpdate: null,
	redirect: false
  };

  // when component mounts, first thing it does is fetch all existing data in our db
  // then we incorporate a polling logic so that we can easily see if our db has
  // changed and implement those changes into our UI
  componentDidMount() {
    this.getDataFromDb();
    if (!this.state.intervalIsSet) {
      let interval = setInterval(this.getDataFromDb, 1000);
      this.setState({ intervalIsSet: interval });
    }
  }

  // never let a process live forever
  // always kill a process everytime we are done using it
  componentWillUnmount() {
    if (this.state.intervalIsSet) {
      clearInterval(this.state.intervalIsSet);
      this.setState({ intervalIsSet: null });
    }
  }

  // our first get method that uses our backend api to
  // fetch data from our data base
  getDataFromDb = () => {
    fetch('http://localhost:3001/api/getData')
      .then((data) => data.json())
      .then((res) => this.setState({ data: res.data }));
  };

  // our update method that uses our backend api
  // to overwrite existing data base information
  updateDB = (idToUpdate, updateToApply) => {
    let objIdToUpdate = null;
    parseInt(idToUpdate);
    this.state.data.forEach((dat) => {
      if (dat.id == idToUpdate) {
        objIdToUpdate = dat._id;
      }
    });

    axios.post('http://localhost:3001/api/updateData', {
      id: objIdToUpdate,
      update: { message: updateToApply },
    });
  };

  render(){
	   const { data } = this.state;
        return (
            <Router>
					<div className="buttonContainer">
                    <Link to="/home" className="newEventButton" style={{right:"25%"}}>Home Page</Link>
                    <Link to="/newevent" className="newEventButton" style={{right:"10%"}}>Create a New Event</Link>
					</div>
					<div className="bodyContainer">
                    <Switch>
                        <Route path="/home">
							{data.length <= 0 ? 'NO DB ENTRIES YET' : data.map((dat) => (
								<div className="event">{dat.eventName}
								<div className="eventBodyText">{dat.description}
								</div>
								</div>
							))}
                        </Route>
                        <Route path="/newevent">
                            <EventForm />
                        </Route>
                    </Switch>
                </div>
            </Router>
        );
    }

}

function EventForm() {
	const{register,handleSubmit}=useForm();
	const onSubmit=data=>putDataToDB(data);
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
				<input ref={register} type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="file" />
			</label>

			<input type="submit" className="submitButton"/>
		</form>
		
	);
}

//sends a post request to the database to insert event page information which is grabbed from the form.
function putDataToDB (message) {
	//var tempVar = new parseXls(message.file[0]);
	//console.log(tempVar.getContents());
	console.log(message.file[0]);
	var student = [{"pantherid": "002142636",
                    "firstname": "Harry",
                    "lastname": "Potter",
                    "department": "Computer Science",
                    "level": "Graduate",
					"campus": "Main Campus",
					"degree": "Masters",
					"email": "hpotter1@gsu.edu",
					"college": "College of Arts and Sciences",
					"year": "2020"}];
	student[1] = {"pantherid": "002142876",
                    "firstname": "Arya",
                    "lastname": "Stark",
                    "department": "Biology",
                    "level": "Graduate",
					"campus": "Main Campus",
					"degree": "Doctorate",
					"email": "astark1@gsu.edu",
					"college": "School of Public Health",
					"year": "2020"};
	student[2] = {"type": "number",
                    "pantherid": "filepantherid2",
                    "description": "total number",
                    "placeholder": "0",
                    "className": "form-control",
                    "name": "number - 1500374279764"};
        console.log("test");
		console.log(student);
    axios.post('http://localhost:3001/api/putEvent', {
	  eventName: message.eventName,
	  description: message.description,
	  startdate: message.startdate,
	  enddate: message.enddate,
	  student: student,
	  
    });
	console.log("Placing in EventCollection...");
	console.log(message.eventName);
	console.log(message.startdate);
	console.log(message.description);
	console.log(message);
};
//sends a post request to the database to insert the studentInformation which is grabbed from excel/csv files
function putStudentInfoToDB (message) {
	
	axios.post('http://localhost:3001/api/putStudent', {
		pantherid: message.pantherid,
		firstname: message.firstname,
		lastname: message.lastname,
		department: message.department,
		level: message.level,
		campus: message.campus,
		degree: message.degree,
		email: message.email,
		college: message.college,
		year: message.year,
		checkin: false,
	});
	console.log("Placing in StudentCollection");
	console.log(message.pantherid);
}

export default App;