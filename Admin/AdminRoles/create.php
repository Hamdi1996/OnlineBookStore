<?php 

require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = CleanInputs($_POST['title']);

    $errors = [];

    # Validate ... 
    if(!validate($title,1)){
      $errors['Title'] = "Requierd Field";
    }elseif(!validate($title,2)){
        $errors['Title'] = "Invalid String";
      }

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{

      $sql = "insert into role (title,Created_At) values ('$title',CURRENT_TIMESTAMP)";
      $op  = mysqli_query($con,$sql);

      if($op){
          $message = ["Added Successfully!"];
      }else{
          $errorss = ["Failed To Added Try Again"];
      }
        $_SESSION['Message'] = $message;
        $_SESSION['Errors'] = $errorss;
    }  
}
/***************************includes header and navbar********** */
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
                <!-- *************Check if Errors Display here ********* -->
                <h1 class="mt-4">Dashboard </h1> 
             
                     <?php 
                      printMessages('Add Role');
                     ?>
             
                <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                            placeholder="Enter Title">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </main>
        <?php 
  
  require '../Layouts/footer.php';

?>