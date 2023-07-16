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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="index/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="includes/landing.css" />
    <title>Shop Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
    /* Modal styles */
.modal {
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
  margin: 10% auto;
  padding: 30px;
  border: 1px solid #888;
  width: 90%;
  max-width: 600px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  position: relative;
}

/* Close button */
.close {
  color: #aaa;
  float: right;
  font-size: 32px;
  font-weight: bold;
  position: absolute;
  top: 10px;
  right: 20px;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Card styles */
.card {
  background-color: #f8f9fa;
  border-radius: 4px;
  padding: 30px;
  margin-top: 30px;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-header h4 {
  font-size: 24px;
}

/* Form styles */
.form-group {
  margin-bottom: 20px;
}

.form-control {
  width: 100%;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

.btn-primary {
  background-color: #007bff;
  border: none;
  color: #fff;
  padding: 12px 24px;
  cursor: pointer;
  border-radius: 4px;
  font-size: 18px;
}

.reg {
  margin-top: 15px;
}

.reg a {
  color: #007bff;
  text-decoration: none;
}

.reg a:hover {
  text-decoration: underline;
}


    </style>
</head>

<body>

<nav>
    <div class="wrapper">
      <div class="logo">
        <a href="index.php">
          <img class="img" src="images/jedz.png" alt="Logo">
          Jedz Aesthetic Clinic
        </a>
      </div>
      <input type="radio" name="slider" id="menu-btn">
      <input type="radio" name="slider" id="close-btn">
      <ul class="nav-links">
        <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
        <li><a href="landing.php">Shop</a></li>
        <li><a href="#">Portfolio</a></li>
        <li>
          <a href="#" class="desktop-item">Team</a>
          <!--<input type="checkbox" id="showDrop">
          <label for="showDrop" class="mobile-item">Dropdown Menu</label>
          <ul class="drop-menu">
            <li><a href="#">Drop menu 1</a></li>
            <li><a href="#">Drop menu 2</a></li>
            <li><a href="#">Drop menu 3</a></li>
            <li><a href="#">Drop menu 4</a></li>
          </ul>-->
        </li>
        <li>
          <a href="services.php" class="desktop-item">Services</a>
        </li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
    </div>
  </nav>


  <?php include('message.php'); ?>

    <section class="home" id="home ">
        <div class="content">
            <!-- Tagline -->
            <h3 class="mainfont">
                <span class="yellowColor">Jedz Aesthetic Clinic</span>
            </h3>
            <!--Description  -->
            <p>
            Thank you for choosing our online salon shop as your go-to destination for all things beauty. 
            We're excited to embark on this digital journey with you and provide an unparalleled shopping experience. 
            Pamper yourself, explore our exquisite selection, and unlock a world of beauty possibilities.
            </p>

            <!-- CTA -->
            <a href="#" id="loginBtn" class="btn">SHOP NOW</a>
        </div>
        <!-- Hero image -->

        <div class="image">
            <img src="images/jedz.png. " alt=" " />
        </div>
    </section>


    
        <!-- for login form --> 
        <div id="loginModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Your login form HTML code goes here -->
                            <?php include('message.php'); ?>

                        <div class="card">
                            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; ">  
                                <h4>Login</h4>
                                <!--<button class="back-button"><a href="index.php">X</a></button>-->
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
                                      <p>Not have an account yet? <a id="registerLink" href="#">Register here</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>  
                      </div>
                    </div>





      
        
            
         
                    <div id="registerModal" class="modal">
                      <div class="modal-content">
                        <span class="close">&times;</span>
                        <!-- Your register form HTML code goes here -->
                        <?php include('message.php'); ?>

                        <div class="card">
                          <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; ">
                            <h4>Register</h4>
                          </div>
                          <div class="card-body">
                            <form action="registercode.php" method="POST">
                              <!-- Register form fields -->
                              <div class="form-group mb-3">
                                    <label>First Name</label>
                                    <input required type="text" name="fname" placeholder="Enter your firstname" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Last Name</label>
                                    <input required type="text" name="lname" placeholder="Enter your Last Name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Email Id</label>
                                    <input required type="email" name="email" placeholder="Enter your email address" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input required type="password" name="password" placeholder="Enter your password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Confirm Password</label>
                                    <input required type="password" name="cpassword" placeholder="Enter confrim password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                                </div>
                            </form>
                            <div class="reg">
                              <p>Already have an account? <a id="loginLink" href="#">Login here</a></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  






         
        <script>
  // Get the modal elements
  var loginModal = document.getElementById('loginModal');
  var registerModal = document.getElementById('registerModal');

  // Get the buttons that open the modals
  var loginBtn = document.getElementById('loginBtn');
  var registerLink = document.getElementById('registerLink');
  var loginLink = document.getElementById('loginLink');

  // Get the <span> elements that close the modals
  var closeBtns = document.getElementsByClassName('close');

  // Function to open the login modal
  function openLoginModal() {
    loginModal.style.display = 'block';
    registerModal.style.display = 'none';
  }

  // Function to open the register modal
  function openRegisterModal() {
    registerModal.style.display = 'block';
    loginModal.style.display = 'none';
  }

  // Function to close the modals
  function closeModal() {
    loginModal.style.display = 'none';
    registerModal.style.display = 'none';
  }

  // Function to go back to the login form
  function goBackToLogin() {
    registerModal.style.display = 'none';
    loginModal.style.display = 'block';
  }

  // Event listener for the "Login here" link on the register form modal
  loginLink.addEventListener('click', goBackToLogin);

  // Event listeners for opening and closing the modals
  loginBtn.addEventListener('click', openLoginModal);
  registerLink.addEventListener('click', openRegisterModal);
  loginLink.addEventListener('click', openLoginModal);

  // Event listeners for closing the modals
  for (var i = 0; i < closeBtns.length; i++) {
    closeBtns[i].addEventListener('click', closeModal);
  }

  // Event listener to close the modal when clicking outside the modal
  window.addEventListener('click', function (event) {
    if (event.target === loginModal || event.target === registerModal) {
      closeModal();
    }
  });
</script>
    

    <!-- hero section ends   -->
    <?php 
      include('include/footer.php');
    ?>
</body>

</html>
