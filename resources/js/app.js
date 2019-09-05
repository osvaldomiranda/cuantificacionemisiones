
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
import Register             from './components/RegisterComponent'

import Covs                 from './components/CovsComponent'
import Isocinetic           from './components/IsocineticComponent'
import Upload               from './components/UploadComponent'
import NewIso               from './components/NewIsocinetic'

import ReadingsNew          from './components/ReadingsNew'
import Production           from './components/ProductionComponent'


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
        main_green: '#079992',
        secondary_green: '#38ACA9',
        highlight_green: '#6BEC87',
        side_bar_gray: '#595959',

        seconday_gray: '#EEEEEE',

        ds_138: '#FFCD65',
        readings: '#FF8B4A',
        covs: '#B9E55F',
        
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

Vue.component('discharge', Discharge);
Vue.component('register', Register);

Vue.component('covs', Covs);
Vue.component('isocinetic', Isocinetic);
Vue.component('upload', Upload);
Vue.component('new_iso', NewIso);

Vue.component('readingsnew', ReadingsNew);
Vue.component('production', Production);



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

        let token_vu = document.head.querySelector('meta[name="token"]');

        if (token_vu.content){
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+token_vu.content;
            this.$store.commit('changeToken',token_vu.content)
        }else{
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+ this.$store.getters.token;
        }
    },
});
