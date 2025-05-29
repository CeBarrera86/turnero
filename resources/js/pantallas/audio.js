let audio = null;
function playAudio() {
    // Si ya hay una instancia de audio, reiníciala
    if (audio) {
        audio.pause();
        audio.currentTime = 0;
    }
    audio = new Audio('../../sound/timbre2.mp3');
    audio.preload = "auto";
    audio.addEventListener('canplaythrough', () => {
        try {
            audio.play().catch((error) => {
                console.error("Error al reproducir audio:", error);
            });
        } catch (error) {
            console.error("Error al reproducir audio:", error);
        }
    });
    audio.addEventListener('error', (error) => {
        console.error("Error al cargar el audio:", error);
    });
}

export { playAudio };
