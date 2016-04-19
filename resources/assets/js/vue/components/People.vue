<template>
    <add-modal :show="showAdd"></add-modal>
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
                    <td>{{ person.first_name }}{{ person.last_name }}</td>
                    <td>
                        <a @click="edit(person)">Edit</a>
                        <a @click="view(person)">View</a>
                    </td>
                </tr>
            </table>
            <p v-for="person in people">{{ person.first_name }} {{ person.last_name }}</p>
        </div>
    </div>
</template>

<script>
import AddModal from './People/AddModal.vue'
//import EditModal from './People/EditModal.vue'

export default {
    components: {
        'add-modal': AddModal,
    //    'edit-modal': EditModal
    },
    data () {
        return {
            people: {},
            showAdd: false,
            showEdit: true,
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
            this.showAdd = true;
        },
        edit (person) {
            this.editData = person;
            this.showEdit = true;
        }
    },
    events: {
        'update-people': function () {
            this.update()
        }
    }
}
</script>
