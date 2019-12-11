<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        My Tasks
                        <button class="btn btn-sm btn-outline-success float-right" @click="initAddTask()">Add Task
                        </button>
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
                        <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Task</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                             v-if="errors.length > 0">
                                            <ul>
                                                <li v-for="error in errors">{{error}}</li>
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Task Name:</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   v-model="task.name"
                                                   placeholder="Task Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Task Description:</label>
                                            <textarea name="description" class="form-control" id="description" cols="30"
                                                      rows="10"
                                                      v-model="task.description">
                                                Enter the description
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Task",
        data() {
            return {
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
                $('#add_task_model').modal('show')
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
