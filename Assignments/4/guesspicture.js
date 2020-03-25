const array = [
{
	name: 'one',
	img: 'img/1.png',
},
{
	name: 'two',
	img: 'img/2.png',
},
{
	name: 'three',
	img: 'img/3.png',
},
{
	name: 'four',
	img: 'img/4.png',
},
{
	name: 'five',
	img: 'img/5.png',
},
{
	name: 'six',
	img: 'img/6.png',
},
]

const game = document.getElementById('game')
const grid = document.createElement('section')
let firstGuess = ''
let secondGuess = ''
let previousTarget = null
let count = 0
let delay = 1200
grid.setAttribute('class','grid')
grid.setAttribute('id','grid')
game.appendChild(grid)
let tileAmt = 0;
let timer = 0;
let tileLook = 0;
let time = 0;
let active = false
let matchCounter = 0;
let clickable = false
var x = document.getElementsByClassName("difficulty")

//function to bring everything back to start screen status
function gameOver(){
	active = false;
	time = 0;
	matchCounter = 0;
	for(i=0; i<x.length; i++){
		x[i].style.visibility="visible"
	}
	document.getElementById("grid").innerHTML = "";
	document.getElementById("timer").innerHTML = "";
	clickable = false;
}

setInterval(function(){
	if(active){
		time++;
		document.getElementById("timer").innerHTML = "Timer: " +  time; 
	}
	if(active && time == maxTime){
		alert("You ran out of time!")
		gameOver();
	}
}, 1000)

//hide difficulty html buttons and assign difficulty variables for game.
function buttonClick(difficulty){
	document.getElementById("timer").innerHTML = "Timer: " +  time; 
	
	for(i=0; i<x.length; i++){
		x[i].style.visibility="hidden"
	}

	if(difficulty == "easy"){
		tileAmt = 4
		tileLook = 3000
		maxTime = 120
	}
	else if(difficulty == "normal"){
		tileAmt = 5
		tileLook = 5000
		maxTime = 150
	}
	else if(difficulty == "hard"){
		tileAmt = 6
		tileLook = 8000
		maxTime = 180
	}
	active = true
	gameStart()
}

function gameStart(){
	let arrayHold = []
	for(i=0; i<tileAmt; i++){
		arrayHold[i] = array[i]
	}
	//copy the array
	let gameGrid = arrayHold.concat(arrayHold)
	//randomize the array
	gameGrid.sort(() => 0.5 - Math.random())
	
	//each card we add a front and back
	for(i=0; i<tileAmt*2; i++){
		const card = document.createElement('div')
		card.classList.add('card')
		card.dataset.name = gameGrid[i].name
		
		const front = document.createElement('div')
		front.classList.add('front')
		
		const back = document.createElement('div')
		back.classList.add('back')
		
		back.style.backgroundImage = `url(${gameGrid[i].img})`
		grid.appendChild(card)
		card.appendChild(back)
		//allow players to see cards first before it is hidden
		setTimeout(function(){
			card.appendChild(front)
			var y = document.getElementsByClassName("back")
			for(i=0; i<y.length; i++){
				y[i].style.transform = "rotateY(180deg)";
			}
			clickable = true;
		},tileLook)
	}


}

//for all which has the class selected, assign match class if matched
const match = () => {
	var selected = document.querySelectorAll('.selected')
	selected.forEach(card => {
		card.classList.add('match')
	})
}

//failed match resets variables
const resetCount = () => {
	firstGuess = ''
	secondGuess = ''
	count = 0
	previousTarget = null
	
	var selected = document.querySelectorAll('.selected')
	selected.forEach(card => {
		card.classList.remove('selected')
	})
}

grid.addEventListener('click', function(event){
	if(clickable){
	let clicked = event.target
	if(clicked.nodeName === 'SECTION' || clicked === previousTarget || clicked.parentNode.classList.contains('selected') || clicked.parentNode.classList.contains('match')){
		return
	}
	if(count < 2){
		count++
		if(count === 1){
			firstGuess = clicked.parentNode.dataset.name
			clicked.parentNode.classList.add('selected')
		} else {
			secondGuess = clicked.parentNode.dataset.name
			clicked.parentNode.classList.add('selected')
		}
		//safe check since first/secondGuess are defaulted to ''
		if(firstGuess !== '' && secondGuess !== ''){
			if(firstGuess === secondGuess){
				matchCounter++;
				setTimeout(match,delay)
				setTimeout(resetCount,delay)
				setTimeout(function(){
					if(matchCounter == tileAmt){
						alert("You win!")
						gameOver()
					}
				},delay)
			} else {
				setTimeout(resetCount,delay)
			}
		}
		previousTarget = clicked
	}}
})
