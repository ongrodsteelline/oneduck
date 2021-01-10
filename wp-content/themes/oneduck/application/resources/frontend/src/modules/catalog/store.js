import {
    ProductsQuery
} from "@core/utils/products-query"
import Cookies from 'js-cookie'
import isEmpty from 'lodash/isEmpty'

const catalog = {
    namespaced: true,
    state: {
        type: null,
        categoryId: null,
        limit: 10,
        paged: 1,
        products: [],
        pages: [],
        order: []
    },
    getters: {
        type(state) {
            return state.type
        },
        categoryId(state) {
            return state.categoryId
        },
        limit(state) {
            return state.limit
        },
        paged(state) {
            return state.paged
        },
        products(state) {
            return state.products
        },
        pages(state) {
            return state.pages
        },
        order(state) {
            return state.order
        }
    },
    mutations: {
        SET_TYPE(state, value) {
            state.type = value;
        },
        SET_CATEGORY(state, value) {
            state.categoryId = value;
        },
        SET_LIMIT(state, value) {
            state.limit = value;
        },
        SET_PAGED(state, value) {
            state.paged = value;
        },
        SET_PRODUCTS(state, value) {
            state.products = value;
        },
        SET_PAGES(state, value) {
            state.pages = value;
        },
        SET_ORDER(state, value) {
            state.order = value;
        }
    },
    actions: {
        setType({commit}, value) {
            commit('SET_TYPE', value)
        },
        setCategory({commit}, value) {
            commit('SET_CATEGORY', value)
        },
        setLimit({commit}, value) {
            Cookies.set('cf_catalog_limit', value, {
                expires: 365
            })

            commit('SET_LIMIT', value)
        },
        setPaged({commit}, value) {
            commit('SET_PAGED', value)
        },
        setProducts({commit}, value) {
            commit('SET_PRODUCTS', value)
        },
        async getProducts({state}) {
            const query = new ProductsQuery(state.type, state.categoryId, state.paged, state.limit)
            if (!isEmpty(state.order)) {
                query.setOrder(state.order)
            }

            await query.get()
        },
        setPages({commit}, value) {
            commit('SET_PAGES', value)
        },
        setOrder({commit}, value) {
            Cookies.set('cf_catalog_order', value, {
                expires: 365
            })
            commit('SET_ORDER', value)
        }
    }
}

export default {
    catalog: catalog
}