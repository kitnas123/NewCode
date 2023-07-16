<?php
    include('authentication.php');
    include('includes/header2.php');
    



    $query = "SELECT * FROM bookings_record";
    $result = mysqli_query($con, $query);
?>

<div class="container-fluid px-4">
        <h1 class="mt-4">Booking</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Booking Appointment</li>
            </ol>

            <table class="table table-bordered">
                
                    <tr class="bg-dark text-white">
                        <td>ID</td>
                        <td>First Name</td>
                        <td>Middle Name</td>
                        <td>Last Name</td>
                        <td>Phone</td>
                        <td>Email</td>
                        <td style="text-align:center;">Action</td>
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
                                <td style="text-align:center;">
                                    <button class="border-0" data-toggle="modal" data-target="#viewModal<?php echo $row['ID']; ?>">View</button>
                                    <button class="border-0" data-toggle="modal" data-target="#messageModal<?php echo $row['ID']; ?>">Message</button>
                                </td>

                            </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewModal<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel<?php echo $row['ID']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel<?php echo $row['ID']; ?>">View Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Display the details of the row here -->
                                                <p>ID: <?php echo $row['ID']; ?></p>
                                                <p>First Name: <?php echo $row['FIRSTNAME']; ?></p>
                                                <p>Middle Name: <?php echo $row['MIDDLENAME']; ?></p>
                                                <p>Last Name: <?php echo $row['LASTNAME']; ?></p>
                                                <p>Address: <?php echo $row['ADDRESS']; ?></p>
                                                <p>Phone: <?php echo $row['PHONE']; ?></p>
                                                <p>Email: <?php echo $row['EMAIL']; ?></p>
                                                <p>Service: <?php echo $row['SERVICE']; ?></p>
                                                <p>Aesthetician: <?php echo $row['AESTHETICIAN']; ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End View Modal -->

                                <!-- Message Modal -->
                                <div class="modal fade" id="messageModal<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel<?php echo $row['ID']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalLabel<?php echo $row['ID']; ?>">Send Message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="send_message.php" method="post">
                                                    <input type="hidden" name="re_email" value="<?php echo $row['EMAIL']; ?>">
                                                    <div class="form-group">
                                                        <label for="message">Message:</label>
                                                        <textarea class="form-control" name="message" rows="5" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Message Modal -->

                            <?php
                            }
                        
                        ?>
                    
            </table>

</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>