<template>
    <div v-show="context.loggedIn">
        {{{ tree }}} 
    </div>
    <div v-show="!context.loggedIn">
        <p>You must be logged in to view this page</p>
    </div>
</template>

<script>
export default {
    props: [ 'context' ],
    data () {
        return {
            tree: {},
            personId: 0
        }
    },
    created () {
        this.personId = this.$route.params.personId
        this.get()
    },
    methods: {
        get () {
            this.$http.get('/api/people/tree/' + this.personId)
                .then(function (response) {
                    this.tree = response.data
                })
        }
    }
}
</script>
