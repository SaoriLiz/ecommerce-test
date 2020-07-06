import Cart from '../../views/user/cart'

let userRoutes = [{
                    path: '/cart',
                    name: 'cart',
                    component: Cart,
                    meta: {
                        requiresAuth: true,
                    }
                }]



export default userRoutes
