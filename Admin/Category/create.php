<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $category_Name   = CleanInputs($_POST['category']);
    $status          = CleanInputs($_POST['status']);

    $errors = [];
    # Validate ... 
    if(!validate($category_Name,1)){
      $errors['Category'] = " Category: Requierd Field";
    }elseif(!validate($category_Name,2)){
        $errors['Category'] = "Invalid String";
      }

    //   Validate Category
    if(!validate($status,1)){
      $errors['Status'] = "Requierd Field";
    }elseif(!validate($status,2)){
        $errors['Status'] = "Invalid String";
      }

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{
      $sql = "INSERT into category (`category_name`, `status`) values ('$category_Name','$status')";
      $op  = mysqli_query($con,$sql);
    //   echo mysqli_error($con);

      if($op){
          $message = ["Category Added Successfully..!"];
         
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
                <!-- Display Messages Here -->
                     <?php 
                      printMessages('Add Book Category');
                     ?>
                    
                <form method="post"
                 action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                  enctype="multipart/form-data">
                  
                    <div class="form-group">
                        <label for="exampleInput">Category</label>
                        <input type="text" name="category"  class="form-control" id="exampleInput" aria-describedby=""
                            placeholder="Enter Category">
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Avaliable" name="status" id="flexRadioDefault1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                           Available
                        </label>
                        </div>
                        <div class="form-check">
                        
                        <input class="form-check-input"
                        type="radio" value="NotAvaliable"  
                        name="status" id="flexRadioDefault2" >

                        <label class="form-check-label" for="flexRadioDefault2">
                        Not-Available
                        </label>
                        </div>
                        <br>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>


            </div>
        </main>

        <?php 
  
  require '../Layouts/footer.php';

?>