import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Routes
import publicRoutes from './public'
import commonRoutes from './common'
import adminRoutes from './admin/admin'
import userRoutes from './user/user'


//concat all routes
/*
var routes = [...commonRoutes,
            ...adminRoutes,
            ...publicRoutes];
*/

var routes = commonRoutes.concat(adminRoutes)
                        .concat(userRoutes)
                        .concat(publicRoutes)

// Router
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes
});

export default router
