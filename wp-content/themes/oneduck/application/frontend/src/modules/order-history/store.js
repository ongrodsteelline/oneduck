import axios from "axios"
import {
    buildFormData
} from "@/core/utils/utils"

function calculateCategory(total, plus) {
    let calculate = total + plus
    return Number(parseFloat(calculate).toFixed(2))
}

const history = {
    namespaced: true,
    state: {
        orders: [],
        paged: 1,
        isLastPage: false
    },
    getters: {
        orders(state) {
            return state.orders
        },
        paged(state) {
            return state.paged
        },
        isLastPage(state) {
            return state.isLastPage
        },
        ordersByCategory(state) {
            let orders = []

            state.orders.forEach((order) => {
                let categories = []
                order.items.forEach(function (item) {
                    let finder = categories.findIndex(c => c.term_id === item.product.category[0].term_id)
                    if (finder !== -1) {
                        categories[finder].children.push(item)
                        categories[finder].sum = calculateCategory(categories[finder].sum, item.product.regularPrice * item.quantity)
                    } else {
                        let category = item.product.category[0]
                        category.children = [item]
                        category.sum = calculateCategory(0, item.product.regularPrice * item.quantity)
                        categories.push(category)
                    }
                });

                if (order.items.length) {
                    orders.push({
                        order: order,
                        categories: categories
                    })
                }
            })

            return orders
        },
    },
    mutations: {
        SET_ORDERS(state, value) {
            state.orders = value
        },
        PUSH_ORDERS(state, value) {
            state.orders.push(...value)
        },
        SET_PAGED(state, value) {
            state.paged = value
        },
        ENABLE_LAST_PAGE(state) {
            state.isLastPage = true
        }
    },
    actions: {
        setOrders({commit}, value) {
            commit('SET_ORDERS', value)
        },
        pushOrders({commit}, value) {
            commit('PUSH_ORDERS', value)
        },
        load({commit, getters}) {
            commit('SET_PAGED', getters.paged + 1)

            const data = {
                action: 'load_orders',
                paged: getters.paged
            }
            const form = new FormData()

            buildFormData(form, data)

            return axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form
            }).then((response) => {
                commit('PUSH_ORDERS', response.data.data.orders)

                if (response.data.data.isLastPage) {
                    commit('ENABLE_LAST_PAGE')
                }
            })
        }
    }
}

export default {
    history: history
}