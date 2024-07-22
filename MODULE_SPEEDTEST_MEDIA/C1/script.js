let centiseconds = 0 ;
let timerInterval = null;

const timeDisplay = document.getElementById('time-display');
const startBtn = document.getElementById('start-btn');
const stopBtn = document.getElementById('stop-btn');
const resetBtn = document.getElementById('reset-btn');

startBtn.addEventListener('click', startTimer);
stopBtn.addEventListener('click', stopTimer);
resetBtn.addEventListener('click', resetTimer);

function startTimer() {
    if (timerInterval === null) {
        timerInterval = setInterval(updateTimer, 10);
    }
}

function stopTimer() {
    clearInterval(timerInterval);
    timerInterval = null;
}

function resetTimer() {
    stopTimer();
    centiseconds = 0;
    updateDisplay();
}

function updateTimer() {
    centiseconds++;
    if (centiseconds > 99959) {
        stopTimer();
        centiseconds = 99959;
    }
    updateDisplay();
}

function updateDisplay() {
    const seconds = Math.floor(centiseconds / 100);
    const centis = centiseconds % 100;
    timeDisplay.textContent = `${seconds.toString().padStart(3, '0')}:${centis.toString().padStart(2, '0')}`;
}
