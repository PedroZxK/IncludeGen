const carousel = document.getElementById('carousel');
const images = carousel.getElementsByTagName('img');
const totalImages = images.length;
let currentIndex = 0;

for (let i = 0; i < totalImages; i++) {
    const clone = images[i].cloneNode(true);
    carousel.appendChild(clone);
}

function startCarousel() {
    setInterval(() => {
        currentIndex++;

        if (currentIndex >= totalImages) {
            currentIndex = 0;
            carousel.style.transition = 'none';
            carousel.style.transform = `translateY(0)`;
            
            setTimeout(() => {
                carousel.style.transition = 'transform 0.7s ease-in-out';
                currentIndex++;
            }, 10);
        }

        const translateY = -currentIndex * (400 + 20);
        carousel.style.transform = `translateY(${translateY}px)`;
    }, 3000);
}

// Inicia o carrossel
startCarousel();
