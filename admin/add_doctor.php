<?php
    include('authentication.php');
    include('includes/header.php');

    if (isset($_POST['submit'])) {
        $fname = $_POST['FIRSTNAME'];
        $mname = $_POST['MIDDLENAME'];
        $lname = $_POST['LASTNAME'];
        $phone = $_POST['PHONE'];
        $email = $_POST['EMAIL'];
        $prof = $_POST['PROFESSION'];
        $picture = $_POST['PICTURE'];
        $con = new mysqli('localhost', 'root', '', 'jedz');
    
    
        $sql = "INSERT INTO doctors(FIRSTNAME, MIDDLENAME, LASTNAME, PHONE, EMAIL, PROFESSION, PICTURE) VALUES ('$fname', '$mname', '$lname', '$phone', '$email', '$prof', '$picture')";
    
        if ($con->query($sql)) {
            $message = "<div class='alert alert-success'>Adding Successfull</div>";
        } else {
            $message = "<div class='alert alert-danger'>Something Went Wrong</div>";
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
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group col-md-6">
                        <label for="">FIRST NAME</label>
                        <input type="text" class="form-control" name="FIRSTNAME" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">MIDDLE NAME</label>
                        <input type="text" class="form-control" name="MIDDLENAME" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">LAST NAME</label>
                        <input type="text" class="form-control" name="LASTNAME" required>
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">PHONE NUMBER</label>
                        <input type="text" class="form-control" name="PHONE" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">EMAIL</label>
                        <input type="email" class="form-control" name="EMAIL" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Pofession</label>
                        <input type="text" class="form-control" name="PROFESSION" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">UPLOAD PICTURE</label>
                        <input type="file" class="form-control" name="PICTURE" accept="image/*">
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="aesthetician.php" class="btn btn-success">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>