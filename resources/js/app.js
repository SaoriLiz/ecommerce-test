require('./bootstrap');

import Vue from 'vue'
import router from '../routes/router'
import store from '../store/store'
import Eshopapp from '../views/EShopApp'



import Vuetify from 'vuetify'
Vue.use(Vuetify)
const vuetify = new Vuetify();

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import VuetifyNumberInput from '@jzolago/vuetify-number-input'
Vue.use(VuetifyNumberInput);

router.beforeEach(async (to, from, next) => {
    await store.dispatch("auth/refresh")

    if (to.matched.some(record => record.meta.requiresAdmin)) {
      // this route requires Admin, check if logged as admin
      // if not, redirect to 404 page
      if (!store.getters["auth/isAdmin"]) {
        next({
          name: '404',
        })
      } else {
          next()
      }
    }

    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!store.getters["auth/loggedIn"]) {
        next({
          name: 'login',
        })
      } else {
          next()
      }
    } else {
        if (to.path === "/login" && store.getters["auth/loggedIn"]) {
            next({
              name: 'admin',
            })
        } else {
            next()
        }
    }
  })

const app = new Vue({
    el: '#Eshopapp',
    components: { Eshopapp },
    router,
    store,
    vuetify
});
