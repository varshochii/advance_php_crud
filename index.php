
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Advance CRUD</title>

    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>
<body>


<h1 class="bg-dark text-light text-center py-2">PHP advance CRUD</h1>


<!----------- form --------------->
<div class="container">

<!-------- display message  ------->
<div class="displaymessage text-center bg-dark text-light mb-3"></div>

<!-- form modal -->
<?php include './form.php'; ?>


   
<!-- input search and button -->
    <div class="row my-3">
    
        <div class="col-10">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark"><i class="fas fa-search text-light"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Search user..." id="searchInput">
            </div>
        </div>

        <div class="col-2">
            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#usermodal" id="adduserBtn">Add New User</button>
        </div>
    
    </div>



<!-------------- table  -------------->
<?php include './table.php'; ?>


<!------------ profile view modal  -------->
<?php include './profile.php'; ?>



<!------ pagination ------->
<nav aria-label="Page navigation example" id="pagination">
  <!-- <ul class="pagination justify-content-center">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul> -->
</nav>
<input type="hidden" value="1" name="currentpage" id="currentpage">


<!----------- End of Container ----------->
</div>







<!-- jquery cdn link -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<!------ js file ------>
<script src="./js/script.js"></script>

</body>
</html>