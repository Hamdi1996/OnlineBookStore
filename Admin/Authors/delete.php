<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';


 $id = sanitize($_GET['id'],1);
 $error = [];
 if(!validate($id,6)){
     $error['id'] = "Invalid Integar";
 }
 if(count($error) > 0){
    $_SESSION['Errors']  = $error;
 }else{
     $sql = "delete from author where id =".$id;
     $op  = mysqli_query($con,$sql);
     if($op){
         $message = ["Author Deleted Successfully"];
     }else{
        $_SESSION['Errors'] = ["Error Try Again"];
     }

 }

 $_SESSION['Message'] = $message;
 
 header("Location: index.php");




?>