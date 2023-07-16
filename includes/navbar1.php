<nav id="navbar">
  <div class="logo">
    <img src="images/jedz.png" alt="Logo">
  </div>
  <!--<div class="search-container">
      <input type="text" placeholder="Search..." id="search-input">
      <button type="submit" id="search-button">Search</button>
    </div>
  <div class="item">
    <ul>
      <li><a href="#">Product</a></li>
      <li><a href="#">Services</a></li>
    </ul>
  </div>-->

  <div class="cart">

    <?php 
      $select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
    ?>

    <a href="cart.php" class="cart">Cart <span><?php echo $row_count; ?></span></a>
  </div>
    

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


