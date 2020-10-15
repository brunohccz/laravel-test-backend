require('./bootstrap');

import Vue from 'vue';
import VueRouter from "vue-router";

import App from '@/views/App';

import store from '@/store';
import router from '@/router';

Vue.use(VueRouter);

// To get around losing our state, let's make sure that we're always
// requesting an authentication check when our app first runs.
store.dispatch('auth/me')
    .then(() => {
        new Vue({
            el: '#app',
            components: { App },
            store,
            router
        });
});
