<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <center class="mb-2 mt-2"><h1>Crud app</h1></center>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Button trigger modal -->
                    <button type="button" id="mybutton1" class="btn btn-primary" data-toggle="modal" data-target="#myform1">
                        Add User
                    </button>



            </div>
        </div>
        <div class="row mt-3">

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="myTableBody">
                  
                         
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        
    </div>
    <div class="modal fade" id="myform1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="">
                    <div class="modal-body">
                   
                       
                                <input type="text" id="user-name" class="form-control my-2" placeholder="First name">
                          
                                <input type="text" id="user-surname" class="form-control my-2" placeholder="Last name">
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="user-add" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myform2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <input type="hidden" id="last-user-id">
                   
                       
                        <input type="text" id="last-user-name" class="form-control my-2" placeholder="First name">
                    
                        <input type="text" id="last-user-surname" class="form-control my-2" placeholder="Last name">
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  id="user-edit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    


    






    

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
   


    <script>

    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        

        $.ajax({
            url:'{{route("getUser")}}',
            type:"post",
            dataType:"json",
        
            success:function(response){
                
                response.myuser.forEach(element => {
                    
                    let htmlTxt = `
                    <tr id="myuser${element.id}">
                        <th scope="row">${element.id}</th>
                        <td>${element.name}</td>
                        <td>${element.surname}</td>
                        <td>${element.created_at}</td>
                        <td>${element.updated_at}</td>
                        <td>
                            <button type="button" onclick="editUser(${element.id})" class="btn btn-success" data-toggle="modal" data-target="#myform2">E</button>
                        </td>
                        <td>
                            <button type="button" onclick = "deleteuser(${element.id})" class="btn btn-danger">X</button>
                        </td>
                    </tr> `;

                    $('#myTableBody').append(htmlTxt);

                    
                    
                });
            },
            error:function(reject){
                console.log(reject);
            }
        })


    });

    deleteuser = (id)=>{
        if(confirm('?')){
            $.ajax({
                url:`/user-delete/${id}`,
                type:"DELETE",
                success:function (response) {
                   
                    $(`#myuser${id}`).remove();
                    
                },
                error:function(reject){
                    console.log(reject)

                }
            })
            
            
        }
        
    }

    $('#mybutton1').click(function(){
        $('#user-name').val('');
        $('#user-surname').val('');
    })
    $('#user-add').click(function(){
        let userName = $('#user-name').val();
        let userSurname = $('#user-surname').val();
        if(userName == "" || userSurname == ""){
           alert('error');
        }
        else{

            $.ajax({
                url:'{{route("addUser")}}',
                type:"POST",
                dataType:"json",
                data:{
                    'name':userName,
                    'surname':userSurname
                },
                success: function(response){
                   let myHtmltext = `
                    <tr id="myuser${response.copyUser.id}">
                        <th scope="row">${response.copyUser.id}</th>
                        <td>${response.copyUser.name}</td>
                        <td>${response.copyUser.surname}</td>
                        <td>${response.copyUser.created_at}</td>
                        <td>${response.copyUser.updated_at}</td>
                        <td>
                            <button type="button" onclick="editUser(${response.copyUser.id})" class="btn btn-success" data-toggle="modal" data-target="#myform2">E</button>
                        </td>
                        <td>
                            <button type="button" onclick="deleteuser(${response.copyUser.id})" class="btn btn-danger">X</button>
                        </td>
                    </tr> `;
                    $('#myTableBody').append(myHtmltext);


                },
                error:function(reject){
                    console.log(reject);

                }
        

            })


           
           
            $('.modal').modal('hide')
        }

       
        
    })

    $('#user-edit').click(function(){
        let userName = $('#last-user-name').val();
        let userSurname = $('#last-user-surname').val();
        let userId = $('#last-user-id').val();
        if(userName == "" || userSurname == ""){
           alert('error');
        }
        else{
            

            $.ajax({
                url:'{{route("editUserPost")}}',
                type:"PUT",
                dataType:"json",
                data:{
                    'id':userId,
                    'name':userName,
                    'surname':userSurname
                },
                success:function(res){
                    let myHtmltext = `
                    <th scope="row">${res.user.id}</th>
                    <td>${res.user.name}</td>
                    <td>${res.user.surname}</td>
                    <td>${res.user.created_at}</td>
                    <td>${res.user.updated_at}</td>
                    <td>
                        <button type="button" onclick="editUser(${res.user.id})" class="btn btn-success" data-toggle="modal" data-target="#myform2">E</button>
                    </td>
                    <td>
                        <button type="button" onclick="deleteuser(${res.user.id})" class="btn btn-danger">X</button>
                    </td>`;
                    $(`#myuser${res.user.id}`).html(myHtmltext);
                    


                    

                },
                error:function(rej){
                    console.log(rej);

                }

            })

            $('.modal').modal('hide')
        }
        
    })
   
    editUser = (id) =>{
        $.ajax({
            url:'{{route("editUserGet")}}',
            type:'POST',
            data:{
                'id':id
            },
            dataType:'json',
            success:function(res){
                $('#last-user-id').val(res.user.id);
                $('#last-user-name').val(res.user.name);
                $('#last-user-surname').val(res.user.surname);



            },
            error:function(rej){
                console.log(rej);

            }
        })

    }


    </script>


  </body>
</html>