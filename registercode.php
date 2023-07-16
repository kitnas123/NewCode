<?php 
    session_start();
    include('admin/config/dbcon.php');

    if(isset($_POST['register_btn']))
    {
        // Retrieve form inputs and sanitize them
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['cpassword']);

        if($password == $confirm_password)
        {
            $checkemail = "SELECT email FROM users WHERE email='$email'";
            $checkemail_run = mysqli_query($con, $checkemail);

            if(mysqli_num_rows($checkemail_run) > 0)
            {
                $_SESSION['message'] = "Email Already Exists";
                header("Location: landing.php#registerModal"); // Redirect back to the registration form
                exit();
            }
            else
            {
                $user_query = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname','$lname','$email','$password')";
                $user_query_run = mysqli_query($con, $user_query);

                if($user_query_run)
                {
                    $_SESSION['message'] = "Registered successfully";
                    header("Location: landing.php#loginModal"); // Redirect to the login form in landing.php
                    exit();
                }
                else 
                {
                    $_SESSION['message'] = "Something went wrong";
                    header("Location: landing.php#registerModal"); // Redirect back to the registration form
                    exit();
                }
            }
        }
        else
        {
            $_SESSION['message'] = "Password and Confirm Password do not match";
            header("Location: landing.php#registerModal"); // Redirect back to the registration form
            exit();
        }
    }
    else
    {
        header("Location: landing.php"); // Redirect back to the landing page
        exit();
    }
?>
