import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

import auth from './modules/auth'
import products from './modules/products'
import cart from './modules/cart'

const store = new Vuex.Store({
    modules: {
       auth,
       products,
       cart
     }
})

export default store
