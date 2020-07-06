import Api from './Api'

export default {
    getUsers() {
        return Api().get('/api/users')
    },

    getUser(id) {
        return Api().get('/api/users/' + id)
    },

    saveUser(data) {
        return Api().post('/api/users', data)
    },

    updateUser(data, id) {
        return Api().put('/api/users/' + id, data)
    },

    deleteUser(id) {
        return Api().delete('/api/users/' + id)
    }
}
