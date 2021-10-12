<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';


 $id = sanitize($_GET['id'],1);
 $error = [];
 if(!validate($id,6)){
     $error['id'] = "Invalid Integar";
 }
 if(count($error) > 0){
     $message  = $error;
 }else{

     $sql = "delete from contactus where id =".$id;

     $op  = mysqli_query($con,$sql);

     if($op){
         $message = ["Contact Deleted Successfully"];
     }else{
         $message = ["Error Try Again"];
     }

 }

 $_SESSION['Message'] = $message;
 
 header("Location: index.php");




?>