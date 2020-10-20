import Vue from 'vue';
import axios from 'axios';
import PersonalWarning from './components/personal-warning.vue';

window.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.post['X-CSRF-Token'] = window.csrf;

new Vue({
    el: '#header',
    components: {

    },
});

new Vue({
    el: '#main',
    components: {
        'personal-warning': require('./components/personal-warning').default,
        'match': require('./components/match').default,
    },
});

new Vue({
    el: '#footer',
    components: {
        PersonalWarning,
    },
});
