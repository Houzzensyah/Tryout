const mouse = document.getElementById('mouse');
const animation = document.getElementById('animation');

mouse.addEventListener('click', (e) => {
    animation.style.left = e.clientX + 'px';
    animation.style.top = e.clientY + 'px';
    animation.classList.add('show');
    setTimeout(() => {
        animation.classList.remove('show');
    }, 1000);
});

document.addEventListener('mousemove', (e) => {
    mouse.style.left = e.clientX + 'px';
    mouse.style.top = e.clientY + 'px';
});