<template>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
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
    <div class="row">
        <div class="col-md-12">
            <p v-for="person in people">{{ person.first_name }} {{ person.last_name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            addForm: {
                first_name: '',
                last_name: '',
                mother_id: '0',
                father_id: '0',
                spouse_id: '0'
            },
            people: {},
        }
    },
    created () {
        this.update();
    },
    methods: {
        add () {
            let self = this;
            this.$http.post('/api/people/add', this.addForm)
                .then( function(response) {
                    self.update();
                })
        },
        update () {
            this.$http.get('/api/people')
                .then(function (response) {
                    this.people = response.data;
                })
        }
    }
}
</script>
