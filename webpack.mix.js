let mix = require('laravel-mix');

let path = require('path')

mix.webpackConfig({
  output: {
    // 依据该路径进行编译以及异步加载
    publicPath: '',
    // 注意开发期间不加 hash，以免自动刷新失败
    chunkFilename: `js/chunk/chunk[name].${ mix.inProduction() ? '[chunkhash].' : '' }js`
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources', 'assets')
    }
  }
});

mix.js('resources/assets/admin/js/app.js', 'public/js');

mix.extract([
  'axios',
  'vue',
  'vue-router',
  'iview'
]);

mix.autoload({
  vue: ['Vue']
});

if (mix.inProduction()) {
  mix.version();
}

mix.babelConfig({});

mix.sass('resources/assets/admin/sass/app.scss', 'public/css/admin').options({
  processCssUrls: true
});

mix.copyDirectory('node_modules/iview/dist/styles/', 'public/css/admin');
mix.copyDirectory('resources/assets/admin/images', 'public/images/admin');