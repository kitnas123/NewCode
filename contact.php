<?php
require('admin/config/dbcon.php');

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $Msg = $_POST['Msg'];
  $con = new mysqli('localhost', 'root', '', 'jedz');


  $sql = "INSERT INTO contact (name, email, Msg) VALUES ('$name', '$email', '$Msg')";

  if ($con->query($sql)) {
    $message = "<div class='alert alert-success'>Message Sent <button type='button' class='close' data-dismiss='alert' onclick='closeMessage()'>&times;</button></div>";
  } else {
    $message = "<div class='alert alert-danger'>Something Went Wrong <button type='button' class='close' data-dismiss='alert' onclick='closeMessage()'>&times;</button></div>";
  }

}


?>


<!DOCTYPE html>
<html>

<head>
  <title>Contact Page</title>

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="index/styles.css" rel="stylesheet" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    /* Add some basic styling for the contact form */
    body {
      background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
    }

    .contact-form {
      background: #fff;
      margin-top: 10%;
      margin-bottom: 5%;
      width: 70%;
    }

    .contact-form .form-control {
      border-radius: 1rem;
    }

    .contact-image {
      text-align: center;
    }

    .contact-image img {
      border-radius: 6rem;
      width: 11%;
      margin-top: -3%;
      transform: rotate(29deg);
    }

    .contact-form form {
      padding: 14%;
    }

    .contact-form form .row {
      margin-bottom: -7%;
    }

    .contact-form h3 {
      margin-bottom: 8%;
      margin-top: -10%;
      text-align: center;
      color: #0062cc;
    }


    .contact-form .btnContact {
      width: 50%;
      border: none;
      border-radius: 1rem;
      padding: 1.5%;
      background: #dc3545;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
    }

    .btnContactSubmit {
      width: 50%;
      border-radius: 1rem;
      padding: 1.5%;
      color: #fff;
      background-color: #0062cc;
      border: none;
      cursor: pointer;
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


  <div class="container contact-form">
    <div class="contact-image">
      <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
    </div>
    <?php echo isset($message) ? $message : ''; ?>
    <form action="contact.php" method="POST" enctype="multipart/form-data">
      <h3>Drop Us a Message</h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name *" value="" />
          </div>
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Your Email *" value="" />
          </div>

        </div>
        <div class="col-md-6">
          <div class="form-group">
            <textarea name="Msg" class="form-control" placeholder="Your Message *"
              style="width: 100%; height: 290px;"></textarea>
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Send</button>
      </div>
    </form>
  </div>

  <script>
    function closeMessage() {
      var messageElement = document.querySelector('.alert');
      messageElement.style.display = 'none';
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
    crossorigin="anonymous"></script>
  </div>
</body>

</html>