document.addEventListener("DOMContentLoaded", function () {
  const welcomeScreen = document.getElementById("welcome-screen");
  const usernameInput = document.getElementById("username");
  const timeDisplay = document.getElementById("time-display");
  const scoreDisplay = document.getElementById("score-display");
  const usernameDisplay = document.getElementById("username-display");
  const countdownScreen = document.getElementById("countdown-screen");
  const selectLevel = document.getElementById("select-level");
  const gunSkinRadio = document.getElementsByName("gunskin");
  const targetSkinRadio = document.getElementsByName("target");
  const gunElement = document.getElementById("gun");
  const playButton = document.getElementById("play-game");
  const instructionButton = document.getElementById("instruction");
  const instructionDisplay = document.getElementById("instruction-display");
  const instructionCloseButton = document.getElementById("close-instruction");
  const gameDisplay = document.getElementById("game-display");
  const gameArea = document.getElementById("game-area");
  const pausePopup = document.getElementById("pause-popup");
  const pauseContinueButton = document.getElementById("continue");
  const pauseRestartButton = document.getElementById("restart");
  const countdownNumber = document.getElementById("countdown-number");
  const afterMatchDisplay = document.getElementById("after-match");
  const usernameAfterMatch = document.getElementById("username-after-match");
  const scoreAfterMatch = document.getElementById("score-after-match");
  const restarAfterMatch = document.getElementById("restart-after-match");
  const saveMatchAfterMatch = document.getElementById("savematch-after-match");

  let level = "easy";
  let timerDuration = 30;
  let gunSkin = "gun1";
  let targetSkin = "target1";
  let gameTimer;
  let pause = false;
  let timeRemaining;
  let score = 0;
  let gameInterval;

  usernameInput.addEventListener("input", function () {
    usernameDisplay.textContent = usernameInput.value;
    playButton.disabled = usernameInput.value.trim() === "";
  });

  selectLevel.addEventListener("change", function () {
    level = this.value;
    switch (level) {
      case "easy":
        timerDuration = 30;
        break;
      case "normal":
        timerDuration = 20;
        break;
      case "hard":
        timerDuration = 10;
        break;
      default:
        timerDuration = 30;
        break;
    }
  });

  gunSkinRadio.forEach((radio) => {
    radio.addEventListener("change", function () {
      if (this.checked) {
        gunSkin = this.value;
        gunElement.src = `./Sprites/${gunSkin}.png`;
      }
    });
  });

  targetSkinRadio.forEach((radio) => {
    radio.addEventListener("change", function () {
      if (this.checked) {
        targetSkin = this.value;
      }
    });
  });

  instructionButton.addEventListener("click", function () {
    instructionDisplay.style.display = "block";
  });

  instructionCloseButton.addEventListener("click", function () {
    instructionDisplay.style.display = "none";
  });

  playButton.addEventListener("click", function () {
    welcomeScreen.style.display = "none";
    countdownScreen.style.display = "block";

    let countdown = 3;
    countdownNumber.textContent = countdown;

    const countdownInterval = setInterval(function () {
      countdown--;
      countdownNumber.textContent = countdown;

      if (countdown === 0) {
        clearInterval(countdownInterval);
        countdownScreen.style.display = "none";
        startGame();
      }
    }, 1000);
  });


  // additional
  saveMatchAfterMatch.addEventListener("click", function () {
    afterMatchDisplay.style.display = 'none'
    gameDisplay.style.display = "none";
    pausePopup.style.display = "none";
    welcomeScreen.style.display = "block";
  });

  restarAfterMatch.addEventListener("click", function () {
    gameDisplay.style.display = "none";
    afterMatchDisplay.style.display = "none";
    countdownScreen.style.display = "block";

    let countdown = 3;
    countdownNumber.textContent = `Game start in : ${countdown}`;

    const countdownInterval = setInterval(function () {
      countdown--;
      countdownNumber.textContent = `Game start in : ${countdown}`;

      if (countdown === 0) {
        clearInterval(countdownInterval);
        countdownScreen.style.display = "none";
        startGame();
      }
    }, 1000);
  });

  pauseRestartButton.addEventListener("click", function () {
    gameDisplay.style.display = "none";
    pausePopup.style.display = "none";
    welcomeScreen.style.display = "block";
  });

  function startGame() {
    gameDisplay.style.display = "block";
    score = 0;
    updateScore();

    timeRemaining = timerDuration;
    gameTimer = setInterval(function () {
      timeRemaining--;
      timeDisplay.textContent = `Time:${timeRemaining}s`;
      if (timeRemaining <= 0) {
        clearInterval(gameTimer);
        endGame();
      }
    }, 1000);
    gameInterval = setInterval(spawnTarget, 3000);
  }

  function pauseGame() {
    clearInterval(gameTimer);
    clearInterval(gameInterval);
    pause = true;
    pausePopup.style.display = "block";
  }

  function resumeGame() {
    pausePopup.style.display = "none";
    countdownScreen.style.display = "block";

    let countdown = 3;
    countdownNumber.textContent = `Game start in : ${countdown}`;

    const countdownInterval = setInterval(function () {
      countdown--;
      countdownNumber.textContent = `Game start in : ${countdown}`;

      if (countdown === 0) {
        clearInterval(countdownInterval);
        countdownScreen.style.display = "none";
        pause = false;
        gameTimer = setInterval(function () {
          timeRemaining--;
          timeDisplay.textContent = `Time:${timeRemaining}s`;
          if (timeRemaining === 0) {
            clearInterval(gameTimer);
            endGame();
          }
        }, 1000);
      }
    }, 1000);
  }

  function endGame() {
    clearInterval(gameInterval);
    gameDisplay.style.display = "none";
    afterMatchDisplay.style.display = "block";
    usernameAfterMatch.textContent = `Username: ${usernameInput.value}`;
    scoreAfterMatch.textContent = `Score: ${score}`;
    document.removeEventListener("click", shoot);
  }

  pauseContinueButton.addEventListener("click", function () {
    resumeGame();
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      if (!pause) {
        pauseGame();
      } else {
        resumeGame();
      }
    }
  });



  function spawnTarget() {
    const target = document.createElement("img");
    target.src = `./Sprites/${targetSkin}.png`;
    target.classList.add("target");
    target.style.position = "absolute";

     const gameArea = document.getElementById('game-area');
     const gameAreaRect = gameArea.getBoundingClientRect();
    const maxY = gameAreaRect.width - 50;
    const maxX = gameAreaRect.width - 50;
    const randomX  = Math.floor(Math.random() * maxX)
    const randomY  = Math.floor(Math.random() * maxY)

    target.style.left = `${randomY}px`
    target.style.left = `${randomX}px`

    gameArea.appendChild(target);
    

    target.addEventListener('click', function(){
        targetHit(target)
    })
   }

   function targetHit(target){
    score++;
    updateScore()
    target.remove();
   }

   function updateScore(){
    scoreDisplay.textContent = `Score: ${score}`
   }


   function shoot(event) {
    if(!event.target.classList.contains('target')){
        timeRemaining = timeRemaining - 5
        updateTime()
    }
   }

   function updateTime() {
    timeDisplay.textContent = `Time: ${timeRemaining}`
   }

   gameArea.addEventListener('click', shoot)


});
