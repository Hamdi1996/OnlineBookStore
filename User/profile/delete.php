<?php 
  require "../../Admin/helpers/dbConnection.php";
  require "../../Admin/helpers/helpers.php";

 $id = sanitize($_GET['id'],1);
 $error = [];
 if(!validate($id,6)){
     $error['id'] = "Invalid Integar";
 }
 if(count($error) > 0){
    $_SESSION['Errors']  = $error;
 }else{
     $sql = "delete from reservebook where book_id =".$id;
     $op  = mysqli_query($con,$sql);
    //  echo mysqli_error($con);
    //  exit();
     if($op){
         $message = ["Category Deleted Successfully"];
     }else{
        $_SESSION['Errors'] = ["Error Try Again"];
     }

 }

 $_SESSION['Message'] = $message;
 
 header("Location: index.php");




?>