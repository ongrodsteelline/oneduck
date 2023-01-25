// import axios from 'axios'
// import {
//     buildFormData
// } from '@/core/utils/utils'

const user = {
    namespaced: true,
    state: {
        logged: false,
        group: null,
        groupMixed: null,
        warehouses: []
    },
    getters: {
        group(state) {
            return state.group
        },
        groupMixed(state) {
            return state.groupMixed
        },
        logged(state) {
            return state.logged
        },
        warehouses(state) {
            return state.warehouses
        }
    },
    mutations: {
        SET_GROUP(state, value) {
            state.group = value
        },
        SET_GROUP_MIXED(state, value) {
            state.groupMixed = value
        },
        SET_LOGGED(state) {
            state.logged = true
        },
        SET_WAREHOUSES(state, value) {
            state.warehouses = value
        }
    },
    actions: {
        setGroup({ commit }, value) {
            commit('SET_GROUP', value)
        },
        setGroupMixed({ commit }, value) {
            commit('SET_GROUP_MIXED', value)
        },
        setLogged({ commit }) {
            commit('SET_LOGGED')
        },
        setWarehouses({ commit }, value) {
            commit('SET_WAREHOUSES', value)
        }
    }
}

export default {
    user: user
}
