<?php  require "../../Admin/helpers/dbConnection.php";?>
<?php  require "../../Admin/helpers/helpers.php";
# Fetch Roles Join Table Users With table Roles... 
$user_id = $_SESSION['user']['id'];


$id = sanitize($_GET['id'], 1);
$error = [];
if (!validate($id, 6)) {
    $error['id'] = "Invalid Integar";
}

if (count($error) > 0) {
    $_SESSION['Errors'] = $error;
}

if(count($errors) > 0){
    $_SESSION['Errors'] = $errors;
}else{
    // $user_id = $_SESSION['user']['id'];
    $sqlbook = "INSERT INTO `reservebook`(`reservationDate`, `user_id`, `book_id`,`status`) VALUES
        (NOW(),'$user_id','$id','0')";
        $opbook  = mysqli_query($con,$sqlbook);


  if($opbook){
     echo "<script>alert(Item Added Successfully)</script>";
      $_SESSION['Message'] = $message; 
     header("Location:index.php");   

  }else{
      $message = ["Error in sql OP Try Again"];
      $_SESSION['Errors'] = $message;
   
  }
}


?>

<?php require "../Layouts/header.php" ?>

 

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
          <div class="container">
            <a class="navbar-brand" href="#">Books<span>.</span></a>
            <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="oi oi-menu"></span> Menu
            </button>
  
            <div class="collapse navbar-collapse" id="ftco-nav">
              <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="<?php echo Furl('index.php') ?>" class="nav-link"><span>Home</span></a></li>
                <li class="nav-item"><a href="<?php echo Furl('index.php') ?>" class="nav-link"><span>About</span></a></li>
                <li class="nav-item"><a href="<?php echo Furl('index.php') ?>" class="nav-link"><span>Reviews</span></a></li>
                <li class="nav-item"><a href="<?php echo Furl('index.php') ?>" class="nav-link"><span>Books</span></a></li>
                <li class="nav-item"><a href="<?php echo Furl('index.php') ?>" class="nav-link"><span>Contact</span></a></li>
                <?php if(isset($_SESSION['user'])) { ?>
                  <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['user']['name']; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo Furl('profile/profile.php') ?>">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo Furl('profile/index.php') ?>">Cart</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo Furl('logout.php');?>">Logout</a>
                    </div>
                </li>
            </ul>
                <?php }else {?>
                
                <li class="nav-item"><a href="signup.php" class="nav-link"><span>Register</span></a></li>
                <li class="nav-item"><a href="login.php" class="nav-link"><span>Login</span></a></li>
                <?php }?>
              </ul>
            </div>
          </div>
        </nav>
        <section class="ftco-section ftco-project" id="projects-section">
        <div class="container">
                    <h3 class="text-dark mb-4"></h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold"> User ORDER</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th># Order</th>
                                            <th>Book Name</th>
                                            <th>Price</th>
                                            <th>ISBN Number</th>
                                            <th>Book Cover</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                    $sql = "select reservebook.*  , books.* from reservebook 
                                    join books on reservebook.book_id=books.id and reservebook.user_id = '$user_id';
                                   ";
                            $op  = mysqli_query($con,$sql);
                            // echo mysqli_error($con);
                            // exit();
                                    $i = 0;
                                    while($data = mysqli_fetch_assoc($op)){
                                 ?>       
                                          <tr>
                                               <td><?php echo ++$i;?></td>
                                               <td><?php echo $data['book_name'];?></td> 
                                               <td><?php echo $data['price'];?></td>  
                                               <td><?php echo $data['ISBNNumber'];?></td> 
                                               <td><img src="<?php echo url('Books/uploads/') ?><?php echo $data['book_cover'];?>" width="100" height="100"></td> 
                                               <td>
                                               <button class='<?php if($data['status']=='0') {echo "btn btn-danger m-r-1em";} else {echo "btn btn-primary m-r-1em";} ?>'>
                                               <?php if($data['status']=='0') {echo "Pending";} else {echo "Approved";}?></a>
                                           </td> 
                                                <td>
                                               <a href='<?php echo Furl('profile/delete.php?id=') ?><?php echo $data['book_id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                </td>
                                                                                   
                                            </tr>
                                <?php } ?>        
                             
                                
                                    </tbody>
                                </table>
                            <!-- </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                </section>

  
        <?php require "../Layouts/footer.php" ?>