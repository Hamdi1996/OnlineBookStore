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

    #Get Name of image from DataBase and delete
      $sql = "select book_cover from books where id =".$id;
      $op  = mysqli_query($con,$sql);
      $data =mysqli_fetch_assoc($op);
      $image = $data['book_cover'];

     $sql = "delete from books where id =".$id;
     $op  = mysqli_query($con,$sql);
    // print_r($sql);
    //  exit();

     if($op){
        $path = './uploads/'.$image;
        if(file_exists($path)){
           unlink($path);
        } 
         $message = ["Deleted Successfully !!"];
     }else{
        $_SESSION['Errors'] = ["Error Try Again"];
     }

 }

 $_SESSION['Message'] = $message;
 
 header("Location: index.php");

?>