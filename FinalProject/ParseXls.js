var xlsx = require('node-xlsx');
var fs = require('fs');

module.exports = function(file) {
	var rows = [];
	var obj = xlsx.parse(file);
	for(var i = 0; i < obj.length; i++)
	{
		var sheet = obj[i];
		for(var j = 0; j < sheet['data'].length; j++)
		{
			rows.push(sheet['data'][j]);
		}
	}
	this.getContents = function() {
		return rows;
	}
};