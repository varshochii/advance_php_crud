
    ///////////////////////////////////////////////
    /////// function for pagination 
    function pagination(totalpages,currentpages){

         var pageList = "";
      
         if(totalpages > 1){
            currentpages = parseInt(currentpages);

            pageList += `<ul class="pagination justify-content-center">`;

            const prevClass = currentpages == 1 ? "disabled" : "";

            pageList += `<li class="page-item ${prevClass}"><a class="page-link" href="#" data-page="${currentpages - 1}">Previous</a></li>`;

            for(let p = 1; p <= totalpages; p++){

              const activeClass = currentpages == p ? "active" : "";
                
              pageList += `<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
            }


            const nextClass = currentpages == totalpages ? "disabled" : "";

            pageList += `<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page="${currentpages + 1}">Next</a></li>`;
            pageList += `</ul>`;
         }

         $('#pagination').html(pageList);
    } 


    ///////////////////////////////////////////////
    /////// function to get user from database 
    function getUserRow(user){
       
         var userRow = "";
         if(user){
            userRow = `  <tr>
                            <td><img src="./uploads/${user.photo}" style="width:100px;height:100px;object-fit:cover"></td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.mobile}</td>
                            <td>

                                <a href="#" class="mr-3 profile" data-target="#userViewModal" data-toggle="modal" title="View Profile" data-id="${user.id}"><i class="fas fa-eye text-success"></i></a>

                                <a href="#" class="mr-3 edituser" title="Edit Profile" data-target="#usermodal" data-toggle="modal" data-id="${user.id}"><i class="fas fa-edit text-info"></i></a>

                                <a href="#" class="mr-3 deleteuser" title="Delete Profile" data-id="${user.id}" onclick="return confirm('are you sure,delete this user?')"><i class="fas fa-trash-alt text-danger"></i></a>

                            </td>
                     </tr>`;
            }

            return userRow;
    }


    ///////////////////////////////////////////////
    /////// get users function 
        function getUsers(){

          var pageno = $('#currentpage').val();
           
           $.ajax({
              url: 'http://localhost/----SMALL-PROJECTS----/advance-crud/ajax.php',
              type: 'GET',
              dataType: 'json',
              data: {page: pageno,action: 'getallusers'},
              beforeSend: function(){
                  console.log('Wait... Data is loading');
                },
              success: function(rows){
                  // console.log(rows);
                  if(rows.users){
                       var userList = '';
                       $.each(rows.users, function(index,user){
                           userList += getUserRow(user);
                       })

                       $('#usertable tbody').html(userList);

                       let totalUsers   = rows.count;
                       let totalPages   = Math.ceil(parseInt(totalUsers) / 4); 
                       let currentpages = $('#currentpage').val();
                       pagination(totalPages,currentpages);
                  }
              },
              error: function(request,error){
                  console.log(arguments);
                  console.log("Error:" + error); 
              }
           })
      }




$(document).ready(function(){

      ////////// adding users //////////
      $(document).on('submit','#addform', function(event){
          event.preventDefault();

           // var formdata = new FormData($(this)[0]);

           var msg = $('#userId').val().length > 0 ? "User has been updated successfully!" : "New user has been added successfully!";

           $.ajax({
               url: 'http://localhost/----SMALL-PROJECTS----/advance-crud/ajax.php',
               type: 'POST',
               dataType: 'json',
               data: new FormData(this),
               processData: false,
               contentType: false,
               beforeSend: function(){
                 console.log('Wait... Data is loading');
               },
               success: function(response){
                   console.log(response);
                   if(response){
                     $('#usermodal').modal("hide");
                     $('#addform')[0].reset();
                     $('.displaymessage').html(msg).fadeIn().delay(2500).fadeOut();
                     getUsers();
                   }
               },
               error: function(request,error){
                   console.log(arguments);
                   console.log("Error:" + error); 
               }
           })
      });


      ////// on click event for pagination /////////
      $(document).on('click','ul.pagination li a', function(event){
         
            event.preventDefault();
            const pagenum = $(this).data('page');
            $('#currentpage').val(pagenum);

            getUsers();
      });



      //////// onclick event for editing /////////
      $(document).on('click','a.edituser', function(){

          var uid = $(this).data('id');

          $.ajax({
            url: 'http://localhost/----SMALL-PROJECTS----/advance-crud/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {userId: uid,action: 'editusersdata'},
            beforeSend: function(){
              console.log('Waiting...');
            },
            success: function(row){
                console.log(row);
                if(row){
                    $('#username').val(row.name);
                    $('#email').val(row.email);
                    $('#mobile').val(row.mobile);
                    $('#userId').val(row.id);
                }
            },
            error: function(request,error){
                console.log(arguments);
                console.log("Error:" + error); 
            }
        })
          
      })


      ///////////// click on add user to reset the form and prepare it for adding new user
      $('#adduserBtn').on('click',function(){
          $('#addform')[0].reset();
          $('#userId').val("");
      })


      /////// onclick event for deleting 
      $(document).on('click','a.deleteuser', function(e){
           e.preventDefault();
           var uid = $(this).data('id');

           $.ajax({
              url: 'http://localhost/----SMALL-PROJECTS----/advance-crud/ajax.php',
              type: 'POST',
              dataType: 'json',
              data: {userId: uid,action: 'deleteUser'},
              beforeSend: function(){
                console.log('Waiting...');
              },
              success: function(res){
                console.log(res);
                  if(res.delete == 1){
                     $('.displaymessage').html("User deleted successfully!").fadeIn().delay(2500).fadeOut(); 
                     getUsers();
                  }
              },
              error: function(error){ 
                 console.log("Error:" + error);
                 console.log("oops: something went wrong..."); 
             }
           })
      });


      //////// profile view 
      $(document).on('click','a.profile',function(){

          var uid = $(this).data('id');

          $.ajax({
              url: 'http://localhost/----SMALL-PROJECTS----/advance-crud/ajax.php',
              type: 'POST',
              dataType: 'json',
              data: {userId: uid,action: 'editusersdata'},
              success: function(user){
                 if(user){
                      const profile = `<div class="row">
                                          <div class="col-sm-6 col-md-4">
                                             <img src="uploads/${user.photo}" alt="Image" class="rounded" style="width:100px;height:100px;object-fit:cover;">
                                          </div> 
                                          <div class="col-sm-6 col-md-8">
                                             <h4 class="text-primary">${user.name}</h4>
                                             <p>
                                               <i class="fas fa-envelope-open text-primary"></i> ${user.email}
                                               <br>
                                               <i class="fas fa-phone text-primary"></i> ${user.mobile}
                                             </p>
                                          </div>
                                       </div>`;

                         $('#profile').html(profile);
                 }
              },
              error: function(error){
                console.log('something went wrong...');
                console.log("Error:" + error); 
              }
          })
      });



      /////////// search user 
      $(document).on('keyup','#searchInput',function() {
          
            const searchText = $(this).val();
            
            if(searchText.length > 1){
               
                 $.ajax({
                    url: 'http://localhost/----SMALL-PROJECTS----/advance-crud/ajax.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {searchQuery: searchText, action: 'searchuser'},
                    success: function(users) {
                      console.log(users);
                        if(users){
                          var usersList = '';
                          $.each(users, function(index,user){
                              usersList += getUserRow(user);
                          });
                          $('#usertable tbody').html(usersList);
                          $("#pagination").hide();
                        }
                    },
                    error: function(error){
                      console.log('something went wrong...');
                      console.log("Error:" + error); 
                    }
                 })
            }else{

                getUsers();
                $("#pagination").show();
            }
            
      })


        ///// calling getUsers function
        getUsers();


        ///////////////////////////////////////////////
});