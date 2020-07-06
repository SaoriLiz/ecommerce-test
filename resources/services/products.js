import Api from './Api'

export default {
    getProducts(page) {
        return Api().get('/api/products?page=' + page)
    },

    getProduct(id) {
        return Api().get('/api/products/' + id)
    },

    saveProduct(data) {
        return Api().post('/api/products', data)
    },

    updateProduct(data, id) {
        return Api().put('/api/products/' + id, data)
    },

    deleteProduct(id) {
        return Api().delete('/api/products/' + id)
    }
}
