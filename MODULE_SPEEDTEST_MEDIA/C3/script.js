const input = document.querySelector('input');
const boxes = document.querySelectorAll('.box');
let currentColor = 'black';

input.addEventListener('input', (e) => {
    currentColor = e.target.value;
});

boxes.forEach((box, index) => {
    box.addEventListener('click', () => {
        let currentIndex = index;
        boxes.forEach((otherBox, otherIndex) => {
            let delay = Math.abs(otherIndex - currentIndex) * 100;
            setTimeout(() => {
                otherBox.style.backgroundColor = currentColor;
            }, delay);
        });
    });
});