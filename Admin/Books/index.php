<?php 

require '../helpers/dbConnection.php';
require '../helpers/helpers.php';

# Fetch Roles Join Table Users With table Roles... 
$sql = "SELECT books.id as bookId , books.book_name , books.book_cover,
        books.ISBNNumber , books.category_id, books.author_id,
        books.user_id,author.name ,category.* ,users.name as username
        from books JOIN author on books.author_id = author.id
        JOIN category ON books.category_id = category.id 
        JOIN users ON books.user_id = users.id ORDER BY `bookId` ASC";

$op  = mysqli_query($con,$sql);
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
                            printMessages('Display Books');
                     ?>
                    
                        <div class="card mb-4">  
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>BookName</th>
                                                <th>BookAuthor</th>
                                                <th>ISBN Number</th>
                                                <th>Book Category</th>
                                                <th>Added By</th>
                                                <th>Category Status</th>
                                                <th>Book Cover</th>
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
                                               <td><?php echo $data['bookId'];?></td>  
                                               <td><?php echo $data['book_name'];?></td>
                                               <td><?php echo $data['name'];?></td>
                                               <td><?php echo $data['ISBNNumber'];?></td>
                                               <td><?php echo $data['category_name'];?></td>
                                               <td><?php echo $data['username'];?></td>
                                               <td><?php echo $data['status'];?></td>
                                               <td><img src="./uploads/<?php echo $data['book_cover'];?>" width="100" height="100"></td>
                                                <td>
                                               <a href='delete.php?id=<?php echo $data['bookId'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                               <a href='edit.php?id=<?php echo $data['bookId'];?>' class='btn btn-primary m-r-1em'>Edit</a>
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