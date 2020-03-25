var guessLimit = 10;
var time = 0;
var randomNumber = Math.floor(Math.random()*100)+1;
document.getElementById("guesses").innerHTML = "Guesses left: " + guessLimit;
var winSound;
var wrongSound;

startGame();

function startGame(){
	winSound = new sound("win.mp3");
	wrongSound = new sound("wrong.mp3");
}

function guess(){
	var value = document.getElementById("value").value
	if(value == randomNumber){
		winSound.play();
		alert("You are correct! Restarting!");
		time = 0;
		guessLimit = 10;
		randomNumber = Math.floor(Math.random()*100)+1;
		document.getElementById("guesses").innerHTML = "Guesses left: " + guessLimit;
	}	
	else{
		console.log(guessLimit);
		guessLimit--;
		console.log(randomNumber);
		if(guessLimit == 0){
			alert("You've ran out of guesses! The secret number was " + randomNumber + ". Restarting!");
			time = 0;
			guessLimit = 10;
			randomNumber = Math.floor(Math.random()*100)+1;
			document.getElementById("guesses").innerHTML = "Guesses left: " + guessLimit;
		}
		else if(value < randomNumber){
			document.getElementById("report").innerHTML = "The number is higher!"
			wrongSound.play();
		}
		else if(value > randomNumber){
			document.getElementById("report").innerHTML = "The number is lower!"
			wrongSound.play();
		}
		document.getElementById("guesses").innerHTML = "Guesses left: " + guessLimit;
	}
}

setInterval(function(){ time++; document.getElementById("timer").innerHTML = "Timer: " +  time; }, 1000);

function sound(src) {
  this.sound = document.createElement("audio");
  this.sound.src = src;
  this.sound.setAttribute("preload", "auto");
  this.sound.setAttribute("controls", "none");
  this.sound.style.display = "none";
  document.body.appendChild(this.sound);
  this.play = function(){
    this.sound.play();
  }
  this.stop = function(){
    this.sound.pause();
  }
} 