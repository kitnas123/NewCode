<?php
session_start();
include('admin/config/dbcon.php');
include('includes/header.php');




// Check if the add_to_cart button is clicked
if (isset($_POST['add_to_cart'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = 1; // Assuming the initial quantity is 1

    // Check if the item is already in the cart
    $check_query = "SELECT * FROM `cart` WHERE `name` = '$name'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "Item is already in the cart.";
        $modalClass = "error";
    } else {
        // Insert the cart item into the database
        $insert_query = "INSERT INTO `cart` (`name`, `price`, `image`, `quantity`) VALUES ('$name', '$price', '$image', '$quantity')";
        $insert_result = mysqli_query($con, $insert_query);

        if ($insert_result) {
            $message = "Item added to cart successfully.";
            $modalClass = "success";
        } else {
            $message = "Failed to add item to cart.";
            $modalClass = "error";
        }
    }


    
    echo "
    <script>
    function showModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    }
    
    window.onload = showModal;
    </script>
    
    <style>
    #modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }
    
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        text-align: center;
    }
    
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    
    .success {
        background-color: #c7e6c7;
    }
    
    .error {
        background-color: #f9c0c0;
    }
    </style>
    
    <div id='modal'>
        <div class='modal-content $modalClass'>
            <span class='close' onclick=\"document.getElementById('modal').style.display = 'none';\">&times;</span>
            <p>$message</p>
        </div>
    </div>";
}


?>

<nav id="navbar">
  <div class="logo">
    <img src="images/jedz.png" alt="Logo">
  </div>
  <div class="search-container">
      <input type="text" placeholder="Search..." id="search-input">
      <button type="submit" id="search-button">Search</button>
    </div>
  <div class="item">
    <ul>
      <li><a href="userpage.php">Product</a></li>
      <!--<li><a href="#">Services</a></li>-->
    </ul>
  </div>

  <div class="cart">

    <?php 
      $select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
    ?>

    <a href="cart.php" class="cart">Cart <span><?php echo $row_count; ?></span></a>
  </div>
    

  <div class="item-dropdown">
    <ul>
      <?php if(isset($_SESSION['auth_user'])) : ?>
      <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user"></i>
          <?= $_SESSION['auth_user']['user_name']; ?>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">My Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form action="allcode.php" method="POST">
              <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
            </form>
          </li>
        </ul>
      </li>
        <?php else : ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>





<div class="product-container">
    <h1>Products</h1>
    <div class="product-item-container">
        <?php 
            $select_products = mysqli_query($con, "SELECT * FROM `product`");
            if(mysqli_num_rows($select_products) > 0) {
                while($fetch_products = mysqli_fetch_assoc($select_products)) {     
        ?>
        <form action="" method="post">
            <div class="box">
            <img src="admin/image/<?php echo $fetch_products['image']; ?>" alt="" class="product-image" data-image="admin/image/<?php echo $fetch_products['image']; ?>" onclick="openModal('admin/image/<?php echo $fetch_products['image']; ?>', '<?php echo $fetch_products['name']; ?>', '<?php echo $fetch_products['price']; ?>', '<?php echo $fetch_products['stock']; ?>')">
                <?php 
                    $shortened_name = (strlen($fetch_products['name']) > 18) ? substr($fetch_products['name'], 0, 18).'...' : $fetch_products['name'];
                ?>
                <h6 class="product-name"><?php echo $shortened_name; ?></h6>
                <div class="price">&#8369;<?php echo $fetch_products['price']; ?></div>
                <input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="stock" value="<?php echo $fetch_products['stock']; ?>">
                <input type="hidden" name="image" value="<?php echo $fetch_products['image']; ?>">
                <button type="submit" name="add_to_cart" class="btn" data-message="<?php echo $message; ?>" onclick="showMessage(this)">Add to cart</button>
            </div>
        </form>
        <?php 
             }
            }
        ?>
    </div>
</div>
<!-- Modal -->

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="modal-close">&times;</span>
    <img id="modal-image" src="" alt="">
    <h4 id="modal-name"></h4>
    <p id="modal-price"></p>
    <p id="modal-stock"></p>

  </div>
</div>


<script>
// Open the modal with the clicked image
function openModal(imageUrl, name, price, stock) {
  var modal = document.getElementById("myModal");
  var modalImage = modal.querySelector("#modal-image");
  var modalName = modal.querySelector("#modal-name");
  var modalPrice = modal.querySelector("#modal-price");
  var modalStock = modal.querySelector("#modal-stock");

  modalImage.src = imageUrl;
  modalName.textContent = name;
  modalPrice.textContent = "Price: " + price;
  modalStock.textContent = "Stock: " + stock;


  modal.style.display = "block";


  // Open the modal with the clicked image
  function openModal(imageUrl) {
  var modal = document.getElementById("myModal");
  var modalImage = modal.querySelector("#modal-image");
  modalImage.src = imageUrl;
  modal.style.display = "block";
}

  // Close the modal
  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }

  // Add click event to each product image
  var productImages = document.getElementsByClassName("product-image");
  for (var i = 0; i < productImages.length; i++) {
    productImages[i].addEventListener("click", function() {
      var imageUrl = this.getAttribute("data-image");
      openModal(imageUrl);
    });
  }

  // Close modal when the close button is clicked
  var closeBtn = document.getElementsByClassName("modal-close")[0];
  closeBtn.addEventListener("click", closeModal);

  // Close modal when the user clicks outside the modal content
  window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
      closeModal();
    }
  });
}
  
</script>



<?php
include('includes/footer.php');
?>
