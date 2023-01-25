// import axios from 'axios'
// import {
//     buildFormData
// } from '@/core/utils/utils'

const user = {
    namespaced: true,
    state: {
        group: null,
        groupMixed: null
    },
    getters: {
        group(state) {
            return state.group
        },
        groupMixed(state) {
            return state.groupMixed
        }
    },
    mutations: {
        SET_GROUP(state, value) {
            state.group = value
        },
        SET_GROUP_MIXED(state, value) {
            state.groupMixed = value
        }
    },
    actions: {
        setGroup({ commit }, value) {
            commit('SET_GROUP', value)
        },
        setGroupMixed({ commit }, value) {
            commit('SET_GROUP_MIXED', value)
        }
    }
}

export default {
    user: user
}