<template>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
                <input class="form-control" type="text"
                       placeholder="Name" v-model="signupForm.name">
            </div>
            <div class="form-group">
                <input class="form-control" type="text"
                       placeholder="Email Address" v-model="signupForm.email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password"
                       placeholder="Password" v-model="signupForm.password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary"
                        @click="signup">Signup</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'context' ],
    data() {
        return {
            signupForm: {
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        signup () {
            if (this.validated) {
                this.$http.post('/api/register', this.signupForm)
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
            return this.signupForm.name != '' && this.signupForm.email != ''
                    && this.signupForm.password != ''
        }
    }
}
</script>
