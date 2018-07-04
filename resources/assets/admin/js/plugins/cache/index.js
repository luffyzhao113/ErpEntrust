import Storage from 'web-storage-cache'

const cache = new Storage({
  storage: 'localStorage'
});

export default {
  install (Vue) {
    Vue.prototype.$cache = cache
    Vue.cache = cache
  },
  $cache: cache
}

export const $cache = cache