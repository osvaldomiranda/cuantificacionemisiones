import App from './views/App.vue'
import Vue from 'vue';
import VueRouter from 'vue-router'

import SourceList   from './views/SourceListView'
import SendList     from './views/SendListView'
import SendAdmin    from './views/SendAdminView'
import RequisitionList    from './views/RequisitionListView'
import Graphics     from './components/GraphicsComponent'

import Readings       from './views/ReadingsView'

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
            path: '/readings',
            name: 'readings',
            component: Readings,
        },
        {
            path: '/send_list',
            name: 'send_list',
            component: SendList,
        },
        {
            path: '/send_admin',
            name: 'send_admin',
            component: SendAdmin,
        },
        {
            path: '/graphics',
            name: 'graphics',
            component: Graphics,
        },
        {
            path: '/requisition_list',
            name: 'requisition_list',
            component: RequisitionList,
        },


        
    ],
});


export default router;