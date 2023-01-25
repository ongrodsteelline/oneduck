import {
    ProductsQuery
} from "@core/utils/products-query"
import Cookies from 'js-cookie'
import isEmpty from 'lodash/isEmpty'
import {hideLoader, showLoader} from "@modules/catalog/utils";

const catalog = {
    namespaced: true,
    state: {
        type: null,
        categoryName: null,
        categoryId: null,
        limit: 10,
        paged: 1,
        products: [],
        pages: [],
        order: [],
        attributes: {},
        filter: {},
        search: null,
        counter: {
            all: 0,
            filter: 0
        }
    },
    getters: {
        type(state) {
            return state.type
        },
        categoryName(state) {
            return state.categoryName
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
        },
        attributes(state) {
            return state.attributes
        },
        attributesByType: (state) => (type) => {
            return Object.keys(state.attributes).filter(attr => state.attributes[attr].type === type).reduce((obj, key) => {
                return {
                    ...obj,
                    [key]: state.attributes[key]
                };
            }, {})
        },
        filter(state) {
            return state.filter
        },
        search(state) {
            return state.search
        },
        counter(state) {
            return state.counter
        }
    },
    mutations: {
        SET_TYPE(state, value) {
            state.type = value;
        },
        SET_CATEGORY_NAME(state, value) {
            state.categoryName = value;
        },
        SET_CATEGORY_ID(state, value) {
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
        },
        SET_ATTRIBUTES(state, value) {
            state.attributes = value;
        },
        SET_FILTER(state, value) {
            state.filter = value;
        },
        REMOVE_FILTER_ITEM(state, payload) {
            state.filter[payload.parent].splice(payload.index, 1)
        },
        SET_SEARCH(state, value) {
            state.search = value;
        },
        SET_COUNTER(state, value) {
            state.counter = value;
        }
    },
    actions: {
        setType({commit}, value) {
            commit('SET_TYPE', value)
        },
        setCategoryName({commit}, value) {
            commit('SET_CATEGORY_NAME', value)
        },
        setCategoryId({commit}, value) {
            commit('SET_CATEGORY_ID', value)
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
            showLoader()
            const query = new ProductsQuery(state.type, state.categoryId, state.paged, state.limit)
            if (!isEmpty(state.order)) {
                query.setOrder(state.order)
            }

            if (!isEmpty(state.search)) {
                query.setSearch(state.search)
            }

            if (!isEmpty(state.filter)) {
                query.setFilter(state.filter)
            }

            await query.get()
            hideLoader()
        },
        setPages({commit}, value) {
            commit('SET_PAGES', value)
        },
        setOrder({commit}, value) {
            Cookies.set('cf_catalog_order', value, {
                expires: 365
            })
            commit('SET_ORDER', value)
        },
        setAttributes({commit}, value) {
            commit('SET_ATTRIBUTES', value)
        },
        setFilter({commit}, value) {
            commit('SET_FILTER', value)
        },
        removeFilterItem({commit}, payload) {
            commit('REMOVE_FILTER_ITEM', payload)
        },
        setSearch({commit}, value) {
            commit('SET_SEARCH', value)
        },
        setCounter({commit}, value) {
            commit('SET_COUNTER', value)
        }
    }
}

export default {
    catalog: catalog
}