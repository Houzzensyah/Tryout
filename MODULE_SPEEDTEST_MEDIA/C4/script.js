const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
let ballX = 200;
let ballY = 200;
let ballRadius = 20;

canvas.addEventListener('mousemove', (e) => {
    ballX = e.offsetX;
    ballY = e.offsetY;
    drawBall();
});

function drawBall() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.arc(ballX, ballY, ballRadius, 0, 2 * Math.PI);
    ctx.fillStyle = 'green';
    ctx.fill();
    ctx.strokeStyle = 'red';
    ctx.stroke();
}
drawBall();