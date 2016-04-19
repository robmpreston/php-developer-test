<template>
    <modal :show.sync="show" :on-close="close">
        <div class="modal-header">
            <h1>Add New Person</h1>
            <div class="close-modal flex-right">X</div>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" type="text"
                               placeholder="First name" v-model="addForm.first_name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text"
                               placeholder="Last name" v-model="addForm.last_name">
                    </div>

                    <div class="form-group">
                        <select class="form-control" v-model="addForm.mother_id">
                            <option value="0">Select Mother</option>
                            <option v-for="person in people" :value="person.id">
                                {{ person.first_name }} {{ person.last_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" v-model="addForm.father_id">
                            <option value="0">Select Father</option>
                            <option v-for="person in people" :value="person.id">
                                {{ person.first_name }} {{ person.last_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" v-model="addForm.spouse_id">
                            <option value="0">Select Spouse</option>
                            <option v-for="person in people" :value="person.id">
                                {{ person.first_name }} {{ person.last_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"
                                @click="add">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer text-right">
            <button class="btn btn-primary">Add</button>
        </div>
    </modal>
</template>

<script>
import Modal from '../shared/Modal.vue'

module.exports = {
    components: {
        'modal': Modal
    },
    props: [ 'show' ],
    data () {
        return {
            title: '',
            body: '',
            addForm: {
                first_name: '',
                last_name: '',
                mother_id: '0',
                father_id: '0',
                spouse_id: '0'
            },
        }
    },
    methods: {
        close () {
            this.show = false
            this.title = '';
            this.body = '';
        },
        add () {
            let self = this;
            this.$http.post('/api/people/add', this.addForm)
                .then( function(response) {
                    self.update()
                    this.$dispatch('update-people')
                })
        },
    }
}
</script>
