<?php
    include('authentication.php');
    include('includes/header.php');

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $con = new mysqli('localhost', 'root', '', 'jedz');
    
    
        $sql = "INSERT INTO services (title, price, duration) VALUES ('$title', '$price', '$duration')";
    
        if ($con->query($sql)) {
            $message = "<div class='alert alert-success'>Added Successfull</div>";
        } else {
            $message = "<div class='alert alert-danger'>Something Went Wrong</div>";
        }
    }
?>



<div class="container-fluid px-4">
        <h1 class="mt-4">SERVICES</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Add Services</li>
            </ol>


    <div class="container">
        <h1 class="text-center alert alert-danger" style="background:#2ecc71;border:none;color:#fff">Add Services</h1>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($message) ? $message : ''; ?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group col-md-6">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Duration</label>
                        <input type="text" class="form-control" name="duration" required>
                    </div> 
                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                    <a href="service.php" class="btn btn-success">Back</a>
                </form>
            </div>
        </div>
    </div>


</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>