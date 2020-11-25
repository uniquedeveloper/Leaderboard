<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
    	@if (count($errors) > 0)
		   <div class = "alert alert-danger">
		      <ul>
		         @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
		         @endforeach
		      </ul>
		   </div>
		@endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div id="app" class="flex-center position-ref full-height">
            <table class="table table-stripped" id="empDetials">
                <thead>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Points</th>
                </thead>
                <tbody>
                    
                        <tr v-for="(emp,index) in employees">
                            <td>
                                <a @click="deleteEmployee(index)"  class="btn-flat"><i class="material-icons">delete</i></a>
                            </td>
                            <td>
                            	<a  @click="showUser(index)"> 
                            		@{{emp['name']}}
                            	</a>
                            </td>
                            <td>
                            	<a class="btn" @click="removePoints(index)">
                            		<i class="material-icons">remove</i>
                            	</a>
                            	<p>@{{emp['points']}}</p>
                            	<a class="btn"  @click="addPoints(index)">
                            		<i class="material-icons">add</i>
                            	</a>
                            </td>
                        </tr>
                   
                </tbody>
                
            </table>
           <a class="btn waves-light btn " @click="addUser()"> Add User </a>
           <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                     <h4>Add / Update User</h4>
                    <form :action="url" method="POST">
   
                    
                        @csrf
                        
                        <p> Name: <input type="text" name="name" :value="employee['name']"></p>
                        <p> Age: <input type="text" name="age" :value="employee['age']"></p>
                        <p> Address: <input type="text" name="address" :value="employee['address']"></p>
                        <p> Points: @{{employee['points']}}</p>
          
                        <button type="submit" class="btn-flat">Add/Update</button>
                    </form>
                  </div>
            </div>
        </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
   
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var app = new Vue({
                  el: '#app',
                  data: {
                    message: 'Hello Vue!',
                    employees: {!! json_encode($employees) !!},
                    employee: [],
                    url:"",

                  },
                  mounted: function(){
	                this.sortEmployees();
                    M.AutoInit();
                  },
                  methods:{
                    showUser: function(id=""){
                        var app = this;
                        app.employee =  app.employees[id];
                        app.url = "employees/new/"+app.employee['id'];
                        $('#modal1').modal('open');
                    },
                    sortEmployees:function(){
                        var app = this;
                        app.employees.sort(function(a, b) {
                          var nameA = a.points; 
                          var nameB = b.points; 
                          if (nameA > nameB) {
                            return -1;
                          }
                          if (nameA < nameB) {
                            return 1;
                          }

                          // names must be equal
                          return 0;
                        });
                    },
                    deleteEmployee: function(id="")
                    {
                        $.ajax({
                           type:'DELETE',
                           url:'/employees/delete/' + app.employees[id]['id'],
                           data:{},
                           success:function(data) {
                            document.getElementById("empDetials").deleteRow(id+1);
                           }
                        });
                        this.sortEmployees();
                    },
                    addUser: function(){
                        var app = this;
                        app.employee = [];
                         app.url = "employees/new/";
                        $('#modal1').modal('open');
                    },
                    removePoints: function(id='')
                    {

                        var app = this;
                        if(app.employees[id]['points'] > 0)
                        {

	                       app.employees[id]['points']--;
	                       app.updateEmployee(app.employees[id]);
                        }
                        app.sortEmployees();
                       
                    },
                    updateEmployee: function(employee = []){
                    	var app = this;
                    	$.ajax({
                           type:'POST',
                           url:'/employees/edit/' + employee['id'],
                           data:{'id':employee['id'],'points': employee['points']},
                           success:function(data) {
                           }
                        });
                    },
                    addPoints: function(id='')
                    {
                        var app = this;
                       app.employees[id]['points']++;
                       app.updateEmployee(app.employees[id]);
                       app.sortEmployees();
                    },
                    
                  },
                })
    </script>
    </body>
</html>
