<template>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <input class="form-control" type="text"
                   placeholder="Email Address" v-model="loginForm.email">
        </div>
        <div class="form-group">
            <input class="form-control" type="password"
                   placeholder="Password" v-model="loginForm.password">
        </div>
        <div class="form-group">
            <button class="btn btn-primary"
                    @click="login">Login</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: [ 'context' ],
    data() {
        return {
            loginForm: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login () {
            if (this.validated) {
                this.$http.post('/api/login', this.loginForm)
                    .then(function ( response ) {
                        if (response.data.success == true) {
                            this.$dispatch('logged-in')
                        }
                    })
            }
        }
    },
    computed: {
        validated () {
            return this.loginForm.email != ''
                    && this.loginForm.password != ''
        }
    }
}
</script>
