<?php

/**********************Includes Connection and Helper Function************* */
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles ... 
$sql = "select * from role";
$op  = mysqli_query($con, $sql);

/***************************Includes Header and NavBar****** */
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
                <h1 class="mt-4">Dashboard</h1>
                <?php
                printMessages('Display Roles');
                ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>id</th>
                                        <th>title</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($data = mysqli_fetch_assoc($op)) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['title']; ?></td>
                                            <td><?php echo $data['Created_At']; ?></td>
                                            <td>
                                                <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php

        require '../Layouts/footer.php';

        ?>