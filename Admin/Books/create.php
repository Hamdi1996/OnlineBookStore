<?php
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Category ... 
$sql = "select * from category";
$select_cat  = mysqli_query($con, $sql);

# Fetch Authors ... 
$sql = "select * from author";
$select_author  = mysqli_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name      = CleanInputs($_POST['name']);
    $isbn      = CleanInputs($_POST['isbn']);
    $cat_id    = CleanInputs($_POST['cat_id']);
    $auth_id   = CleanInputs($_POST['auth_id']);
    $IMGname   = CleanInputs($_POST['image']);

       # Image INFO ... 
   $IMGtmp_path = $_FILES['image']['tmp_name'];
   $IMGname     = $_FILES['image']['name'];
   $IMGsize     = $_FILES['image']['size'];
   $IMGtype     = $_FILES['image']['type'];

    $errors = [];
    # Validate ... 
    if (!validate($name, 1)) {
        $errors['Name'] = "Name : Requierd Field";
    } elseif (!validate($name, 2)) {
        $errors['Name'] = "Name : Invalid String";
    }

    if (!validate($isbn, 1)) {
        $errors['isbn'] = " ISBN Number : Requierd Field";
    } elseif (!validate($isbn, 9)) {
        $errors['isbn'] = "ISBN Number: Invalid ISBN Number";
    }

    if (!validate($cat_id, 1)) {
        $errors['Category'] = " Requierd Field";
    } elseif (!validate($cat_id, 6)) {
        $errors['Category'] = " InValid input";
    }
    if (!validate($auth_id, 1)) {
        $errors['author'] = "Requierd Field";
    } elseif (!validate($auth_id, 6)) {
        $errors['author'] = "Invalid  String";
    }
    if(!validate($IMGname,1)){
    $errors['IMG'] = "IMAGE : Field Required";
      
    }elseif(!validate($IMGtype,4)){
    $errors['IMG'] = "IMAGE : Invalid Extension";
    }

    if (count($errors) > 0) {
        $_SESSION['Errors'] = $errors;
    } else {

        $extArray = explode('/',$IMGtype);
        $finalName =time().'.'.$extArray[1];
        $desPath = './uploads/'.$finalName;
         if(move_uploaded_file($IMGtmp_path,$desPath)){
            $user_id =$_SESSION['user']['id'];

            $sql = "INSERT INTO `books`(`book_name`, `book_cover`, `ISBNNumber`, `category_id`, `author_id`, `user_id`, `issuedDate`) 
            values ('$name','$finalName',$isbn,$cat_id,'$auth_id','$user_id','NOW()')";
            $op  = mysqli_query($con,$sql);
        //     echo mysqli_error($con);
        //   exit();
        if ($op) {
            $message = ["Data Added Successfully !!"];
        } else {
            $_SESSION['Errors'] = ["Error in sql OP Try Again"];
        }

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
                        printMessages('Add Book');
                        ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Book Name</label>
                        <input type="text" name="name" class="form-control"
                        id="exampleInputName" aria-describedby="" placeholder="Enter Book Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputText">ISBN Number</label>
                        <input type="number" name="isbn" class="form-control" 
                         id="exampleInput"  placeholder="Enter ISBN Number">
                    </div>

                    <!-- Add Book To Category -->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Book Category</label>
                        <select name="cat_id" class="form-control">

                            <?php while ($result = mysqli_fetch_assoc($select_cat)) { ?>
                                <option value="<?php echo $result['id']; ?>"><?php echo $result['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Add Author -->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Book Author</label>
                        <select name="auth_id" class="form-control">

                            <?php while ($result = mysqli_fetch_assoc($select_author)) { ?>
                                <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label><br>
                        <input type="file" name="image" >
                           
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </main>

        <?php
        require '../Layouts/footer.php';

        ?>