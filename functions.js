window.onload = game;

//variables
var timer, time;

//keep track if the game is over
var gameOver = false;

//start & end buttons
var startButton = document.getElementById("startGameButton");
var endButton = document.getElementById("endGameButton");




function game() {
    //hide words
    $(".fiveWords").hide();
}

function startGame() {
    //show the words
    $(".fiveWords").show();
    //make button opaque
    document.getElementById("startGameButton").style.opacity = .4;
    //disable start game
    startButton.disabled = true;
    //make button opaque
    document.getElementById("endGameButton").style.opacity = 1;
    //enable the end button
    endButton.disabled = false;

    //display the text
    $(".fiveWords").html("text");
    
    //start the timer
    startTimer();
}

function endGame() {
    //hide words
    $(".fiveWords").hide();
    //rid of opacity for start game button
    document.getElementById("startGameButton").style.opacity = 1;
    //enable start button
    startButton.disabled = false;
    //make button opaque for end game
    document.getElementById("endGameButton").style.opacity = .4;
    //disable the end button
    endButton.disabled = true;
    
    //stop the timer
    clearInterval(timer);
}

function startTimer() {
    //Reset timer back to 60 seconds
    time = 0;

    //Every 100ms the timer gets updated
    timer = setInterval(function () {
    if (gameOver == true) {
        endGame();
    }
        time += 0.01;
    //time = time -+ 0.1;
    $("#timer").html("<strong>"+time.toFixed(2)+"</strong>")
  },10);

}




function myMove() {
  var elem1 = document.getElementById("myAnimation1");
  var elem2 = document.getElementById("myAnimation2");
  var elem3 = document.getElementById("myAnimation3");
  var elem4 = document.getElementById("myAnimation4");
  var elem5 = document.getElementById("myAnimation5");


    
  var pos = 0;
  var id = setInterval(frame, 10);
  function frame() {
    if (pos == 350) {
      clearInterval(id);
    } else {
      pos++;
      elem1.style.bottom = pos + 'px';
      elem2.style.bottom = pos + 'px';
      elem3.style.bottom = pos + 'px';
      elem4.style.bottom = pos + 'px';
      elem5.style.bottom = pos + 'px';

      //elem.style.left = pos + 'px';
    }
  }
}



