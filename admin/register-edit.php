<?php
    include('authentication.php');
    include('includes/header.php');
?>

<div class="container-fluid px-4">
        <h1 class="mt-4">Interface</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Registered Users</li>
            </ol>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="card-body">

                            <?php 
                            if(isset($_GET['id']))
                            {
                                $user_id = $_GET['id'];
                                $users = "SELECT * FROM users WHERE id='$user_id' ";
                                $users_run = mysqli_query($con, $users);

                                if(mysqli_num_rows($users_run) > 0)
                                {
                                    foreach($users_run as $users)
                                    {
                                    ?> 
                                    
                                    
                            <form action="code.php" method="post">
                                <input type="hidden" name="user_id" value="<?=$users['id'];?>">

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="">First Name</label>
                                        <input type="text" name="fname" value="<?=$users['fname'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" value="<?=$users['lname'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="<?=$users['email'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Password</label>
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Role As</label>
                                        <select name="" id="">
                                            <option value="">--Select Role--</option>
                                            <option value="admin" <?= $users['role_as'] == '1' ? 'selected':''; ?> >Admin</option>
                                            <option value="user" <?= $users['role_as'] == '0' ? 'selected':''; ?>>User</option>
                                        </select>
                                    </div>
                                
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                                    </div>

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

</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>