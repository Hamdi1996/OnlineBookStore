<?php 
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

$id = sanitize($_GET['id'],1);

$error = [];
if(!validate($id,6)){
    $error['id'] = "Invalid Integar";
}
if(count($error) > 0){
    $_SESSION['Message'] = $error;

    header("Location: index.php");
}
else {

    
$query ="UPDATE reservebook SET `status`='1' WHERE id='$id'";
$op = mysqli_query($con,$query);
if ($op){
    header("Location: index.php");
}
else {
    echo "<script>alert('Failed')</script>";
}

}




?>