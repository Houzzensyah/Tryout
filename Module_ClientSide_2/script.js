document.addEventListener("DOMContentLoaded", function () {
   //all dom variable
   const usernameInput = document.getElementById('username');
   const welcomeScreen = document.getElementById('welcome-screen');
   const playButton = document.getElementById('play-game')
   const selectLevel =document.getElementById('select-level');
   const gunSelect = document.getElementById('gun-select');
   const gunSkinRadio = document.getElementsByName('gunskin');
   const targetSkinRadio = document.getElementsByName('target')
   const instructionButton = document.getElementById('instruction');
   const countdownScreen = document.getElementById('countdown-screen');
   const countdownNumber = document.getElementById('countdown-number');
   const instructionScreen = document.getElementById('instruction-display');
   const closeInstruction = document.getElementById('close-instruction');
   const gameScreen = document.getElementById('game-display');
   const gameArea = document.getElementById('game-area');
   const usernameDisplay = document.getElementById('username-display');
   const scoreDisplay = document.getElementById('score-display');
   const timeDisplay = document.getElementById('time-display');
   const gunElement = document.getElementById('gun');
   const pauseScreen = document.getElementById('pause-popup');
   const continueButton = document.getElementById('continue');
   const restartButton = document.getElementById('restart');
   const afterMatchScreen = document.getElementById('after-match');
   const usernameAfterMatch = document.getElementById('username-after-match');
   const scoreAfterMatch = document.getElementById('score-after-match');
   const restartMatch = document.getElementById('restart-after-match');
   const saveMatch = document.getElementById('savematch-after-match');
   const leaderboard = document.getElementById('leaderboard')

   let pause = false;
   let level = 'easy';
   let timeDuration = 30;
   let gunSkin = 'gun1';
   let targetSkin = 'target1';
   let timeRemaining;
   let score = 0;

   //welcome screen data
   usernameInput.addEventListener('input', function () {
      playButton.disabled = usernameInput.value.trim() === '';
      usernameDisplay.textContent = usernameInput.value
   });

   selectLevel.addEventListener('change', function () {
         level = this.value
         switch (level) {
            case 'easy' : timeDuration = 30
                 break
            case 'medium' : timeDuration = 20
                 break
            case 'hard' : timeDuration = 15
                 break
            default : timeDuration = 30
                 break

         }

   })

   gunSkinRadio.forEach(radio => {
      radio.addEventListener('change', function () {
         if (this.checked) {
            gunSkin = this.value
            gunElement.src = `./Sprites/${gunSkin}.png`
         }
      })
   })

   targetSkinRadio.forEach(radio => {
      radio.addEventListener('change', function () {
         if(this.checked){
            targetSkin = this.value
         }
      })
   })

   instructionButton.addEventListener('click', function () {
      instructionScreen.style.display = 'block'
   })
   closeInstruction.addEventListener('click', function () {
      instructionScreen.style.display = 'none'
   })

   restartButton.addEventListener("click", function () {
      gameScreen.style.display = "none";
      pauseScreen.style.display = "none";
      leaderboard.style.display = 'none'
      welcomeScreen.style.display = "block";
   });

   playButton.addEventListener("click", function () {
      welcomeScreen.style.display = "none";
      countdownScreen.style.display = "block";
      instructionScreen.style.display = 'none'

      let countdown = 3;
      countdownNumber.textContent =`Game Start in : ${countdown}`;

      const countdownInterval = setInterval(function () {
         countdown--;
         countdownNumber.textContent = `Game Start in : ${countdown}`;

         if (countdown === 0) {
            clearInterval(countdownInterval);
            countdownScreen.style.display = "none";
            playGame();
         }
      }, 1000);
   });




   //game function
   function playGame() {
      leaderboard.style.display = 'block'
      gameScreen.style.display = "block";
      countdownScreen.style.display = 'none'
      score = 0;
      updateScore();

      timeRemaining = timeDuration;
      gameTimer = setInterval(function () {
         timeRemaining--;
         timeDisplay.textContent = `Time:${timeRemaining}s`;
         if (timeRemaining <= 0) {
            clearInterval(gameTimer);
            endGame();
         }
      }, 1000);
      spawnTarget();
      spawnTarget();
      spawnTarget();
      gameInterval = setInterval(spawnTarget, 3000);
   }

   function pauseGame() {
      clearInterval(gameInterval)
      clearInterval(gameTimer)
      pause = true
      pauseScreen.style.display = 'block'
   }


   function resumeGame() {
      pauseScreen.style.display = "none";
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
            gameInterval = setInterval(spawnTarget, 3000);
         }
      }, 1000);
   }

   saveMatch.addEventListener("click", function () {
      afterMatchScreen.style.display = 'none'
      gameScreen.style.display = "none";
      pauseScreen.style.display = "none";
      welcomeScreen.style.display = "block";
   });

   restartMatch.addEventListener("click", function () {
      gameScreen.style.display = "none";
      afterMatchScreen.style.display = "none";
      countdownScreen.style.display = "block";

      let countdown= 3;
      countdownNumber.textContent = `Game start in : ${countdown}`;

      const countdownInterval = setInterval(function () {
         countdown--;
         countdownNumber.textContent = `Game start in : ${countdown}`;

         if (hitungMundur === 0) {
            clearInterval(countdownInterval);
            countdownScreen.style.display = "none";
            startGame();
         }
      }, 1000);
   });



   function endGame() {
      clearInterval(gameInterval);
      gameScreen.style.display = "none";
      leaderboard.style.display = 'none'
      afterMatchScreen.style.display = "block";
      usernameAfterMatch.textContent = `Username: ${usernameInput.value}`;
      scoreAfterMatch.textContent = `Score: ${score}`;
      document.removeEventListener("click", shoot);
   }

   continueButton.addEventListener('click', function () {
      resumeGame();
   })

   document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
         if (!pause) {
            pauseGame();
         } else {
            resumeGame();
         }
      }else if(e.key === " "){
         gunElement.style.transform = 'translateX(100%)'
         setTimeout(() => {
            if(gunElement.getAttribute('src') === './Sprites/gun1.png'){
               gunElement.src = './Sprites/gun2.png'
            }else {
               gunElement.src = './Sprites/gun1.png'
            }
            gunElement.style.transform = 'translateX(0)'
         },200)
      }
   });


   const gameAreaRect = gameArea.getBoundingClientRect();
   const gunWidth = gunElement.offsetWidth;
   let initialGunX = (gameAreaRect.width / 2) - (gunWidth / 2);

   gunElement.style.left = initialGunX + 'px';

   document.addEventListener('mousemove', function(e) {
      const gameAreaRect = gameArea.getBoundingClientRect();
      let gunX = e.clientX - gameAreaRect.left - (gunWidth / 2);
      // Ensure the gun doesn't go outside the game area boundaries
      if (gunX <= 0) {
         gunX = 0;
      } else if (gunX + gunWidth >= gameAreaRect.width) {
         gunX = gameAreaRect.width - gunWidth;
      }
      gunElement.style.left = gunX + 'px';
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


      target.addEventListener('click', function(e){
         targetHit(target,e)
      })
   }

   function targetHit(target, e){
      score++;
      updateScore()
      target.remove();
      const x = e.clientX
      const y  = e.clientY

      const boom  = new Image()
      boom.src='./Sprites/boom.png'
      boom.classList.add('boom')
      boom.style.left = x + 'px'
      boom.style.top = y + 'px'

      gameArea.append(boom)

      setTimeout( () => {
         boom.remove()
      }, 500)
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



})

//console controller

function clearConsole() {
   console.clear()


}

setInterval(() => {
   clearConsole()
}, 0)