var xlsx = require('node-xlsx');
var fs = require('fs');
var obj = xlsx.parse(__dirname + '/test.xlsx'); // parses a file
var rows = [];
var writeStr = "";


//looping through all sheets
for(var i = 0; i < obj.length; i++)
{
    var sheet = obj[i];
	console.log("Sheet: " + i);
    //loop through all rows in the sheet
    for(var j = 0; j < sheet['data'].length; j++)
    {
            //add the row to the rows array
			rows.push(sheet['data'][j]);
			console.log(sheet['data'][j]);
    }
}
// here rows is an array that contains the parsed contents of the file as an array, so you can use it to access the 
// individual parts of the file
 
//creates the csv string to write it to a file
for(var i = 0; i < rows.length; i++)
{
    writeStr += rows[i].join(",") + "\n";
}

//writes to a file, but you will presumably send the csv as a      
//response instead
fs.writeFile(__dirname + "/test.csv", writeStr, function(err) {
    if(err) {
        return console.log(err);
    }
    console.log("test.csv was saved in the current directory!");
});