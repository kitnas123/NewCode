<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment-method'];
    $street = $_POST['street'];
    $address = $_POST['address'];
    $zip_code = $_POST['zip_code'];

    $cart_query = mysqli_query($con, "SELECT * FROM `cart`");
    $price_total = 0;
    $product_name = array();
    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
            $product_price = $product_item['price'] * $product_item['quantity'];
            $price_total += $product_price;
        }
    }

    $total_products = implode(', ', $product_name);
    $detail_query = mysqli_query($con, "INSERT INTO `orders`(`name`, `number`, `email`, `method`, `street`, `address`, `zip_code`, `total_products`, `total_price`) VALUES('$name', '$number', '$email', '$payment_method', '$street', '$address', '$zip_code', '$total_products', '$price_total')") or die('query failed');

    if ($cart_query && $detail_query) {
        echo "
        <div class='order-message-container'>
            <div class='message-container'>
                <h3>Thank you for shopping!</h3>
                <div class='order-detail'>
                    <span>" . $total_products . "</span>
                    <span class='total'> total : &#8369;" . $price_total . " </span>
                </div>
                <div class='customer-details'>
                    <p> Your name : <span>" . $name . "</span> </p>
                    <p> Your number : <span>" . $number . "</span> </p>
                    <p> Your email : <span>" . $email . "</span> </p>
                    <p> Your address : <span>" . $street . ", " . $address . ", " . $zip_code . "</span></p>
                    <p> Your payment mode : <span>" . $payment_method . "</span> </p>
                    <p>(*pay when product arrives*)</p>
                </div>
                <a href='userpage.php' class='btn'>continue shopping</a>
            </div>
        </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/css/checkout.css">
</head>
<body>
    <?php 
    include('includes/header.php');
    ?>

    <div class="checkout-form">
        <h1>Payment</h1>
        <div class="display-order">
        <?php 
$select_cart = mysqli_query($con, "SELECT * FROM `cart`");
$total = 0;
$grand_total = 0;
if (mysqli_num_rows($select_cart) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $total_price;
        ?>
        <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
        <?php
    }
}
?>
<span class="grand-total"> Total Amount : &#8369;<?= number_format($grand_total); ?></span>
</div>

        <form method="post">
            <div class="input-field">
                <span>Your Name</span>
                <input type="text" placeholder="Enter your name" name="name" required>
            </div>
            <div class="input-field">
                <span>Your Number</span>
                <input type="text" placeholder="Enter your number" name="number" required>
            </div>
            <div class="input-field">
                <span>Your Email</span>
                <input type="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="input-field">
                <span>Payment Method</span>
                <select name="payment-method">
                    <option value="cash on delivery" selected>Cash on delivery</option>
                    <option value="gcash">Gcash</option>
                </select>
            </div>
            <div class="input-field">
                <span>Street</span>
                <input type="text" placeholder="Zone no." name="street" required>
            </div>
            <div class="input-field">
                <span>Address</span>
                <input type="text" placeholder="Full Address" name="address" required>
            </div>
            <div class="input-field">
                <span>Zip Code</span>
                <input type="text" placeholder="zip code no." name="zip_code" required>
            </div>
            <input type="submit" value="Order now" name="order_btn" class="btn">
        </form>
    </div>
</body>
</html>
