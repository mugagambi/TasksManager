<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        My Tasks
                        <button class="btn btn-sm btn-outline-success float-right" @click="initAddTask()">Add Task</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive"
                               v-if="tasks.length > 0">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(task,index) in tasks">
                                <td>{{index + 1}}</td>
                                <td>{{task.name}}</td>
                                <td>{{task.description}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-success mb-1 mr-1">edit</button>
                                    <button class="btn btn-sm btn-outline-danger mr-1">remove</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Task",
        data () {
            return  {
                task: {
                    name: '',
                    description: ''
                },
                errors: [],
                tasks: [],
                update_task: {}
            }
        },
        mounted() {
            this.fetchTasks();
        },
        methods: {
            initAddTask: function () {

            },
            fetchTasks: function () {
                axios({
                    method: 'GET',
                    url: "/tasks",
                }).then(resp => {
                    this.tasks = resp.data.tasks
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>
