import Vue from 'vue'

// Lib imports
import axios from 'axios'

window.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.post['X-CSRF-Token'] = window.csrf;

Vue.prototype.$http = axios;
