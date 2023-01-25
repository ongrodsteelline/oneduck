const modules = import.meta.globEager('/src/modules/**/router.js')

let moduleRoutes = []

for (const path in modules) {
    moduleRoutes.push(modules[path].default)
}

export const routes = [
    ...moduleRoutes
]
