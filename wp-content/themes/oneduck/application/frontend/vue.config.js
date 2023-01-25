const path = require('path')

const config = {
    outputDir: path.resolve(__dirname, '../public/assets'),
    productionSourceMap: false,
    // отключение хэшей в именах файлов
    filenameHashing: false,
    // удаление плагинов webpack связанных с HTML
    chainWebpack: config => {
        config.plugins.delete('html')
        config.plugins.delete('preload')
        config.plugins.delete('prefetch')
    },
    configureWebpack: {
        target: 'web',
        entry: './src/app.js',
        module: {
            rules: [
                {
                    test: /\.(svg)$/,
                    use: 'raw-loader',
                }
            ]
        },
        resolve: {
            alias: {
                '@root': path.resolve(__dirname, './'),
                '@assets': path.resolve(__dirname, './assets'),
                '@app': path.resolve(__dirname, './src'),
                '@core': path.resolve(__dirname, './src/core'),
                '@modules': path.resolve(__dirname, './src/modules'),
            }
        },
        plugins: []
    }
}

module.exports = config
