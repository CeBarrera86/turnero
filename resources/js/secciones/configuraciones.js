const csrfToken = $('meta[name="csrf-token"]').attr('content');
const axiosHeaders = {
    headers: { 'X-CSRF-TOKEN': csrfToken }
};
// Configuración de headers para solicitudes axios
function axiosRequest(url, method, params = {}) {
    const config = {
        method: method,
        url: url,
        ...axiosHeaders
    };

    if (method.toLowerCase() === 'get') {
        config.params = params;
    } else {
        config.data = params;
    }

    return axios(config);
}
// Configuración de interceptores para manejar el token CSRF
function interceptoresAxios() {
    axios.interceptors.request.use(
        function (config) {
            config.headers['X-CSRF-TOKEN'] = csrfToken;
            return config;
        },
        function (error) {
            return Promise.reject(error);
        }
    );
}

interceptoresAxios();

export { axiosRequest };
