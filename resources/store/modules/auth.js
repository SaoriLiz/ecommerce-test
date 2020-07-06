import Api from '../../services/Api'
import AuthService from '../../services/auth'

const state = {
    //if there are a token in the localStorage, if not we save null in token
    token: localStorage.getItem('access_token') || null,
    // user state initialized on an empty object
    user : {}
}

const getters = {
    //if user is logged
    loggedIn(state) {
        return state.token !== null
    },

    //if user role is admin
    isAdmin(state) {
        if (state.user) {
            if (state.user.role === "admin") {
                return true
            }
        }
        return false
    }
};

const mutations = {
  updateUserDetails(state, user) {
    state.user = user
  },
  authSuccess(state, token) {
    state.token = token
  },
  destroyToken(state) {
    state.token = null
    state.user = {}
  }
};

const actions = {
    saveToken(context, token) {
        context.commit('authSuccess', token)
    },
    destroyToken(context, token) {
        context.commit('destroyToken', token)
    },
    refresh(context) {
            return new Promise((resolve, reject) => {
              AuthService.refresh()
                .then(response => {
                    const user = response.data.success
                    context.commit('updateUserDetails', user)
                    resolve(response)
                })
                .catch(error => {
                  context.commit('destroyToken')
                  reject(error)
                  console.log(error.response)
                })
            })
    }
}


export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
