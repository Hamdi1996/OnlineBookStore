<?php 
require "../Admin/helpers/dbConnection.php";
require "../Admin/helpers/helpers.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email    = CleanInputs($_POST['email']);
    $password = CleanInputs($_POST['password']);


    $errors = [];

    if(!validate($email,1)){
        $errors['email'] = " Email : Requierd Field";
      }elseif(!validate($email,3)){
          $errors['email'] = "Email : Invalid Email";
      }

      if(!validate($password,1)){
        $errors['Password'] = "Password : Requierd Field";
      }elseif(!validate($password,5)){
          $errors['Password'] = "Password : Invalid Length , Length must Be >= 6 CH";
        }  


        if(count($errors) > 0){
            $_SESSION['Errors'] = $errors;
        }else{
             // login code .... 
        //   $role = "SELECT title FROM role";
        //   $roleselect =mysqli_query($con,$role);
        //   $roletit = mysqli_fetch_assoc($roleselect);


          $password = md5($password);
          $sql = "select * from users where email ='$email' and passwordd = '$password' and role_id='2'";
          $op  = mysqli_query($con,$sql);
          if(mysqli_num_rows($op) == 1){
              // continue ....
             $_SESSION['user'] = mysqli_fetch_assoc($op);

             header("Location: ".Furl('index.php'));
          }else{

            $_SESSION['Errors'] = ['Error in Your Credentials try Again .... '];
          }
        }

 }








 require "../Admin/Layouts/header.php";
 ?>
<body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Login </h3></div>

                                    <div class="card-body">
                                    <?php if(isset($_SESSION['Errors'])){printMessages();}else{echo " ";}?>
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                            
                                        <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" 
                                                id="inputEmailAddress"
                                                name="email" 
                                                type="email" 
                                                placeholder="Enter email address" />
                                        </div>

                                        <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" 
                                                 id="inputPassword"   
                                                 name="password" 
                                                 type="password" 
                                                 placeholder="Enter password" />
                                            </div>

                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary"value="Login">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
          
<div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Library Management System 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php url('asset/js/scripts.js')?>"></script>
    </body>
</html>
