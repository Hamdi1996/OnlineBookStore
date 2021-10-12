<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles ... 
$sql = "select * from role";
$select_op  = mysqli_query($con,$sql);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name     = CleanInputs($_POST['name']);
    $email    = CleanInputs($_POST['email']);
    $password = CleanInputs($_POST['password']);
    $role_id  = CleanInputs($_POST['role_id']);

    $errors = [];

    # Validate ... 
    if(!validate($name,1)){
      $errors['Name'] = "Name : Requierd Field";
    }elseif(!validate($name,2)){
     $errors['Name'] = "Name : Invalid String";
    }

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
    if(!validate($role_id,1)){
     $errors['Role'] = "Role : Requierd Field";
      }elseif(!validate($role_id,6)){
      $errors['Role'] = "Role : Invalid Int";
     }   
    

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{

      $password = md5($password);
     
      $sql = "insert into users (name,email,passwordd,role_id) values ('$name','$email','$password','$role_id')";
      $op  = mysqli_query($con,$sql);
    //   echo mysqli_error($con);
      // exit();
      if($op){
          $message = ["Data Added Successfully !!"];
      }else{
        $_SESSION['Errors'] = ["Error in sql OP Try Again"];
      }

        $_SESSION['Message'] = $message;


    }  



}

 require '../Layouts/header.php';
 require '../Layouts/topNav.php';
?>

<div id="layoutSidenav">

    <?php 
    require '../Layouts/sidNav.php';
 ?>
    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid">

                <h1 class="mt-4">Dashboard </h1>
                    <?php 
                      printMessages('Add Admin || User');
                     ?>
                <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                    enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby=""
                            placeholder="Enter Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Role</label>
                        <select name="role_id" class="form-control">

                            <?php while($result = mysqli_fetch_assoc($select_op)){?>
                            <option value="<?php echo $result['id'];?>"><?php echo $result['title'];?></option>
                            <?php }?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>


            </div>
        </main>

        <?php   
  require '../Layouts/footer.php';

?>