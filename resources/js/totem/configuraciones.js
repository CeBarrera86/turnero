// Configuración de axios con los encabezados comunes
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.common['Content-Type'] = 'application/json';
