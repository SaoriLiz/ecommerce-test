import Login from '../views/auth/Login'
import Register from '../views/auth/Register'
import NotFound from '../views/public/NotFound'
import Index from '../views/public/Index'

export default [{
                    path: '/',
                    component: Index,
                    name: 'Index',
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/login',
                    name: 'login',
                    component: Login,
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/register',
                    name: 'register',
                    component: Register,
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/404',
                    name: '404',
                    component: NotFound,
                },
                {
                    path: '*',
                    redirect: '/404',
                }]
