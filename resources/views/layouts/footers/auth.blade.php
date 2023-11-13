<footer class="footer">
    <div class="container-fluid float-center">
        <div class="copyright">
            <p>
                Corpico
                &copy;
                <span id="year"></span>. Turnero creado por <strong>Sección Sistemas</strong>.
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
