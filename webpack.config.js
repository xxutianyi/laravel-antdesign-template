// eslint-disable-next-line @typescript-eslint/no-var-requires,no-undef
const path = require('path')

// eslint-disable-next-line no-undef
module.exports = {
    resolve: {
        alias: {
            '@':
                path.resolve('resources/ts'),
            '~':
                path.resolve('resources/css'),
        }
    },
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: ['postcss-loader'],
            },
            {
                test: /\.less$/,
                use: [{
                    loader: 'less-loader', // compiles Less to CSS
                    options: {
                        lessOptions: { // 如果使用less-loader@5，请移除 lessOptions 这一级直接配置选项。
                            modifyVars: {
                                'primary-color': '#ff4539',
                                'link-color': '#ff4539',
                                'success-color': '#52c41a',
                                'warning-color': '#FFAB00',
                                'error-color': '#f5222d',
                            },
                            javascriptEnabled: true,
                        },
                    },
                }]
            }
        ]
    }
}
