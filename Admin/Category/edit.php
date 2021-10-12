<?php 

require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles ... 
$sql = "select * from category";
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

$sql = "select * from category where id =".$id;
$op  = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($op); 


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $category_Name   = CleanInputs($_POST['category']);
    $status          = CleanInputs($_POST['status']);

    $errors = [];
    # Validate ... 
    if(!validate($category_Name,1)){
        $errors['Category'] = "Requierd Field";
      }elseif(!validate($category_Name,2)){
          $errors['Category'] = "Invalid String";
        }
  
      //   Validate Status
      if(!validate($status,1)){
        $errors['Status'] = "Requierd Field";
      }elseif(!validate($status,2)){
          $errors['Status'] = "Invalid String";
        }

    if(count($errors) > 0){
        $_SESSION['Errors'] = $errors;
    }else{

      $sql = "UPDATE category set `category_name` ='$category_Name' ,`status`='$status' where id=".$id;
      $op  = mysqli_query($con,$sql);

      if($op){
          $message = ["Category Updated Successfully"];

          $_SESSION['Message'] = $message;    
          $_SESSION['del_falg'] = 1;

      }else{
          $_SESSION['Errors'] = ["Error in sql OP Try Again"];
          $_SESSION['Message'] = $message;
       
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
                      printMessages('Update Book Category');
                     ?>
                <form method="post" action="edit.php?id=<?php  echo $data['id']; ?>"
                    enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Category </label>
                        <input type="text" name="category"
                        value="<?php echo $data['category_name'];?>"
                        class="form-control"
                        id="exampleInputName" aria-describedby=""
                        placeholder="Enter Book Category">
                    </div>

                            <?php 
                            while($result = mysqli_fetch_assoc($select_op)){
                                
                             }?>
                 
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Avaliable" 
                        <?php if($data['status']=="Avaliable"){echo "checked";}?> name="status" id="flexRadioDefault1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                           Available
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" value="NotAvaliable"
                         <?php if($data['status']=="NotAvaliable"){echo "checked";}?>  name="status" id="flexRadioDefault2" >
                        <label class="form-check-label" for="flexRadioDefault2">
                        Not-Available
                        </label>
                        </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>


            </div>
        </main>

        <?php 
  
  require '../Layouts/footer.php';

?>