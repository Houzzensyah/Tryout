document.addEventListener('DOMContentLoaded', function () {
    const welcomeScreen = document.getElementById('welcome-screen')
    const usernameInput = document.getElementById('username');
    const playButton = document.getElementById('play-game');
    const selectLevel = document.getElementById('select-level');
    const gunSkinRadio = document.getElementsByName('gunskin');
    const targetSkinRadio = document.getElementsByName('target')
    const instructionButton = document.getElementById('instruction');
    const countdownScreen = document.getElementById('countdown-screen');
    const countdownNumber = document.getElementById('countdown-number');
    const instructionScreen = document.getElementById('instruction-display');
    const instructionCloseButton = document.getElementById('close-instruction');
    const gameDisplay = document.getElementById('game-display');
    const gameArea = document.getElementById('game-area');
    const usernameInGame = document.getElementById('username-display');
    const scoreInGame = document.getElementById('score-display');
    const timeInGame = document.getElementById('time-display');
    const gunElement = document.getElementById('gun');
    const pauseScreen = document.getElementById('pause-popup');
    const continueButton = document.getElementById('continue');
    const restartButton = document.getElementById('restart');
    const usernameAfterMatch = document.getElementById('username-after-match');
    const scoreAfterMatch = document.getElementById('score-after-match');
    const restartButtonAfterMatch = document.getElementById('restart-after-match');

    let pause = false;
    let level = 'easy';
    let gunSkin = 'gun1';
    let targetSkin = 'target1';
    let timeDuration = 30;
    let timeRemaining;
    let score;


    usernameInput.addEventListener('input', function () {
        usernameInGame.textContent = usernameInput.value;
        playButton.disabled = usernameInput.value.trim() === '';
    })

    targetSkinRadio.forEach(radio => {
        radio.addEventListener('change', function () {
            if(this.checked) {
                targetSkin = this.value

            }
        })
    })

    gunSkinRadio.forEach(radio => {
        radio.addEventListener('change', function () {
            if(this.checked) {
                gunSkin = this.value
                gunElement.src = `./Sprites/${gunSkin}.png`
            }
        })
    })

    instructionButton.addEventListener('click', function () {
        instructionScreen.style.display = 'block'
    })
    instructionCloseButton.addEventListener('click', function () {
        instructionScreen.style.display = 'none'
    })


    selectLevel.addEventListener('change', function () {

        level = this.value
        switch (level) {
            case 'easy' :
                timeDuration = 30
                break
            case 'medium' :
                timeDuration = 20
                break
            case 'hard' :
                timeDuration = 10
                break
            default :
                timeDuration = 30
                break
        }
    })

    playButton.addEventListener('click', function () {
        welcomeScreen.style.display = 'none'
        countdownScreen.style.display = 'block'
        instructionScreen.style.display = 'none'

        let countdown = 3
        countdownNumber.textContent = `Game start in: ${countdown}`

        const countdownInterval = setInterval(function () {
            countdown--;
            countdownNumber.textContent =`Game start in: ${countdown}`;
            if (countdown === 0 )  {
                clearInterval(countdownInterval)
                countdownScreen.style.display = 'none'
                playGame()
            }
        },1000);
    })



    function playGame() {
        gameDisplay.style.display= 'block'
        instructionScreen.style.display = 'none'



        timeRemaining = timeDuration;
        timeInGame.textContent = `Time: ${timeRemaining}s`;
        gameTimer = setInterval(function () {
           timeRemaining--;
           timeInGame.textContent = `Time: ${timeRemaining}s`;
           if(timeRemaining <= 0) {
               clearInterval(gameTimer)
               endGame();
           }
        },1000);
        const gameInterval = setInterval(spawnTarget, 3000);
    }

    function endGame() {

    }

    const gameAreaRect = gameArea.getBoundingClientRect()
    const gunWidth = gunElement.offsetWidth
    const initialGunX = (gameAreaRect.width / 2) - (gunWidth/2)
    gunElement.style.left = initialGunX +'px'

    document.addEventListener('mouseover',function (e) {
        const gunAreaRect = gameArea.getBoundingClientRect()
        let gunX = e.clientX - gunAreaRect.width - (gunWidth/ 2)

        if(gunX <= 0) {
            gunX = 0
        } else if (gunX + gunWidth >= gameAreaRect.width) {
            gunX = gameAreaRect.width - gunWidth;
        }
        gunElement.style.left = gunX + 'px';
    })



        function spawnTarget() {

            const target = document.createElement('img')
            target.src = `/Sprites/${targetSkin}.png`
            target.appendChild('target')
            target.style.position = 'absolute'

            const gameAreaRect =  gameArea.getBoundingClientRect();
            const maxX = gameAreaRect.width -50
            const maxY = gameAreaRect.height -50
            const randomX = Math.floor(Math.random() * maxX)
            const randomY = Math.floor(Math.random() * maxY)

            target.style.left = `${randomX}px`
            target.style.top = `${randomY}px`

            gameArea.appendChild(target)

            target.addEventListener('click', function () {
                targetHit(target, e)
            })

        }

        function targetHit(target, e) {
            score++;
            updateScore()

            const y = e.clientY
            const x = e.clientX

            const boom = new Image()
            boom.src = './Sprites/boom.png'
            boom.appendChild('boom')
            boom.style.top = y + 'px'
            boom.style.left = x + 'px'

            setTimeout(() => {
                 boom.remove()
            },500)
        }












    // function spawnTarget() {
    //     const target = document.createElement('img');
    //     target.src = `./Sprites/${targetSkin}.png`;
    //     target.classList.add('target')
    //     target.style.position ='absolute'
    //
    //     const gameRect = gameArea.getBoundingClientRect();
    //     const maxY = gameRect.height -50;
    //     const maxX = gameRect.width - 50;
    //     const randomX  = Math.floor(Math.random() * maxX);
    //     const randomY  = Math.floor(Math.random() * maxY);
    //
    //     target.style.top = `${randomY}px`
    //     target.style.left = `${randomX}px`
    //
    //     gameArea.appendChild(target)
    //
    //     target.addEventListener('click', function (e) {
    //         targetHit(target, e)
    //     })
    //
    //
    // }
    //
    // function targetHit(target, e) {
    //     score++;
    //     updateScore();
    //
    //     target.remove()
    //
    //     const y = e.clientY
    //     const x = e.clientX;
    //
    //     const boom = new Image();
    //     boom.src = './Sprites/boom.png'
    //     boom.classList.add('boom')
    //     boom.style.position = 'absolute'
    //     boom.style.left = x+'px'
    //     boom.style.top = x+'px'
    //
    //     setTimeout(() => {
    //         boom.remove()
    //     },500)
    // }
    //


    function updateScore() {

        scoreInGame.textContent = `Score: ${score}`
    }


})