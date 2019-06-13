
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue              from 'vue'
import Vuetify          from 'vuetify'
import Vuex             from 'vuex'
import VueRouter        from 'vue-router'
import store            from './store';
import router           from './routes'
import VueApexCharts    from 'vue-apexcharts'


import Discharge            from './components/Discharge' 
import AppComponent         from './components/AppComponent'
import GraphicsComponent    from './components/GraphicsComponent'
import Register             from './components/RegisterComponent'


Vue.use(Vuex);
Vue.use(VueApexCharts)


window.axios = require('axios');
axios.defaults.headers.common = {
    // 'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
};




Vue.prototype.$http = window.axios




Vue.use(Vuetify, {
    theme: {

        primary: '#1976D2',
        secondary: '#424242',
        accent: '#82B1FF',
        error: '#FF5252',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FFC107'
    }
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component('graphics', GraphicsComponent);
Vue.component('discharge', Discharge);
Vue.component('register', Register);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#App',
    render: h => h(AppComponent),
    store,
    router: router,
    created () {
        this.initialize()
    },
    methods: {
        initialize () {
            let token_vu = document.head.querySelector('meta[name="token"]');

            if (token_vu.content){
                alert(JSON.stringify(token_vu.content));
                window.axios.defaults.headers.common['Authorization'] = 'Bearer '+token_vu.content;
                this.$store.commit('changeToken',token_vu.content)
            }else{
                window.axios.defaults.headers.common['Authorization'] = 'Bearer '+ this.$store.getters.token;
            }
        }
    }
});
