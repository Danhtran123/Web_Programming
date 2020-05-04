// /backend/data.js
const mongoose = require("mongoose");
const Schema = mongoose.Schema;

// this will be our data base's data structure 
const DataSchema = new Schema(
  {
	pantherid: { type: Number, required: true, unique: true },
	firstname: String,
	lastname: String,
	department: String,
	level: String,
	campus: String,
	degree: String,
	email: String,
	college: String,
	year: Number,
	checkin: Boolean
	
  },
  { timestamps: true }
);

// export the new Schema so we could modify it using Node.js
module.exports = mongoose.model("studentinfo", DataSchema);