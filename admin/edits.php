<?php
    include('authentication.php');
    include('includes/header.php');

    if(isset($_POST['update_doctors'])){

        $user_id = $_POST['ID'];
        $fname = $_POST['FIRSTNAME'];
        $mname = $_POST['MIDDLENAME'];
        $lname = $_POST['LASTNAME'];
        $phone = $_POST['PHONE'];
        $email = $_POST['EMAIL'];
        $profession = $_POST['PROFESSION'];
        $picture = $_POST['PICTURE'];

        $query = "UPDATE doctors SET FIRSTNAME='$fname', MIDDLENAME='$mname', LASTNAME='$lname', PHONE='$phone', EMAIL='$email', PROFESSION='$profession', PICTURE='$picture' WHERE ID='$user_id' ";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['message'] = "Updated Successfully";
            echo '<script>window.location.href = "aesthetician.php";</script>';
            exit(0);
        }
    }
   
?>



<div class="container-fluid px-4">
        <h1 class="mt-4">BOOKING</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Add Aesthetician</li>
            </ol>


    <div class="container">
        <h1 class="text-center alert alert-danger" style="background:black; border:none; color:#fff;">Add Aesthetician</h1>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($message) ? $message : ''; ?>
            

                <?php 
                            if(isset($_GET['id']))
                            {
                                $user_id = $_GET['id'];
                                $users = "SELECT * FROM doctors WHERE id='$user_id' ";
                                $users_run = mysqli_query($con, $users);

                                if(mysqli_num_rows($users_run) > 0)
                                {
                                    foreach($users_run as $users)
                                    {
                                    ?> 
                <form action="edits.php" method="POST" autocomplete="off">
                <input type="hidden" name="ID" value="<?=$users['ID'];?>">

                    <div class="form-group col-md-6">
                        <label for="">FIRST NAME</label>
                        <input type="text" class="form-control" value="<?=$users['FIRSTNAME'];?>"  name="FIRSTNAME" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">MIDDLE NAME</label>
                        <input type="text" class="form-control" value="<?=$users['MIDDLENAME'];?>" name="MIDDLENAME" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">LAST NAME</label>
                        <input type="text" class="form-control" value="<?=$users['LASTNAME'];?>" name="LASTNAME" required>
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">PHONE NUMBER</label>
                        <input type="text" class="form-control" value="<?=$users['PHONE'];?>" name="PHONE" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">EMAIL</label>
                        <input type="email" class="form-control" value="<?=$users['EMAIL'];?>" name="EMAIL" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Pofession</label>
                        <input type="text" class="form-control" value="<?=$users['PROFESSION'];?>" name="PROFESSION" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">UPLOAD PICTURE</label>
                        <input type="file" class="form-control"  name="PICTURE" accept="image/*">
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" name="update_doctors" class="btn btn-primary">Submit</button>
                        <a href="aesthetician.php" class="btn btn-success">Back</a>
                    </div>
                </form>

                <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <h4>No Record Found</h4>
                                        <?php
                                    }
                                }
                                    
                                ?>

                
            </div>
        </div>
    </div>


</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>