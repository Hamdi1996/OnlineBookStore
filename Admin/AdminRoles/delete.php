<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

/*****************Get id and filter it ********/
 $id = sanitize($_GET['id'],1);

 $error = [];

 if(!validate($id,6)){
     $error['id'] = "Invalid Integar";
 }

 if(count($error) > 0){
     $_SESSION['Errors'] = $error;
 }else{

     $sql = "delete from role where id =".$id;
     $op  = mysqli_query($con,$sql);
     if($op){
         $message = ["Deleted Successfully"];
     }else{
         $message = ["Error Try Again"];
     }
 }
//  Carry Error in session and display in index file
 $_SESSION['Message'] = $message;
 header("Location: index.php");




?>