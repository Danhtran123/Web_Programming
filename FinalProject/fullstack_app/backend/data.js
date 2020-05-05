// /backend/data.js
const mongoose = require("mongoose");
const Schema = mongoose.Schema;

// this will be our data base's data structure 
const DataSchema = new Schema(
  {
	eventName: { type: String, required: true },
	description: String,
	startdate: Date,
	enddate: Date,
	student: Array
  },
  
 
  
  
  
  
  { timestamps: true }
);

// export the new Schema so we could modify it using Node.js
module.exports = mongoose.model("eventinfo", DataSchema);