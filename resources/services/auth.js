import Api from './Api'

export default {
    login(credentials) {
        return new Promise((resolve, reject) => {
            Api().post('/api/users/login', {
                username: credentials.username,
                password: credentials.password,
            })
            .then(response => {
                const token = response.data.success.token
                localStorage.setItem('access_token', token)
                resolve(token)
            })
            .catch(error => {
                reject(error)
            })
        })
    },

    register(data) {
        return new Promise((resolve, reject) => {
          Api().post('/api/users/register', {
            name: data.name,
            email: data.email,
            username: data.username,
            password: data.password,
            password_confirmation: data.password_confirmation,
          })
            .then(response => {
              resolve(response)
            })
            .catch(error => {
              reject(error)
            })
        })
    },

    refresh(context, id) {
        return new Promise((resolve, reject) => {
          Api().post('/api/users/details')
            .then(response => {
                resolve(response)
            })
            .catch(error => {
                localStorage.removeItem('access_token')
                reject(error)
            })
        })
    },
    logout() {
        return new Promise((resolve, reject) => {
          Api().post('/api/users/logout')
            .then(response => {
                localStorage.removeItem('access_token')
                resolve(response)
            })
            .catch(error => {
              localStorage.removeItem('access_token')
              reject(error)
            })
        })
    }
}
