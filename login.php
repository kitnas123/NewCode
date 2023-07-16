<?php 
    session_start();

    if(isset($_SESSION['auth']))
    {

        if(!isset($_SESSION['message'])){
        $_SESSION['message'] = "You are already logged in";
        }
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
                            <h4>Login</h4>
                            <button class="back-button"><a href="index.php">X</a></button>
                        </div>
                        <div class="card-body">
                            <form action="logincode.php" method="POST">
                                <div class="form-group mb-3">
                                    <label>Email Id</label>
                                    <input type="email" required name="email" placeholder="Enter your email address" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="password" required name="password" placeholder="Enter your password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="login_btn" class="btn btn-primary">Login Now</button>
                                </div>
                                <div class="reg">
                                    <p>Not have an account yet? <a href="register.php">Register here</a></p>
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