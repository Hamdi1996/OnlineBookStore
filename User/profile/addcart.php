<?php  require "../../Admin/helpers/dbConnection.php";?>
<?php  require "../../Admin/helpers/helpers.php";



$id = sanitize($_GET['id'], 1);
$error = [];
if (!validate($id, 6)) {
    $error['id'] = "Invalid Integar";
}

if (count($error) > 0) {
    $_SESSION['Errors'] = $error;
}

if(count($errors) > 0){
    $_SESSION['Errors'] = $errors;
}else{
    $user_id = $_SESSION['user']['id'];
    $sqlbook = "INSERT INTO `reservebook`(`reservationDate`, `user_id`, `book_id`,`status`) VALUES
        (NOW(),'$user_id','$id','0')";
        $opbook  = mysqli_query($con,$sqlbook);


  if($op){
    //   $message = ["Item Added Successfully"];
    //   $_SESSION['Message'] = $message; 
      header("Location:index.php");   

  }else{
      $message = ["Error in sql OP Try Again"];
      $_SESSION['Errors'] = $message;
   
  }
}

?>