import 'focus-visible/dist/focus-visible.min.js';

import Vue from 'vue';
import axios from 'axios';
import PersonalWarning from './components/personal-warning.vue';
import LoginPage from './components/login-page.vue';
import RegistrationPage from './components/registration-page.vue';

window.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.post['X-CSRF-Token'] = window.csrf;

new Vue({
    el: '#main',
    components: {
        LoginPage,
        RegistrationPage,
    },
});

new Vue({
    el: '#footer',
    components: {
        PersonalWarning,
    },
});
