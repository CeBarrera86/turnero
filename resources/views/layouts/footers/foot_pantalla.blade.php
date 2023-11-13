<footer class="footer bg-dark text-white">
    <div class="container-fluid d-flex align-items-center">
        <div class="marquee copyright">
            <p>
                &copy;
                <span id="year"></span> Corpico. Creado por Sección Sistemas.
            </p>
        </div>
        <script>
            const yearElement = document.getElementById('year');
            if (yearElement) {
                yearElement.textContent = new Date().getFullYear();
            }
        </script>
    </div>
</footer>
