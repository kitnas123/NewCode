<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    $update_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'") or die('query failed');
    if ($update_query) {
        header('Location: cart.php');
        exit();
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('Location: cart.php');
    exit();
}

if (isset($_GET['delete_all'])) {
    mysqli_query($con, "DELETE FROM `cart`");
    header('Location: cart.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="admin/css/shopping-cart.css">

    <style>
        /* Modal Styles */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .custom-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
            border-radius: 5px;
        }

        .custom-modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .btns {
            border: none;
            color: white;
            border-radius: 5px;
            background-color: green;
            padding: 10px;
            text-decoration: none;
            margin-top: 10px;
        }

        .custom-modal-close:hover,
        .custom-modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        .delete-btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #dc3545;
            color: #fff;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
        
        .delete-btn-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php 
    include('includes/header.php');
    include('includes/navbar1.php'); 
    ?>

    <div class="cart-container">
        <h1 class="heading">Shopping Cart</h1>
        
        <table>
        <thead>
            <th>Select</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
        </thead>

            <tbody>
                <?php
                $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
                $grand_total = 0;
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $cart_id = $fetch_cart['id'];
                        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total += $sub_total;
                ?>

                <tr>
                <td><input type="checkbox" name="selected_items[]" value="<?php echo $cart_id; ?>" checked onchange="updateTotalPrice(this)"></td>

                    <td><img src="admin/image/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                    <td><?php echo $fetch_cart['name']; ?></td>
                    <td>&#8369;<?php echo number_format($fetch_cart['price']); ?></td>
                    <td class="quantity">
                        <div class="quantity-input">
                            <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                            <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']; ?>" onchange="updateTotalPrice(this)">
                            <div class="quantity-arrows">
                                <span class="arrow up" onclick="increaseQuantity(this)"></span>
                                <span class="arrow down" onclick="decreaseQuantity(this)"></span>
                            </div>
                        </div>
                    </td>
                    <td class="total-price">&#8369;<?php echo number_format($sub_total); ?></td>
                    <td class="delete-btn-container">
                        <a href="#" class="delete-btn" onclick="showModalRemove(<?php echo $fetch_cart['id']; ?>)">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>

                <tr class="table-bottom">
                    <td><a href="userpage.php" class="option-btn">Continue Shopping</a></td>
                    <td colspan="4"><h1>Total</h1></td>
                    <td style="font-weight: bold;"><span class="grand-total">&#8369;<?php echo number_format($grand_total); ?></span></td>
                    <td class="delete-btn-container">
                        <a href="#" class="delete-btn" onclick="showModalDeleteAll()">
                            <i class="fas fa-trash"></i> Delete all
                        </a>
                        <form action="checkout.php" method="post">
                            <input type="hidden" name="selected_items[]" value="">
                            <button type="submit" class="btns <?= ($grand_total > 1) ? '' : 'disabled' ?>" onclick="updateSelectedItems()">Proceed to Checkout</button>
                        </form>
                    </td>
                    
                </tr>
            </tbody>
        </table>

        <!--<div class="checkout-btn">
            <form action="checkout.php" method="post">
                <input type="hidden" name="selected_items[]" value="">
                <button type="submit" class="btn <?= ($grand_total > 1) ? '' : 'disabled' ?>" onclick="updateSelectedItems()">Proceed to Checkout</button>
            </form>
        </div>-->
    </div>


    <script>
        function updateTotalPrice(checkbox) {
  // Get the table row containing the checkbox
  var row = checkbox.closest('tr');

  // Get the price and quantity elements in the row
  var priceElement = row.querySelector('.price');
  var quantityElement = row.querySelector('.quantity input');

  // Get the total price element in the row
  var totalPriceElement = row.querySelector('.total-price');

  // Get the grand total element
  var grandTotalElement = document.querySelector('.grand-total');

  // Calculate the subtotal
  var price = parseFloat(priceElement.innerText.replace(/[^0-9.-]+/g, ''));
  var quantity = parseInt(quantityElement.value);
  var subtotal = price * quantity;

  // Update the total price in the row
  totalPriceElement.innerText = '₱' + subtotal.toFixed(2);

  // Update the grand total
  var grandTotal = 0;
  var totalPriceElements = document.querySelectorAll('.total-price');
  totalPriceElements.forEach(function (element) {
    grandTotal += parseFloat(element.innerText.replace(/[^0-9.-]+/g, ''));
  });

  grandTotalElement.innerText = '₱' + grandTotal.toFixed(2);
}

    </script>


<script>
  function updateTotalPrice(input) {
    // Get the table row containing the input
    var row = input.closest('tr');

    // Get the price element in the row
    var priceElement = row.querySelector('.price');

    // Get the total price element in the row
    var totalPriceElement = row.querySelector('.total-price');

    // Get the grand total element
    var grandTotalElement = document.querySelector('.grand-total');

    // Calculate the subtotal
    var price = parseFloat(priceElement.innerText.replace(/[^0-9.-]+/g, ''));
    var quantity = parseInt(input.value);
    var subtotal = price * quantity;

    // Update the total price in the row
    totalPriceElement.innerText = '₱' + subtotal.toFixed(2);

    // Update the grand total
    var grandTotal = 0;
    var totalPriceElements = document.querySelectorAll('.total-price');
    totalPriceElements.forEach(function (element) {
      grandTotal += parseFloat(element.innerText.replace(/[^0-9.-]+/g, ''));
    });

    grandTotalElement.innerText = '₱' + grandTotal.toFixed(2);
  }
</script>



   



























    <!-- Modal for Remove Confirmation -->
    <div id="removeModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="custom-modal-close" onclick="hideModalRemove()">&times;</span>
            <h2>Confirmation</h2>
            <p>Are you sure you want to remove this item from the cart?</p>
            <a href="#" class="btns" id="modal-remove-btn"><i class="fas fa-trash"></i>Remove</a>
        </div>
    </div>
    
    <!-- Modal for Delete All Confirmation -->
    <div id="deleteAllModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="custom-modal-close" onclick="hideModalDeleteAll()">&times;</span>
            <h2>Confirmation</h2>
            <p>Are you sure you want to delete all items from the cart?</p>
            <a href="cart.php?delete_all" class="btns"><i class="fas fa-trash"></i>Delete All</a>
        </div>
    </div>

    <script src="admin/js/admin-product.js"></script>
    <script>
        // JavaScript functions for modal handling
        function showModalRemove(itemId) {
            var modal =document.getElementById("removeModal");
            modal.style.display = "block";

            var removeButton = document.getElementById("modal-remove-btn");
            removeButton.href = "cart.php?remove=" + itemId;
        }

        function hideModalRemove() {
            var modal = document.getElementById("removeModal");
            modal.style.display = "none";
        }
        
        function showModalDeleteAll() {
            var modal = document.getElementById("deleteAllModal");
            modal.style.display = "block";
        }

        function hideModalDeleteAll() {
            var modal = document.getElementById("deleteAllModal");
            modal.style.display = "none";
        }
    </script>


</body>
</html>
