import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import App from './vue/components/App.vue'

import Home from './vue/components/Home.vue'
import Signup from './vue/components/Signup.vue'
import Login from './vue/components/Login.vue'
import People from './vue/components/People.vue'

Vue.use(VueResource)
Vue.use(VueRouter)

export var router = new VueRouter({
    history: true,
    linkActiveClass: 'active'
})

router.map({
    '/': {
        component: Home
    },
    '/login': {
        component: Login
    },
    '/signup': {
        component: Signup
    },
    '/people': {
        component: People
    }
})

router.redirect({
    '*': '/'
})

router.start(App, '#app')

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');
