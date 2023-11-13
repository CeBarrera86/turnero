<footer class="footer bg-dark text-white">
    <div class="container-fluid d-flex align-items-center">
        <div class="copyright float-left col-md-8">
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

        <div class="float-right col-md-4">
            <div class="marquee">
                <span class="d-flex align-items-center">
                    <i class="material-icons">web</i>
                    {{ 'Sitio WEB ( www.corpico.com.ar )' }}
                </span>
                <span class="d-flex align-items-center">
                    <i class="material-icons">smartphone</i>
                    {{ 'Corpico DIGITAL ( corpicoapp.web.app )' }}
                </span>
            </div>
        </div>
    </div>
</footer>
