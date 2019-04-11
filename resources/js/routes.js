import App from './views/App'
import Vue from 'vue';
import VueRouter from 'vue-router'

import SourceList from './views/SourceListView'
import SendList from './views/SendListView'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/app',
            name: 'app',
            component: App,
        },
        {
            path: '/source_list',
            name: 'source_list',
            component: SourceList,
        },
        {
            path: '/send_list',
            name: 'send_list',
            component: SendList,
        },
    ],
});


export default router;