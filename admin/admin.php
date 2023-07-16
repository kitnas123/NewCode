<?php
    include('authentication.php');
    include('includes/header.php');

    //delete
    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($con, "DELETE FROM `product` WHERE id=$delete_id") or die('query failed');
        
        if($delete_query) {
            $message = 'Product has been updated successfully';
        }
        else {
            $message[] = 'Product Did Not Deleted';
        }
    }

    //update
    if(isset($_POST['update_product'])) {
        $update_p_id = $_POST['update_p_id'];
        $update_p_name = $_POST['update_p_name'];
        $update_p_price = $_POST['update_p_price'];
        $update_p_stock = $_POST['update_p_stock'];
        $update_p_img = $_FILES['update_p_image']['name'];
        $update_p_img_tmp_name = $_FILES['update_p_image']['tmp_name'];
        $update_p_folder = 'image/'.$update_p_img;

        $update_query = mysqli_query($con, "UPDATE `product` SET id='$update_p_id', name='$update_p_name', price='$update_p_price',
        stock='$update_p_stock', image='$update_p_img' WHERE id = '$update_p_id'") or die('query failed');

        if($update_query) {
            move_uploaded_file($update_p_img_tmp_name,$update_p_folder);
            $message = 'Product has been updated successfully';
            echo '<script>window.location.href = "admin.php?message=' . urlencode($message) . '";</script>';
        }
        else {
            $message = 'Product could not be updated successfully';
            echo '<script>window.location.href = "admin.php?message=' . urlencode($message) . '";</script>';
        }       
            }
?>










<style>
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    display: inline-block;
    padding: 8px 16px;
    text-decoration: none;
    color: #000;
    border: 1px solid #ddd;
    margin-right: 5px;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}
</style>







<div class="container-fluid px-4">
    <h1 class="mt-4">Shop</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Products</li>
    </ol>        
</div>


<?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo '
        <div class="message">
            <span>' . $message . '<i class="fas fa-times" 
                onclick="this.parentElement.style.display=`none`"></i></span>
        </div>';
}
?>




<section class="edit-form">
    <?php 
        if(isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($con, "SELECT * FROM `product` WHERE id=$edit_id") or die('query failed');

            if(mysqli_num_rows($edit_query) > 0) {
                while($fetch_edit = mysqli_fetch_assoc($edit_query)) {        
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Update Product</h3>
        <img src="image/<?php echo $fetch_edit['image']; ?>">
        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
        <input type="text" name="update_p_name" value="<?php echo $fetch_edit['name']; ?>" required>
        <input type="number" name="update_p_price" value="<?php echo $fetch_edit['price']; ?>" required>
        <input type="number" name="update_p_stock" value="<?php echo $fetch_edit['stock']; ?>" required>
        <input type="file" name="update_p_image" accept="image/png, image/jpg, image/jpeg" required>
        <input type="submit" name="update_product" value="Update Product" class="btn update">
        <input type="reset" value="Cancel" class="option-btn cancel" id="close-edit">
    </form>
    <?php 
          }
        }
        echo "<script>document.querySelector('.edit-form').style.display = 'block'</script>";
    }
    ?>
</section>

<?php
    // Define the number of products to display per page
    $productsPerPage = 10;

    // Get the current page number from the URL query string
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the offset for the SQL query
    $offset = ($currentPage - 1) * $productsPerPage;

    // Fetch the products with pagination
    $select_products = mysqli_query($con, "SELECT * FROM `product` LIMIT $offset, $productsPerPage") or die('query failed');
    $totalProducts = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `product`"));

    // Calculate the total number of pages
    $totalPages = ceil($totalProducts / $productsPerPage);
?>
<section class="show-product">
    <table>
        <!-- Table header -->
        <thead>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Stock</th>
            <th>Action</th>
        </thead>
        <!-- Table body -->
        <tbody>
            <?php 
                // Check if there are any products to display
                if ($totalProducts > 0) {
                    while ($row = mysqli_fetch_assoc($select_products)) {
                        // Display the product row
                        ?>
                        <tr>
                            <td><img src="image/<?php echo $row['image']; ?>"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td>
                                <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn"><i class="bi bi-trash" onclick="return confirm('Are you sure you want to delete this item?')"></i>Delete</a>
                                <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"><i class="bi bi-pencil" onclick="return confirm('Are you sure you want to update this item?')"></i>Update</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Display a message if no products are found
                    echo "<tr><td colspan='5'>No products found.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php
            // Display pagination links
            for ($page = 1; $page <= $totalPages; $page++) {
                $activeClass = ($page == $currentPage) ? 'active' : '';
                echo "<a href='admin.php?page=$page' class='$activeClass'>$page</a>";
            }
        ?>
    </div>
</section>

<script type="text/javascript">
    const closeBtn = document.querySelector('#close-edit');

    closeBtn.addEventListener('click',()=>{
        document.querySelector('.edit-form').style.display = 'none'
    })
</script>



<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>