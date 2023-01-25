import { createStore } from 'vuex'

const modules = import.meta.globEager('/src/modules/**/store.js')

let moduleStores = {}

for (const path in modules) {
    Object.assign(moduleStores, modules[path].default)
}

const store = createStore({
    modules: moduleStores
})

export default store
