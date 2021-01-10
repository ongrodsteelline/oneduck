import Vue from 'vue/dist/vue.js'
import Vuex from 'vuex'
Vue.use(Vuex);

const requireContext = require.context('@modules', true, /store\.js$/)

const modules = requireContext.keys()
    .map(file =>
        [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
    )

let moduleStores = {}

for (let i in modules) {
    Object.assign(moduleStores, modules[i][1].default)
}

const store = new Vuex.Store({
    modules: moduleStores
})

export default store