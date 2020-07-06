const state = {
    items: JSON.parse(localStorage.getItem('cartitems')) || []
}

const getters = {
    getAllItems(state) {
        return state.items
    },
    getItemsQuantity(state) {
        return state.items.reduce((accumulator, current) => {
            return accumulator + parseInt(current.quantity || 0)
        }, 0);
    }
};

const mutations = {
    pushToCart(state, item) {
        state.items.push({item: item, quantity: 1})
    },
    incrementItemQuantity(state, id) {
        const cartItem = state.items.find(item => item.item.id === id)
        cartItem.quantity++
    },
    removeItem(state, removeItem) {
        state.items.find(function(value, index) {
            if (value) {
                if (value.item.id === removeItem) {
                    state.items.splice(index, 1)
                }
            }
        })
    }
};

const actions = {
    addToCart(context, itemToAdd) {
        const cartItem = state.items.find(item => item.item.id === itemToAdd.id)
        if (!cartItem) {
            context.commit('pushToCart', itemToAdd)
        } else {
            context.commit('incrementItemQuantity', cartItem.item.id)
        }
        context.dispatch('saveCart')
    },
    saveCart(context) {
        localStorage.setItem('cartitems', JSON.stringify(context.state.items))
    },
    removeItem(context, removeItem) {
        context.commit('removeItem', removeItem)
        context.dispatch('saveCart')
    }
}


export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
