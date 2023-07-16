<?php
    include('authentication.php');

    if(isset($_POST['delete']))
    {
        $user_id = $_POST['delete'];

        $query = "DELETE FROM users WHERE id='$user_id' ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: view-register.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Something Went Wrong";
            header('Location: view-register.php');
            exit(0);
        }
    }

    if(isset($_POST['update_user']))
    {
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role_as = $_POST['role_as'];

        $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', password='$password', role_as='$role_as' WHERE id='$user_id' ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: view-register.php');
            exit(0);
        }
    }
?>
