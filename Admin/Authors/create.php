<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

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

      $sql = "INSERT into author (`name`, `biography`, `reg_date`) values ('$auther_name','$author_bio',NOW())";
      $op  = mysqli_query($con,$sql);

    //   echo mysqli_error($con);

      if($op){
          $message = ["Author Added Successfully..!"];
          header("Location: index.php");
      }else{
        $_SESSION['Errors'] = ["Error in Added Try Again"];
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
                      printMessages('Add Book Author');
                     ?>
                <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                    enctype="multipart/form-data">



                    <div class="form-group">
                        <label for="exampleInput">Author Name</label>
                        <input type="text" name="name"  class="form-control" id="exampleInput" aria-describedby=""
                            placeholder="Enter Author Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInput">Author Bio</label>
                        <input type="text" name="bio"  class="form-control" id="exampleInput" aria-describedby=""
                            placeholder="Enter Author Bio">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>


            </div>
        </main>




        <?php 
  
  require '../Layouts/footer.php';

?>