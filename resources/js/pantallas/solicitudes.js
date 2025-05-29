function showNextSlide(slides, currentIndex, totalSlides) {
    slides[currentIndex].className = slides[currentIndex].className.replace(' active', '');
    currentIndex = (currentIndex + 1) % totalSlides;
    slides[currentIndex].className += ' active';
    const activeSlide = slides[currentIndex];
    const video = activeSlide.querySelector('video');
    let interval = 8000; // Por defecto 8 segundos para imágenes
    if (video) {
        interval = video.duration * 1000 || 8000;
        video.currentTime = 0;
        video.play();
    }
    setTimeout(() => showNextSlide(slides, currentIndex, totalSlides), interval);
}

function pasarPublicidad() {
    fetch(urlPublicidad)
        .then((response) => response.json())
        .then((data) => {
            const archivos = data.archivos;
            if (!Array.isArray(archivos)) {
                console.error('archivos no es un array:', archivos);
                return;
            }
            const carouselInner = document.getElementById('carousel-inner');
            carouselInner.innerHTML = '';
            let currentIndex = 0;
            archivos.forEach((archivo, index) => {
                const carouselItem = document.createElement('div');
                carouselItem.className = 'carousel-item';
                if (index === 0) {
                    carouselItem.classList.add('active');
                }
                if (archivo.tipo === 'imagen') {
                    const img = document.createElement('img');
                    img.src = archivo.url;
                    img.alt = archivo.url;
                    carouselItem.appendChild(img);
                } else if (archivo.tipo === 'video') {
                    const video = document.createElement('video');
                    video.src = archivo.url;
                    video.autoplay = true;
                    video.muted = true;
                    video.loop = false;
                    video.preload = 'auto';
                    video.setAttribute('playsinline', true);
                    carouselItem.appendChild(video);
                }
                carouselInner.appendChild(carouselItem);
            });
            const slides = document.querySelectorAll('.carousel-item');
            const totalSlides = slides.length;
            showNextSlide(slides, currentIndex, totalSlides);
        })
        .catch((error) => {
            console.error('Error en pasarPublicidad():', error);
        });
}

export { pasarPublicidad };
