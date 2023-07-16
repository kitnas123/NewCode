<?php
    include('authentication.php');
    include('includes/header.php');

    $query = "SELECT * FROM services";
    $result = mysqli_query($con, $query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">SERVICES</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Services List</li>
        </ol>
</div>

        <a class="btn btn-primary" href="add_services.php" style="float: right; margin-top: 10px; margin-bottom: 10px; margin-right:20px; padding-top:10px; padding-bottom:10px;">Add Services</a>
            
            <table class="table table-bordered">
                
                    <tr class="bg-dark text-white">
                        <td>ID</td>
                        <td>Title</td>
                        <td>Price</td>
                        <td>Duration</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <?php 

                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>

                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['duration']; ?></td>
                                <td>
                                    <!--<button class="border-0 btn-primary rounded"><a href="aesthetician.php?id=<?php echo $row['ID']; ?>" style="color: white;">View</a></button>-->
                                    <button class="border-0 btn-primary rounded-lg p-2"><a href="edits.php?id=<?php echo $row['ID']; ?>" style="color: white;">Edit</a></button>
                                </td>

                            </tr>
                            <?php
                            }
                        
                        ?>
                    
            </table>





<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>