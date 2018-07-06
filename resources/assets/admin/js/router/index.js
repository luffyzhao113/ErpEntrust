import Vue from 'vue'
import VueRouter from 'vue-router'
import {IndexRouter} from './modules/index'
import {commonRouter} from './modules/common'
import iView from 'iview'
import CachePlugins from '../plugins/cache'
import Admin from '../views/layout/Admin.vue'
import Common from '../views/layout/Common.vue'


export const router = new VueRouter({
  routes: [
    {
      path: '/admin',
      icon: 'key',
      name: 'admin',  
      title: '后台模块',
      component: Admin,
      children: [...IndexRouter]
    },
    {
      path: '/common',
      icon: 'key',
      name: 'common',
      title: '公共模块',
      component: Common,
      children: [...commonRouter]
    }
  ]
})


router.beforeEach((to, from, next) => {
  iView.LoadingBar.start()
  if(to.matched.length > 0){
    // 判断当前是否是锁定状态
    if (CachePlugins.$cache.get('locking') === 1 && to.name !== 'common.lock') {
      next({name: 'common.lock'})
    } else if (CachePlugins.$cache.get('locking') === 0 && to.name === 'common.lock') {
      next({name: 'common.home'})
    } else {
      // 判断是否已经登录且前往的页面不是登录页
      if (!CachePlugins.$cache.get('token') && to.name !== 'common.login') {
        next({name: 'common.login'})
        // 判断是否已经登录且前往的是登录页
      } else if (CachePlugins.$cache.get('token') && to.name === 'common.login') {
        next({name: 'common.home'})
      } else {
        next()
      }
    }
  }else if(to.name === null && to.path === '/'){
    next({name: 'common.login'});
  }else if(to.matched.length === 0){
    next({name: 'common.error-404'})
  }else{
    next()
  }
})

router.afterEach((to) => {
  if(router.currentRoute.matched.length > 0 && to.matched[0].name === 'admin'){
    router.app.$store.commit('openPage', to)
  }
  iView.LoadingBar.finish()
  window.scrollTo(0, 0)
})
