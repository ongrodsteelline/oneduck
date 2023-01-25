const requireContext = require.context('@modules', true, /router\.js$/)

const modules = requireContext.keys()
    .map(file =>
        [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
    )

let moduleRoutes = [];

for (let i in modules) {
    moduleRoutes = moduleRoutes.concat(modules[i][1].default)
}

export const routes = [
    ...moduleRoutes
];