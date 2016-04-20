<template>
<div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" v-link="{ path: '/' }">FamilyTree</a>
            </div>
            <ul class="nav navbar-nav">
                <li v-show="!context.loggedIn" v-link="{ path: '/signup' }"><a>Signup</a></li>
                <li v-show="!context.loggedIn" v-link="{ path: '/login' }"><a>Login</a></li>
                <li v-show="context.loggedIn" v-link="{ path: '/people' }"><a>People</a></li>
                <li v-show="context.loggedIn" @click="logout"><a>Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <router-view :context="context"></router-view>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            context: {}
        }
    },
    created () {
        this.getContext()
    },
    methods: {
        getContext() {
            var self = this;
            this.$http.get('/api/context').then(function (response) {
                self.context = response.data
            })
        },
        logout() {
            this.$http.get('/api/logout')
                .then(function(response) {
                    this.getContext()
                    this.$route.router.go({ path: '/' })
                })
        }
    },
    events: {
        'logged-in': function () {
            this.getContext()
            this.$route.router.go({ path: '/people' })
        }
    }
}
</script>

<style lang="sass">
    .navbar {
        .nav {
            li {
                cursor: pointer;
            }
        }
    }
</style>
