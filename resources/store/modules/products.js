const state = {
    products: {}
}

const getters = {
    getAllProducts(state) {
        return state.products
    }
};

const mutations = {
    updateProducts(state, products) {
        state.products = products
    }
};

const actions = {
    updateProducts (context, products) {
        context.commit('updateProducts', products)
    }
}


export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
