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

  // just a note, here, in the front end, we use the id key of our data object
  // in order to identify which we want to Update or delete.
  // for our back end, we use the object id assigned by MongoDB to modify
  // data base entries

  // our first get method that uses our backend api to
  // fetch data from our data base
  getDataFromDb = () => {
    fetch('http://localhost:3001/api/getData')
      .then((data) => data.json())
      .then((res) => this.setState({ data: res.data }));
	  
  };

  // our delete method that uses our backend api
  // to remove existing database information
  deleteFromDB = (idTodelete) => {
    parseInt(idTodelete);
    let objIdToDelete = null;
    this.state.data.forEach((dat) => {
      if (dat.id == idTodelete) {
        objIdToDelete = dat._id;
      }
    });

    axios.delete('http://localhost:3001/api/deleteData', {
      data: {
        id: objIdToDelete,
      },
    });
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
  
  setRedirect = () => {
	  this.setState({
		  redirect: true
	  })
  }
  renderRedirect = () => {
	  if (this.state.redirect){
		  return <Redirect to='/eventpage' />
	  }
  }

  // here is our UI
  // it is easy to understand their functions when you
  // see them render into our screen
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
						<Route path="/eventpage">
							<div className="studentrow">
							
							</div>
						</Route>
                    </Switch>
                </div>
            </Router>
        );
    }
  
  
 /*
  render() {
    const { data } = this.state;
    return (
      <div>
	  //database listing; if data.length is less than 0 no entries, else display data.message, dat.id/dat.messsage which are the databse names
        <ul>
          {data.length <= 0
            ? 'NO DB ENTRIES YET'
            : data.map((dat) => (
                <li style={{ padding: '10px' }} key={data.message}>
                  <span style={{ color: 'gray' }}> id: </span> {dat.id} <br />
                  <span style={{ color: 'gray' }}> data: </span>
                  {dat.message}
                </li>
              ))}
        </ul>
		//add
        <div style={{ padding: '10px' }}>
          <input
            type="text"
            onChange={(e) => this.setState({ message: e.target.value, name: 5 })}
            placeholder="add something in the database"
            style={{ width: '200px' }}
          />
          <button onClick={() => this.putDataToDB(this.state.message)}>
            ADD
          </button>
        </div>
		//delete
        <div style={{ padding: '10px' }}>
          <input
            type="text"
            style={{ width: '200px' }}
            onChange={(e) => this.setState({ idToDelete: e.target.value })}
            placeholder="put id of item to delete here"
          />
          <button onClick={() => this.deleteFromDB(this.state.idToDelete)}>
            DELETE
          </button>
        </div>
		//update
        <div style={{ padding: '10px' }}>
          <input
            type="text"
            style={{ width: '200px' }}
            onChange={(e) => this.setState({ idToUpdate: e.target.value })}
            placeholder="id of item to update here"
          />
          <input
            type="text"
            style={{ width: '200px' }}
            onChange={(e) => this.setState({ updateToApply: e.target.value })}
            placeholder="put new value of the item here"
          />
          <button
            onClick={() =>
              this.updateDB(this.state.idToUpdate, this.state.updateToApply)
            }
          >
            UPDATE
          </button>
        </div>
      </div>
    );
  }
 */
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

			<input type="submit" className="submitButton"/>
		</form>
	);
}

//sends a post request to the database to insert event page information which is grabbed from the form.
function putDataToDB (message) {

    axios.post('http://localhost:3001/api/putEvent', {
	  eventName: message.eventName,
	  description: message.description,
	  startdate: message.startdate,
	  enddate: message.enddate,
	  
    });
	console.log("Placing in EventCollection...");
	console.log(message.eventName);
	console.log(message.startdate);
	console.log(message.description);
	console.log(message);
	{this.renderRedirect()}
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
	});
	console.log("Placing in StudentCollection");
	console.log(message.pantherid);
}

export default App;