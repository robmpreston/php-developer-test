<template>
    <div v-show="context.loggedIn">
        <add-modal :show.sync="showAdd" :people="people"></add-modal>
        <edit-modal :show.sync="showEdit" :people="people" :person="editData"></edit-modal>
        <div class="row">
            <div class="col-md-12">
                <button @click="add" class="btn btn-primary">Add Person</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Person</th>
                        <th>Actions</th>
                    </tr>
                    <tr v-for="person in people">
                        <td>{{ person.first_name }} {{ person.last_name }}</td>
                        <td>
                            <a @click="edit(person)">Edit</a>
                            <a @click="view(person)">View</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div v-show="!context.loggedIn">
        <p>You must be logged in to view this page</p>
    </div>
</template>

<script>
import AddModal from './People/AddModal.vue'
import EditModal from './People/EditModal.vue'

export default {
    props: [ 'context' ],
    components: {
        'add-modal': AddModal,
        'edit-modal': EditModal
    },
    data () {
        return {
            people: {},
            showAdd: false,
            showEdit: false,
            editData: {}
        }
    },
    created () {
        this.update()
    },
    methods: {
        update () {
            this.$http.get('/api/people')
                .then(function (response) {
                    this.people = response.data
                })
        },
        add () {
            this.showAdd = true
        },
        edit (person) {
            this.editData = person
            this.showEdit = true
        }
    },
    events: {
        'update-people': function () {
            this.update()
        }
    }
}
</script>
