<?php
    include('authentication.php');
    include('includes/header2.php');

    $query = "SELECT * FROM doctors";
    $result = mysqli_query($con, $query);
?>

<div class="container-fluid px-4">
        <h1 class="mt-4">Aestheticians</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Aestheticians List</li>
            </ol>
            <a class="btn btn-primary" href="add_doctor.php" style="float: right; margin-top: 10px; margin-bottom: 10px; padding-top:10px; padding-bottom:10px;">Add Aesthetician</a>
            
            <table class="table table-bordered">
                
                    <tr class="bg-dark text-white">
                        <td>ID</td>
                        <td>First Name</td>
                        <td>Middle Name</td>
                        <td>Last Name</td>
                        <td>Phone Number</td>
                        <td>Email</td>
                        <td>Profession</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <?php 

                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>

                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['FIRSTNAME']; ?></td>
                                <td><?php echo $row['MIDDLENAME']; ?></td>
                                <td><?php echo $row['LASTNAME']; ?></td>
                                <td><?php echo $row['PHONE']; ?></td>
                                <td><?php echo $row['EMAIL']; ?></td>
                                <td><?php echo $row['PROFESSION']; ?></td>
                                <td>
                                    <!--<button class="border-0 btn-primary rounded"><a href="aesthetician.php?id=<?php echo $row['ID']; ?>" style="color: white;">View</a></button>-->
                                    <button class="border-0 btn-primary rounded-lg"><a href="edits.php?id=<?php echo $row['ID']; ?>" style="color: white;">Edit</a></button>
                                </td>

                            </tr>
                            <?php
                            }
                        
                        ?>
                    
            </table>

</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>