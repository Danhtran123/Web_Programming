import React from 'react';
import './App.css';

class eventForm extends React.Component {
  constructor(props) {
	  super(props);
	  this.state = 
	  {
		eventname: '',
		description: '',
		startdate: '01/01/2000',
		enddate: '01/01/2000'
	  };
  }
  nameHandler = (event) => {
	  this.setState({eventname: event.target.value});
  }
  descriptionHandler = (event) => {
	  this.setState({description: event.target.value});
  }
  startDateHandler = (event) => {
	  this.setState({startdate: event.target.value});
  }
  endDateHandler = (event) => {
	  this.setState({enddate: event.target.value});
  }
  submitHandler = (event) => {
	  event.preventDefault();
	  // Access the uploaded file with this.fileInput.current.files[0]
	  // Use this part to write the values into the database
  }
  render() {
	return (
		<form onSubmit={this.submitHandler}>
			<label>
				Event Name:
				<input type="text" onChange={this.nameHandler}/>
			</label>
			<label>
				Event Description:
				<input type="text" onChange={this.descriptionHandler}/>
			</label>
			<label>
				Start Date:
				<input type="date" onChange={this.startDateHandler}/>
			</label>
			<label>
				End Date:
				<input type="date" onChange={this.endDateHandler}/>
			</label>
			<label>
				Upload Attendance File:
				<input type="file" ref={this.fileInput}/>
			</label>
			<input type="submit">
		</form>
	);
  }
}
ReactDOM.render(<eventForm />, document.getElementById('root'));