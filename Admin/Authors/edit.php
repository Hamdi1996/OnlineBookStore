<?php 

require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles ... 
$sql = "select * from author";
$select_op  = mysqli_query($con,$sql);

$_SESSION['del_falg'] = 0;

# GET data ... 

$id = sanitize($_GET['id'],1);

$error = [];
if(!validate($id,6)){
    $error['id'] = "Invalid Integar";
}

if(count($error) > 0){
     $_SESSION['Message'] = $error;

     header("Location: index.php");
}

# Fetch Data Based On Id ... 

$sql = "select * from author where id =".$id;
$op  = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($op); 


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $auther_name   = CleanInputs($_POST['name']);
    $author_bio    = CleanInputs($_POST['bio']);

    $errors = [];
    # Validate ... 
    if(!validate($auther_name,1)){
        $errors['Author_name'] = " Author_name : Requierd Field";
      }elseif(!validate($auther_name,2)){
          $errors['Author_name'] = "Author_name : Invalid String";
        }
  
      //   Validate Category
      if(!validate($author_bio,1)){
        $errors['Bio'] = "Requierd Field";
      }elseif(!validate($author_bio,2)){
          $errors['Bio'] = "Invalid String";
        }

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{
      $sql = "UPDATE author set `name` ='$auther_name' ,`biography`='$author_bio'  where id=".$id;
      $op  = mysqli_query($con,$sql);

      if($op){
          $message = ["Author Updated Successfully"];
          $_SESSION['Message'] = $message;    
          $_SESSION['del_falg'] = 1;

      }else{
          $message = ["Error in sql OP Try Again"];
          $_SESSION['Errors'] = $message;
       
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
                      printMessages('Update Book Author');
                     ?>
                <form method="post" action="edit.php?id=<?php  echo $data['id']; ?>"
                    enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Author Name </label>
                        <input type="text" name="name"
                        value="<?php echo $data['name'];?>"
                        class="form-control"
                        id="exampleInputName" aria-describedby=""
                        placeholder="Enter Book Author">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Author Bio </label>
                        <input type="text" name="bio"
                        value="<?php echo $data['biography'];?>"
                        class="form-control"
                        id="exampleInputName" aria-describedby=""
                        placeholder="Enter Author Biography">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>


            </div>
        </main>

        <?php 
  
  require '../Layouts/footer.php';

?>