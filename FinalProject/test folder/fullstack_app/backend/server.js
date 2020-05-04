const mongoose = require('mongoose');
const express = require('express');
var cors = require('cors');
const bodyParser = require('body-parser');
const logger = require('morgan');
const Data = require('./data');
const studentInfo = require('./studentInfo');

const API_PORT = 3001;
const app = express();
app.use(cors());
const router = express.Router();

// this is our MongoDB database
const dbRoute ="mongodb+srv://dtran54:Kappa54321@cluster0-soaxy.mongodb.net/FinalProj";

// connects our back end code with the database
mongoose.connect(dbRoute, { useNewUrlParser: true });

let db = mongoose.connection;

db.once('open', () => console.log('connected to the database'));

// checks if connection with the database is successful
db.on('error', console.error.bind(console, 'MongoDB connection error:'));

// (optional) only made for logging and
// bodyParser, parses the request body to be a readable json format
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(logger('dev'));

// this is our get method
// this method fetches all available data in our database
router.get('/getData', (req, res) => {
  Data.find((err, data) => {
    if (err) return res.json({ success: false, error: err });
    return res.json({ success: true, data: data });
  });
});

// this is our update method
// this method overwrites existing data in our database
router.post('/updateData', (req, res) => {
  const { id, update } = req.body;
  Data.findByIdAndUpdate(id, update, (err) => {
    if (err) return res.json({ success: false, error: err });
    return res.json({ success: true });
  });
});

// this is our delete method
// this method removes existing data in our database
router.delete('/deleteData', (req, res) => {
  const { id } = req.body;
  Data.findByIdAndRemove(id, (err) => {
    if (err) return res.send(err);
    return res.json({ success: true });
  });
});

/*
// this is our create methid
// this method adds new data in our database
router.post('/putData', (req, res) => {
  let data = new Data();

  const { id, message, name } = req.body;

  if ((!id && id !== 0) || !message) {
    return res.json({
      success: false,
      error: 'INVALID INPUTS',
    });
  }
  data.message = message;
  data.id = id;
  data.name = name;
  data.save((err) => {
    if (err) return res.json({ success: false, error: err });
    return res.json({ success: true });
  });
});
*/

router.post('/putEvent', (req, res) => {
  let data = new Data();
  const { eventName, description, startdate, enddate } = req.body;

  if (!eventName) {
    return res.json({
      success: false,
      error: 'INVALID INPUTS',
    });
  }
  data.eventName = eventName;
  data.description = description;
  data.startdate = startdate;
  data.enddate = enddate;
  data.save((err) => {
    if (err) return res.json({ success: false, error: err });
    return res.json({ success: true });
  });
});

router.post('/putStudent', (req, res) => {
	let studentInfo = new studentInfo();
	const { pantherid, firstname, lastname, department, level, campus, degree, email, college, year } = req.body;
	
	if(!pantherid) {
		return res.json({
			success: false,
			error: 'INVALID INPUTS',
		});
	}
	studentInfo.pantherid = pantherid;
	studentInfo.firstname = firstname;
	studentInfo.lastname = lastname;
	studentInfo.department = department;
	studentInfo.level = level;
	studentInfo.campus = campus;
	studentInfo.degree = degree;
	studentInfo.email = email;
	studentInfo.college = college;
	studentInfo.year = year;
	studentInfo.save((err) => {
		if (err) return res.json({ success: false, error: err});
		return res.json({ success: true });
	});
});

router.get('/getStudent', (req, res) => {
  studentInfo.find((err, data) => {
    if (err) return res.json({ success: false, error: err });
    return res.json({ success: true, data: data });
  });
});

// append /api for our http requests
app.use('/api', router);

// launch our backend into a port
app.listen(API_PORT, () => console.log(`LISTENING ON PORT ${API_PORT}`));