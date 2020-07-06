import Admin from '../../views/admin/Admin'

import productsRoutes from './products'
import usersRoutes from './users'

let adminRoutes = [{
                    path: '/admin',
                    name: 'admin',
                    component: Admin,
                    meta: {
                        requiresAdmin: true,
                    }
                }]


adminRoutes[0]['children'] = [].concat(productsRoutes)
                                .concat(usersRoutes)

export default adminRoutes
