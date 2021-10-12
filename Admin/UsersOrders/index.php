<?php 

require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles ... 
$sql = "select reservebook.id as reserveId ,reservebook.reservationDate ,reservebook.status , reservebook.user_id,reservebook.book_id,users.*, books.* from reservebook 
join books on reservebook.book_id=books.id join users on reservebook.user_id = users.id ;
";$op  = mysqli_query($con,$sql);

// echo mysqli_error($con);
// exit();
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
                     //printMessages('Display Users Order Recived');
                     ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
            Display Users Order Recived
            </li></ol>

                
                        <div class="card mb-4">  
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Book Name</th>
                                                <th>Book Cover</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     
                                 <?php 
                                    $i = 0;
                                    while($data = mysqli_fetch_assoc($op)){
                                 ?>       
                                          <tr>
                                                <td><?php echo ++$i;?></td>
                                                <td><?php echo $data['name'];?></td>
                                                <td><?php echo $data['email'];?></td>
                                                <td><?php echo $data['book_name'];?></td>
                                                <td><img src="<?php echo url('Books/uploads/') ?><?php echo $data['book_cover'];?>" width="100" height="100"></td> 
                                                <td><?php echo $data['reservationDate'];?></td>
                                                <td>
                                               <a href="ajax.php?id=<?php echo $data['reserveId'];?>"
                                                class='<?php if($data['status'] ==0) {echo "btn btn-danger m-r-1em";} else {echo "btn btn-primary m-r-1em";} ?>'>
                                               <?php if($data['status']==0) {echo "Pending";} else {echo "Approved";}?></a>
                                           </td> 
                                                
                                                <td>
                                <a href='delete.php?id=<?php echo $data['reserveId'];?>' class='btn btn-danger m-r-1em'>Delete</a>
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