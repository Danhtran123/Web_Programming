var count = 0;
var input = 0;
var array = [];
var hourlyPayment = 15;

while(Math.sign(input) != -1){
	input = prompt("How many hours did this employee" + count + "work?");
	input = parseInt(input);
	if(isNaN(input)){
		alert("This is not a number!");
		continue;
	}
	drawTable();
	array[count] = input;
	count++;
}

function pay(hours){
	let paid = 0;
	let overtimeHours = 0;
	let overtimePayRatio = 1.5;
	if(hours > 40){
		overtimeHours = hours-40;
		paid += overtimeHours*overtimePayRatio*hourlyPayment;
	}	
	hours -= overtimeHours;
	paid += hours*hourlyPayment;
	return paid;
}

function drawTable(){
	if(Math.sign(input) == -1){
		var table = document.getElementById("table");
		let row;
		let cell1;
		let cell2;
		let cell3;
		let totalPay = 0;
		for(i=0; i<array.length; i++){
			row = table.insertRow(-1);
			cell1 = row.insertCell(0);
			cell2 = row.insertCell(1);
			cell3 = row.insertCell(2);
			cell1.innerHTML = i+1;
			cell2.innerHTML = array[i];
			cell3.innerHTML = pay(array[i]);
			totalPay += pay(array[i]);
		}
		row = table.insertRow(-1);
		cell1 = row.insertCell(0);
		cell2 = row.insertCell(1);
		cell1.colSpan = 2;
		cell1.innerHTML = "Total Pay:"
		cell2.innerHTML = totalPay;
	}
}
