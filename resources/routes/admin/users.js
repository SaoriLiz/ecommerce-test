import Users from '../../views/admin/users/Users'
import UsersList from '../../views/admin/users/UsersList'
import UsersAdd from '../../views/admin/users/UsersAdd'
import UsersEdit from '../../views/admin/users/UsersEdit'

export default [{
                path: 'users',
                components: {
                    adminContent: Users
                },
                children: [{
                        path: '',
                        name: 'users',
                        components: {
                            productsContent: UsersList
                        },
                    },
                    {
                            path: 'edit/:user_id',
                            name: 'useredit',
                            components: {
                                productsContent: UsersEdit
                            },
                    },
                    {
                        path: 'new',
                        name: 'useradd',
                        components: {
                            productsContent: UsersAdd
                        },
                    }
                ]
            }]
