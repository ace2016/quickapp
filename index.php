<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo List App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

</head>

<body>

    <div class="bg-dark text-secondary px-4 py-5 text-center">
        <h1 class="display-5 fw-bold text-white">
            Basic ToDo List App
        </h1>
        <main class="form-signin w-100 m-auto" style="max-width: 500px;" id="todo">
            <form>
                <div class="form-floating" class="form-control">
                    <input class="form-control" type="text" name="name" id="name" v-model="todo_data.name"></textarea>
                    <label class="floatingInput">Note Name</label>
                </div>
                <div class="form-floating" class="form-control">
                    <textarea class="form-control" name="description" col="5" id="description" v-model="todo_data.description"></textarea>
                    <label class="floatingInput">Enter your notes..</label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Add</button>
            </form>

            <table class="table table-striped text-center" style="max-width: 500px; margin-top: 10px">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>{{todo_data.name}}</td>
                        <td>{{todo_data.description}}</td>
                        <td><button class="btn btn-info">Edit</button> <button class="btn btn-danger">Delete</button></td>
                    </tr>
                </tbody>
            </table>

        </main>


    </div>
    </div>

    <!-- Vuejs -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	
    <!-- BootstrapVue js -->
    <script type="text/javascript" src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
        
    <!-- Axios -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!--<script src="js/script.js"></script>-->
    <script>

        var app = new Vue({
            el: '#todo',
            data: {
                todo_data: { name:'', description:'' }
            },

            mounted: function(){
                //method for hot refresh
                this.getList();
            },
            
            methods: {
                //method for hot refresh
                getList(){

                },

                //initial method - default for all form
                toFormData: function(obj){
                    var form_data = new FormData();
                    for(var key in obj){
                        form_data.append(key, obj[key]);
                    }
                    return form_data;
                },
            },
        });

    </script>

</body>

</html>