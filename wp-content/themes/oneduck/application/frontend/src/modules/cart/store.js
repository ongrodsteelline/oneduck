import axios from "axios"
import axiosCancel from 'axios-cancel'
import {
    buildFormData
} from "@/core/utils/utils"

const cart = {
    namespaced: true,
    state: {
        products: []
    },
    getters: {
        products(state) {
            return state.products
        },
        totalAmount(state, getters, rootState, rootGetters) {
            let amount = 0

            state.products.forEach(function(item) {
                const group = (rootGetters['user/group'] === 'mixed') ? rootGetters['user/groupMixed'] : rootGetters['user/group']

                const price = (group === 'cash') ? item.product.priceForCash : item.product.priceForCashless

                amount += item.quantity * price
            })

            return parseFloat(amount).toFixed(2)
        },
        totalItems(state) {
            return state.products.length
        },
        isValid(state) {
            if (state.products.find(i => i.isValid === false)) {
                return false
            }

            return true
        }
    },
    mutations: {
        SET_PRODUCTS(state, value) {
            state.products = value;
        }
    },
    actions: {
        setProducts({commit}, value) {
            commit('SET_PRODUCTS', value)
        },
        addItem({commit}, {productId, quantity}) {
            const data = {
                action: 'add_to_cart',
                product_id: productId,
                quantity: quantity
            }
            const form = new FormData()

            buildFormData(form, data)

            axiosCancel(axios)

            axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form,
                requestId: 'addItem' + productId
            }).then((response) => {
                commit('SET_PRODUCTS', response.data.items)
            })
        },
        removeItem({commit}, itemKey) {
            const data = {
                action: 'remove_from_cart',
                item_key: itemKey
            }
            const form = new FormData()

            buildFormData(form, data)

            axios.post('/wp-admin/admin-ajax.php', form).then((response) => {
                commit('SET_PRODUCTS', response.data.items)
            })
        },
        clear({commit}) {
            const data = {
                action: 'clear_cart'
            }
            const form = new FormData()

            buildFormData(form, data)

            axios.post('/wp-admin/admin-ajax.php', form).then((response) => {
                commit('SET_PRODUCTS', response.data.items)
            })
        }
    }
}

export default {
    cart: cart
}