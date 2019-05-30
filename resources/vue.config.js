const CompressionWebpackPlugin = require('compression-webpack-plugin')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer')
  .BundleAnalyzerPlugin
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const isProduction = process.env.NODE_ENV === 'production'

const externals = {
  'vue': 'Vue',
  'vuex': 'Vuex',
  'vue-router': 'VueRouter',
  'axios': 'axios',
  'hls.js': 'Hls',
  'flv.js': 'flvjs',
  'dplayer': 'DPlayer'
}

const cdn = {
  // 开发环境
  dev: {
    css: [],
    js: []
  },
  // 生产环境
  build: {
    css: [],
    js: [
      './statics/js/vue/2.6.10/vue.min.js',
      './statics/js/vue-router/3.0.3/vue-router.min.js',
      './statics/js/vuex/3.1.0/vuex.min.js',
      './statics/js/axios/0.18.0/axios.min.js',
      './statics/js/hls.min.js',
      './statics/js/flv.min.js',
      './statics/js/DPlayer.min.js'
    ]
  }
}

module.exports = {
  // 基本路径
  publicPath: isProduction ? '/step/' : '/',
  // 输出文件目录
  outputDir: 'step',
  // 放置生成的静态资源 (js、css、img、fonts) 的 (相对于 outputDir 的) 目录。
  assetsDir: './statics',
  // 指定生成的 index.html 的输出路径 (相对于 outputDir)。也可以是一个绝对路径
  // indexPath: './',
  // eslint-loader 是否在保存的时候检查
  // lintOnSave: true,
  // webpack配置
  // see https://github.com/vuejs/vue-cli/blob/dev/docs/webpack.md
  chainWebpack: config => {
    // 对vue-cli内部的 webpack 配置进行更细粒度的修改。
    // 添加CDN参数到htmlWebpackPlugin配置中， 详见public/index.html 修改
    config.plugin('html').tap(args => {
      if (process.env.NODE_ENV === 'production') {
        args[0].cdn = cdn.build
      }
      if (process.env.NODE_ENV === 'development') {
        args[0].cdn = cdn.dev
      }
      return args
    })
    // 设置目录别名alias
    config.resolve.alias
      .set('assets', '@/assets')
      .set('components', '@/components')
      .set('view', '@/view')
      .set('style', '@/style')
      .set('mixins', '@/mixins')
      .set('store', '@/store')
      .set('utils', '@/utils')
  },
  configureWebpack: config => {
    if (isProduction) {
      config.performance = {
        hints: 'warning',
        // 入口起点的最大体积
        maxEntrypointSize: 1024 * 350,
        // 生成文件的最大体积
        maxAssetSize: 1024 * 350,
        // 只给出 js 文件的性能提示
        assetFilter: function (assetFilename) {
          return assetFilename.endsWith('.js')
        }
      }
    }
    if (isProduction) {
      // externals里的模块不打包
      Object.assign(config, {
        externals: externals
      })
      // 为生产环境修改配置...
      // 上线压缩去除console等信息
      config.plugins.push(
        new UglifyJsPlugin({
          uglifyOptions: {
            warnings: false,
            compress: {
              drop_console: true,
              drop_debugger: false,
              pure_funcs: ['console.log'] // 移除console
            }
          },
          sourceMap: true,
          parallel: true
        })
      )
      // 开启gzip压缩
      const productionGzipExtensions = /\.(js|css|json|txt|html|ico|svg)(\?.*)?$/i
      config.plugins.push(
        new CompressionWebpackPlugin({
          filename: '[path].gz[query]',
          algorithm: 'gzip',
          test: productionGzipExtensions,
          threshold: 10240,
          minRatio: 0.8
        })
      )
      if (process.env.npm_config_report) {
        // 打包后模块大小分析//npm run build --report
        config.plugins.push(new BundleAnalyzerPlugin())
      }
    } else {
      // 为开发环境修改配置...
    }
  },
  css: {
    // 是否使用css分离插件 ExtractTextPlugin
    extract: true, // isProduction ? true : false,
    // 开启 CSS source maps?
    sourceMap: true,
    // css预设器配置项
    // 启用 CSS modules for all css / pre-processor files.
    modules: false
  },
  lintOnSave: true, // default false
  // 生产环境是否生成 sourceMap 文件
  productionSourceMap: false,
  devServer: {
    port: 8888, // 端口
    open: true, // 自动开启浏览器
    compress: false, // 开启压缩
    overlay: {
      warnings: true,
      errors: true
    }
  }
}
