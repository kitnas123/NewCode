<?php

    include('authentication.php');
    include('includes/header.php');


    if(isset($_POST['add_product'])) {
        $name = $_POST['p_name'];
        $price = $_POST['p_price'];
        $stock = $_POST['p_stock'];
        $p_image = $_FILES['p_image']['name'];
        $p_image_temp_name = $_FILES['p_image']['tmp_name'];
        $p_image_folder = 'image/'.$p_image;
    
        $query = "INSERT INTO `product` (`name`, `price`, `stock`, `image`) VALUES ('$name', '$price', '$stock', '$p_image')";
        $insert_query = mysqli_query($con, $query);
    
        if($insert_query) {
            move_uploaded_file($p_image_temp_name, $p_image_folder);
            $_SESSION['message'] = 'Product Added Successfully';
            $_SESSION['message_type'] = 'success';
            echo '<script>window.location.href = "admin-product.php";</script>';
        }
        else {
            $_SESSION['message'] = 'Product Did Not Added';
            $_SESSION['message_type'] = 'error';
        }
    }
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Shop</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add Products</li>
    </ol>        
</div>

<?php
if(isset($_SESSION['message'])) {
    echo '<div class="message">'.$_SESSION['message'].'</div>';
    unset($_SESSION['message']); // Remove the message from session after displaying it
}
?>




<div class="form">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add New Product</h3>
        <input type="text" name="p_name" placeholder="Enter Product Name" required>
        <input type="number" name="p_price" placeholder="Enter Product Price" required>
        <input type="number" name="p_stock" placeholder="Enter Product Stock" required>
        <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" required>
        <input type="submit" name="add_product" value="Add Product" class="btn">
    </form>
</div>



        


<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>