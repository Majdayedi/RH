import './bootstrap';
// In your main app.js or equivalent
import axios from 'axios';
window.axios = axios;

// Set CSRF token for all requests
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;
} else {
    console.error('CSRF token not found');
}