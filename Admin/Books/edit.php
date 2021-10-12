<?php
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Category ... 
$sql = "select * from category";
$select_cat  = mysqli_query($con, $sql);

# Fetch Authors ... 
$sql = "select * from author";
$select_author  = mysqli_query($con, $sql);

# ID & Validate ...  
$_SESSION['del_falg'] = 0;
# GET data ... 
$id = sanitize($_GET['id'], 1);
$error = [];
if (!validate($id, 6)) {
    $error['id'] = "Invalid Integar";
}

if (count($error) > 0) {
    $_SESSION['Errors'] = $error;
    $_SESSION['del_falg'] = 1;
    header("Location: index.php");
}

# Fetch User Data
$sql = "select * from books where id=" . $id;
$op  = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);

if (mysqli_num_rows($op) == 0) {
    $_SESSION['Errors'] = ["No data For this Id"];
    $_SESSION['del_falg'] = 1;
    header("Location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name      = CleanInputs($_POST['name']);
    $isbn      = CleanInputs($_POST['isbn']);
    $cat_id    = CleanInputs($_POST['cat_id']);
    $auth_id   = CleanInputs($_POST['auth_id']);
    $oldImage   = CleanInputs($_POST['oldImage']);

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
    if(isset($IMGname) && validate($IMGname,1) ){
        if(!validate($IMGtype,4)){
            $errors['IMG'] = "IMAGE : Invalid Extension";
           }

    }


    if (count($errors) > 0) {
        $_SESSION['Errors'] = $errors;
    } else {

        if (isset($IMGname) && validate($IMGname, 1)) {

            $extArray = explode('/', $IMGtype);
            $finalName =time() . '.' . $extArray[1];

            $desPath = './uploads/' . $finalName;
            if (move_uploaded_file($IMGtmp_path, $desPath)) {
                unlink('./uploads/' . $oldImage);
            } else {
                $errors = ['Error In Uploading Try Again'];
            }

        } else {
            $finalName = $oldImage;
        }


        if (count($errors) > 0) {
            $_SESSION['Message'] = $errors;
        } else {

            // LOGIC ...
            $user_id = $_SESSION['user']['id'];

            $sql = "UPDATE `books` SET `book_name`='$name' , `book_cover`='$finalName', `ISBNNumber`='$isbn', 
            `category_id`='$cat_id', `author_id`='$auth_id', `user_id`='$user_id', `issuedDate`='NOW()'where id =".$id;
            $op  = mysqli_query($con, $sql);
            //  print_r ($sql);
            //  exit();

            if ($op) {
                $_SESSION['Message'] = ["Book Updated Successfully"];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['Message'] = ["Error in sql OP Try Again"];
            }
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
                printMessages('Edit Book');
                ?>
                <form method="post" action="edit.php?id=<?php echo $data['id']; ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Book Name</label>
                        <input type="text" name="name" value="<?php echo $data['book_name']; ?>" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Book Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputText">ISBN Number</label>
                        <input type="text" name="isbn" value="<?php echo $data['ISBNNumber']; ?>" class="form-control" id="exampleInput" placeholder="Enter ISBN Number">
                    </div>

                    <!-- Add Book To Category -->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Book Category</label>
                        <select name="cat_id" class="form-control">

                            <?php while ($result = mysqli_fetch_assoc($select_cat)) { ?>
                                <option value="<?php echo $result['id']; ?> 
                                <?php if ($result['id'] == $data['id']) {echo 'selected';} ?>"><?php echo $result['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Add Author -->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Book Author</label>
                        <select name="auth_id" class="form-control">

                            <?php while ($result = mysqli_fetch_assoc($select_author)) { ?>
                                <option value="<?php echo $result['id']; ?> 
                                <?php if ($result['id'] == $data['id']) { echo 'selected'; } ?>"><?php echo $result['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type='hidden' name="oldImage" value="<?php echo $data['book_cover']; ?>">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label><br>
                        <input type="file" name="image">

                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </main>

        <?php
        require '../Layouts/footer.php';

        ?>