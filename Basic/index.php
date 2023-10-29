<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo List App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>

        [v-cloak] {
            display: none;
        }

    </style>

</head>

<body>

    <div class="bg-dark text-secondary px-4 py-5 text-center">
        <h1 class="display-5 fw-bold text-white">
            Basic ToDo List App
        </h1>
        <main class="form-signin w-100 m-auto" style="max-width: 500px;" id="todo" v-cloak="">
            <form v-on:submit.prevent>
                <div class="form-floating" class="form-control">
                    <input class="form-control" type="text" name="title" id="title" v-model="todo_data.title"></textarea>
                    <label class="floatingInput">Note Title</label>
                </div>
                <div class="form-floating" class="form-control">
                    <textarea class="form-control" name="description" col="5" id="description" v-model="todo_data.description"></textarea>
                    <label class="floatingInput">Enter your notes..</label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit" id="btnAdd" @click="addTodo()">Add</button>
                <button class="btn btn-primary w-100 py-2" type="submit" id="btnEdit" @click="editList('edit')">Edit</button>
            </form>

            <div class="alert alert-warning" role="alert" v-if="!lists.length">
                No Todo list found.
            </div>

            <table class="table table-striped text-center" style="max-width: 500px; margin-top: 10px" v-if="lists.length">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(list, i) in lists" :key="list.id">
                        <th scope="row">{{i+1}}</th>
                        <td>{{list.title}}</td>
                        <td>{{list.description}}</td>
                        <td><button class="btn btn-info" @click="editList('show', list.id, list.title, list.description)">Edit</button> <button class="btn btn-danger" @click="deleteTodo(list.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>

        </main>


    </div>
    </div>

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Vuejs -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <!-- BootstrapVue js -->
    <script type="text/javascript" src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>

    <!-- Axios -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script>
        const API = "api/api.php";
        $("#btnEdit").hide();
    </script>

    <script src="js/script.js"></script>


</body>

</html>