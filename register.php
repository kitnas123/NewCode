<?php 
    session_start();

    if(isset($_SESSION['auth']))
    {
        $_SESSION['message'] = "You are already logged in";
        header("Location: index.php");
        exit(0);
    }

    
    
    include('include/header.php');

?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">

                     <?php include('message.php'); ?>

                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; ">                         
                            <h4>Register</h4>
                            <button class="back-button"><a href="index.php">X</a></button>
                        </div>
                        <div class="card-body">
                            <form action="registercode.php" method="POST">
                                <div class="form-group mb-3">
                                    <label>First Name</label>
                                    <input required type="text" name="fname" placeholder="Enter your firstname" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Last Name</label>
                                    <input required type="text" name="lname" placeholder="Enter your Last Name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Email Id</label>
                                    <input required type="email" name="email" placeholder="Enter your email address" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input required type="password" name="password" placeholder="Enter your password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Confirm Password</label>
                                    <input required type="password" name="cpassword" placeholder="Enter confrim password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                                </div>
                                <div class="reg">
                                    <p>Already have an account? <a href="login.php">Login here</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php 
    include('include/footer.php');
?>