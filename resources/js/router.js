import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


const routes = [
    //=================  DEFAULT  =====================//
    {
        path: '/',
        redirect:'/menu',
    },
    //================= MENU'S ROUTES =================//
    {
        path: '/menu',
        name:'menu',
        components: {
            default: require('./components/menu.vue').default
        },
    },
    //================= ORDER'S ROUTES =================//
    {
        path: '/orders',
        name:'orders',
        components: {
            default: require('./components/orders.vue').default
        },
    },  
    //=================  DEFAULT  =====================//
    {
        path: '*',
        name: 'notfound',
        redirect: '/',
    },


]
    
const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: 'active',
    base: '', 
})

export default router
