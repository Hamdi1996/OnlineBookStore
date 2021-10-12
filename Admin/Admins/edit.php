<?php 

require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles ... 
$sql = "select * from role";
$select_op  = mysqli_query($con,$sql);


# ID & Validate ...  
$_SESSION['del_falg'] = 0;

# GET data ... 

$id = sanitize($_GET['id'],1);

$error = [];
if(!validate($id,6)){
    $error['id'] = "Invalid Integar";
}

if(count($error) > 0){
     $_SESSION['Errors'] = $error;
     $_SESSION['del_falg'] = 1;
     header("Location: index.php");
}

# Fetch User Data
$sql = "select * from users where id=".$id;
$op  = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($op);
  
if(mysqli_num_rows($op) == 0){
    $_SESSION['Errors'] = ["No data For this Id"];
    $_SESSION['del_falg'] = 1;
    header("Location: index.php");
}



if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name     = CleanInputs($_POST['name']);
    $email    = CleanInputs($_POST['email']);
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

        if(!validate($role_id,1)){
            $errors['Role'] = "Role : Requierd Field";
           }elseif(!validate($role_id,6)){
             $errors['Role'] = "Role : Invalid Int";
          }   

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{

     //$password = md5($password);
     
         
      $sql = "update users  set name = '$name' ,email = '$email',role_id = $role_id where id =".$id;
      $op  = mysqli_query($con,$sql);

      if($op){
          $message = ["Data Updated"];
          $_SESSION['Message'] = $message;
          $_SESSION['del_falg'] = 1;
          header("Location: index.php");
          exit();
      }else{
          $message = ["Error in sql OP Try Again"];
      }
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
                      printMessages('Update Admin | | Users');
                     ?>

                <form method="post" action="edit.php?id=<?php echo $data['id'];?>"
                    enctype="multipart/form-data">



                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" value="<?php echo $data['name'];?>" class="form-control" id="exampleInputName" aria-describedby=""
                            placeholder="Enter Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email"  value="<?php echo $data['email'];?>"  class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Role</label>
                        <select name="role_id" class="form-control">
                           
                            <?php while($result = mysqli_fetch_assoc($select_op)){?>
                            <option value="<?php echo $result['id'];?>" <?php if($data['role_id'] == $result['id']){ echo 'selected';} ?>><?php echo $result['title'];?></option>
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