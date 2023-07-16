<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="index/styles.css" rel="stylesheet"/>
</head>
<style>
  .container {
  max-width: 960px;
  margin: 0 auto;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.image-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
  
.image-container {
  position: relative;
  width: 200px; /* Adjust the width as desired */
  height: 200px; /* Adjust the height as desired */
  margin-right: 10px; /* Adjust the gap size as desired */
  overflow: hidden;
}

.image-container:last-child {
  margin-right: 0; /* Remove right margin from the last image */
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  .image-container:hover .overlay {
    opacity: 1;
  }
  
  .plus-icon {
    color: white;
    font-size: 40px;
  }
  
  /* Optional styles for captions */
  .image-container p {
    color: white;
    position: absolute;
    bottom: 10px;
    left: 10px;
    margin: 0;
    font-size: 16px;
  }
  

/* testimonial */





</style>

<body>
  <nav>
    <div class="wrapper">
      <div class="logo">
        <a href="#">
          <img class="img" src="images/jedz.png" alt="Logo">
          Jedz Aesthetic Clinic
        </a>
      </div>
      <input type="radio" name="slider" id="menu-btn">
      <input type="radio" name="slider" id="close-btn">
      <ul class="nav-links">
        <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
        <li><a href="landing.php">Shop</a></li>
        <li><a href="#portfolio">Portfolio</a></li>
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
          <!--<input type="checkbox" id="showMega">
          <label for="showMega" class="mobile-item">Services</label>
          <div class="mega-box">
            <div class="content">
              <div class="row">
                <header>Free Diamond Peel</header>
                <ul class="mega-links">
                  <li><a href="diamond/whiteningunderarm.php">Carbon Laser Whitening Underarm</a></li>
                  <li><a href="diamond/whiteningknee.php">Carbon Laser Whitening Knee</a></li>
                  <li><a href="diamond/whiteningnape.php">Carbon Whitening Nape</a></li>
                  <li><a href="diamond/whiteningback.php">Carbon Whitening Back</a></li>
                </ul>
              </div>
              <div class="row">
                <header>Removal Laser Permanent</header>
                <ul class="mega-links">
                  <li><a href="laser/underarm.php">Hair Removal Underarm</a></li>
                  <li><a href="laser/whitening.php">Whitening Underarm</a></li>
                  <li><a href="laser/fullface.php">Hair Removal Fullface</a></li>
                  <li><a href="laser/brazillian.php">Brazillian</a></li>
                </ul>
              </div>
              <div class="row">
                <header>Lash And Brows</header>
                <ul class="mega-links">
                  <li><a href="#">Lash Shift w/ Free Tint</a></li>
                  <li><a href="#">Eyebrow Lamination</a></li>
                  <li><a href="#">Eyelash Extension Classic</a></li>
                  <li><a href="#">Eyelash Extension Volume</a></li>
                </ul>
              </div>
              <div class="row">
                <header>Semi Permanent</header>
                <ul class="mega-links">
                  <li><a href="#">Ombre Brows</a></li>
                  <li><a href="#">Microblading</a></li>
                  <li><a href="#">Combrows</a></li>
                  <li><a href="#">DigiBrows</a></li>
                  <li><a href="#">Lip Brush</a></li>
                  <li><a href="#">Lip Correction</a></li>
                </ul>
              </div>
              <div class="row">
                <header>Semi Permanent</header>
                <ul class="mega-links">
                  <li><a href="#">EyeLiner Classic</a></li>
                  <li><a href="#">Eyeliner Wiwing</a></li>
                  <li><a href="#">Cheek Blush</a></li>
                  <li><a href="#">Nipple Pinkish</a></li>
                  <li><a href="#">Sculp Micropigmentation</a></li>
                </ul>
              </div>
            </div>

            <div class="content">
                <div class="row">
                  <header>Face</header>
                  <ul class="mega-links">
                    <li><a href="#">Complete Facial</a></li>
                    <li><a href="#">W/ Diamond Peel</a></li>
                    <li><a href="#">Intensive Facial</a></li>
                    <li><a href="#">Luxury Facial</a></li>
                    <li><a href="#">Hydra Facial</a></li>
                    <li><a href="#">Acne Treatment</a></li>
                    <li><a href="#">Anti Aging Facial</a></li>
                    <li><a href="#">Eyebag Removal</a></li>
                    <li><a href="#">Black Doll w/ Diamond Peel</a></li>
                    <li><a href="#">Hifu Fullface</a></li>
                    <li><a href="#">Hifu Chin</a></li>
                  </ul>
                </div>
                <div class="row">
                  <header>Face</header>
                  <ul class="mega-links">
                    <li><a href="#">Hifu Neck</a></li>
                    <li><a href="#">Warts Removal Face</a></li>
                    <li><a href="#">Warts Removal Neck</a></li>
                    <li><a href="#">Syringoma Removal</a></li>
                    <li><a href="#">Skin Tag Removal</a></li>
                    <li><a href="#">Eviu Fullface</a></li>
                    <li><a href="#">Rejuvination only</a></li>
                    <li><a href="#">Melasma Treatment</a></li>
                    <li><a href="#">Pimple Injection</a></li>
                    <li><a href="#">Korean 55 Glow</a></li>
                    <li><a href="#">RF Factional</a></li>
                  </ul>
                </div>
                <div class="row">
                  <header>Summing</header>
                  <ul class="mega-links">
                    <li><a href="#">RF Cavitation Tummy</a></li>
                    <li><a href="#">RF Cavitation Face</a></li>
                    <li><a href="#">RF Cavitation Arms</a></li>
                    <li><a href="#">Mesolipo Tummy</a></li>
                    <li><a href="#">Mesolipo Cheek</a></li>
                    <li><a href="#">Mesolipo Arms</a></li>
                    <li><a href="#">Barbie Arms</a></li>
                    <li><a href="#">Exilis Tummy</a></li>
                  </ul>
                </div>
                <div class="row">
                  <header>Non Surgical</header>
                  <ul class="mega-links">
                    <li><a href="#">Hiko Nose Lift Thread</a></li>
                    <li><a href="#">Tipnose Free Alartox</a></li>
                    <li><a href="#">Lip Filler</a></li>
                    <li><a href="#">Cog Thread</a></li>
                  </ul>
                </div>
                <div class="row">
                    <header>Gluta</header>
                    <ul class="mega-links">
                      <li><a href="#">I.V Push</a></li>
                      <li><a href="#">Drip</a></li>
                    </ul>
                  </div>
              </div>
          </div>-->
        </li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
    </div>
  </nav>

      <!-- For Masthead -->
      <header class="masthead">
        <div class="slideshow-container">
          <div class="mySlides">
            <img class="masthead-image" src="images/je.jpg" alt="Image 1">
          </div>
          <div class="mySlides">
            <img class="masthead-image" src="images/wallpaper1.jpg" alt="Image 2">
          </div>
          <div class="mySlides">
            <img class="masthead-image" src="images/wallpaper1.jpg" alt="Image 3">
          </div>
        </div>
      </header>
<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1;
      }
      slides[slideIndex - 1].style.display = "block";
      setTimeout(showSlides, 2000); // Change slide every 2 seconds
    }
  </script>



    <div class="container" id="portfolio">
        <h2 style="margin-top: 70px;">Portfolio</h2>
        <div class="image-row">
            <div class="image-container">
            <img src="images/brows1.jpg" alt="Image 1">
            <div class="overlay">
                <div class="plus-icon">+</div>
            </div>
            <!--<p>Eyebrow Reconstruction</p>-->
            </div>
            <div class="image-container">
            <img src="images/brows2.jpg" alt="Image 2">
            <div class="overlay">
                <div class="plus-icon">+</div>
            </div>
            <!--<p>Window</p>-->
            </div>
            <div class="image-container">
            <img src="images/lips.jpg" alt="Image 3">
            <div class="overlay">
                <div class="plus-icon">+</div>
            </div>
            <!--<p>Lip Blushing Tattoo</p>-->
            </div>
        </div>
        <div class="image-row">
            <div class="image-container">
            <img src="images/nose.jpg" alt="Image 1">
            <div class="overlay">
                <div class="plus-icon">+</div>
            </div>
            <!--<p>Eyebrow Reconstruction</p>-->
            </div>
            <div class="image-container">
            <img src="images/nose1.jpg" alt="Image 2">
            <div class="overlay">
                <div class="plus-icon">+</div>
            </div>
            <!--<p>Window</p>-->
            </div>
            <div class="image-container">
            <img src="images/nails1.jpg" alt="Image 3" style="height: 278px;">
            <div class="overlay">
                <div class="plus-icon">+</div>
            </div>
            <!--<p>Lip Blushing Tattoo</p>-->
            </div>
        </div>
    </div>


    <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    
                </div>
                <div class="row">
                <div class="col-md-8 offset-md-2">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="homepage/assets/img/about/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2009-2011</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="homepage/assets/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2011</h4>
                                <h4 class="subheading">An Agency is Born</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="homepage/assets/img/about/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2015</h4>
                                <h4 class="subheading">Transition to Full Service</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="homepage/assets/img/about/4.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>July 2020</h4>
                                <h4 class="subheading">Phase Two Expansion</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
              </div>
              </div>
            </div>
        </section>


        






        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                </div>
                        <div class="tree">
                              <ul>
                                  <li>
                                      <a href="#"><p>JEDDAH LYN G. REBOBLE</p><span>CEO/OWNER</span></a>
                                          <ul>
                                              <li>
                                                  <a href="#"><p>MARY JANE JALONG<br>ANGELICA FARINAS<br>VERONICA ALLYSON</p><span>FACIALIST</span></a>
                                                  <a href="#"><p>AVRIL MALPAYA</p><span>NAIL TECHNICIAN</span></a>
                                                  <a href="#"><p>KIMBERLY DOMINGO</p><span>BROW ARTIST</span></a>
                                                  <a href="#"><p>LOVELY CHARLENE GULENG<br>MAYBELLE MADROWY<br>NIKKI SALCEDO<br>VANESSA SALCEDO</p><span>STAFF</span></a>
                                              </li>
                                          </ul>
                                  </li>
                              </ul>
                        </div>
            </div>
        </section>
          

        



</body>
</html>