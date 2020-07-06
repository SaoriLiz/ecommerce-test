import Products from '../../views/admin/products/Products'
import ProductsList from '../../views/common/products/ProductsList'
import ProductsAdd from '../../views/admin/products/ProductsAdd'
import ProductsEdit from '../../views/admin/products/ProductsEdit'

export default [{
                    path: 'products',
                    components: {
                        adminContent: Products
                    },
                    children: [{
                            path: 'new',
                            name: 'productadd',
                            components: {
                                productsContent: ProductsAdd
                            },
                        },
                        {
                                path: 'edit/:product_id',
                                name: 'productedit',
                                components: {
                                    productsContent: ProductsEdit
                                },
                        },
                        {
                            path: '',
                            name: 'products',
                            components: {
                                productsContent: ProductsList
                            },
                        }
                    ]
                }]
