<template>
    <modal :show.sync="show" :on-close="close">
        <div class="modal-header">
            <p>Edit {{ person.first_name }} {{ person.last_name }}</p>
            <div class="close-modal pull-right" @click="close">X</div>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" type="text"
                               placeholder="First name" v-model="person.first_name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text"
                               placeholder="Last name" v-model="person.last_name">
                    </div>

                    <div class="form-group">
                        <select class="form-control" v-model="person.relation.mother_id">
                            <option value="0">Select Mother</option>
                            <option v-for="p in people" :value="p.id">
                                {{ p.first_name }} {{ p.last_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" v-model="person.relation.father_id">
                            <option value="0">Select Father</option>
                            <option v-for="p in people" :value="p.id">
                                {{ p.first_name }} {{ p.last_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" v-model="person.relation.spouse_id">
                            <option value="0">Select Spouse</option>
                            <option v-for="p in people" :value="p.id">
                                {{ p.first_name }} {{ p.last_name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer text-right">
            <button class="btn btn-primary" @click="update">Update</button>
        </div>
    </modal>
</template>

<script>
import Modal from '../shared/Modal.vue'

module.exports = {
    components: {
        'modal': Modal
    },
    props: [ 'show', 'person', 'people' ],
    data () {
        return {
            title: '',
            body: ''
        }
    },
    methods: {
        close () {
            this.show = false
            this.title = ''
            this.body = ''
        },
        update () {
            let self = this
            this.$http.post('/api/people/update/' + this.person.id, this.person)
                .then( function(response) {
                    self.$dispatch('update-people')
                    self.close()
                })
        },
    }
}
</script>
