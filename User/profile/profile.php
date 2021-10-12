<?php  require "../../Admin/helpers/dbConnection.php";?>
<?php  require "../../Admin/helpers/helpers.php";


/**********************Firts Add user information to Db */
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $mobile     = CleanInputs($_POST['mobile']);
    $gov    = CleanInputs($_POST['gov']);
    $city = CleanInputs($_POST['city']);
    $zipcode  = CleanInputs($_POST['zipcode']);

    $errors = [];

    # Validate ... 
    if(!validate($mobile,1)){
      $errors['mobile'] = "mobile : Requierd Field";
    }elseif(!validate($mobile,7)){
     $errors['mobile'] = "mobile : Invalid Phone Number";
    }

    if(!validate($gov,1)){
      $errors['gov'] = " Governate : Requierd Field";
    }elseif(!validate($gov,2)){
      $errors['gov'] = "Governate : Invalid String";
    }

    if(!validate($city,1)){
     $errors['city'] = "City : Requierd Field";
    }elseif(!validate($city,2)){
      $errors['city'] = "City : Invalid String";
     }   
    if(!validate($zipcode,1)){
     $errors['zipcode'] = "ZipCode : Requierd Field";
      }elseif(!validate($zipcode,9)){
      $errors['zipcode'] = "ZipCode : Invalid Int";
     }   
    

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{
      
        $user_id = $_SESSION['user']['id']; 
        $sql = "INSERT INTO `information`(`mobile`, `gov`, `city`, `zipCode`, `user_id`) 
            values ('$mobile','$gov','$city','$zipcode','$user_id')";
        $op  = mysqli_query($con,$sql);
        # GET data ... 
    //   echo mysqli_error($con);
    //   exit();
      if($op){
         echo "<script>alert(Data Added Successfully !!)</script>";
      }else{
        $_SESSION['Errors'] = ["Error in sql OP Try Again"];
      }}

        $_SESSION['Message'] = $message;
      
    /********************************End Of User ****** **/

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


        <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
        <div class="container">
       
          <div class="row no-gutters block-9">
          
            <div class="col-md-12 order-md-last d-flex">
           
           
              <form  method="POST"  class="bg-light p-4 p-md-5 contact-form">
                <div class="form-group">
                  <input type="text" name="mobile" class="form-control" placeholder="Your Mobile">
                </div>

                <div class="form-group">
                  <input type="text"  name="gov" class="form-control" placeholder="Your Governate">
                </div>

                <div class="form-group">
                  <input type="text"  name="city" class="form-control" placeholder="Your City">
                </div>

                <div class="form-group">
                  <input type="number"  name="zipcode" class="form-control" placeholder="Your ZipCode">
                </div>

             
                <div class="form-group">
                  <input type="submit" value="Order" class="btn btn-primary py-3 px-5">
                </div>
              </form>
            
            </div>
  
         
          </div>
        </div>
      </section>
          


      

  
        <?php require "../Layouts/footer.php" ?>