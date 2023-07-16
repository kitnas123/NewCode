<?php
session_start();
error_reporting(0);
include_once('admin/config/dbcon.php');
// Step 4: Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 5: Insert the data into the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];
    $branch = $_POST['$branch'];

    // Prepare the SQL statement
    $sql = "INSERT INTO appointment (name, email, phone, age, gender, address, date, time, service, branch)
            VALUES ('$name', '$email', '$phone', $age, '$gender', '$address', '$date', '$time', '$service', '$branch')";

    if (mysqli_query($con, $sql)) {
        ?>
        <div class="alert alert-success" role="alert">
            Data inserted successfully!
        </div>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}

?>

<?php
function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'jedz');
    $stmt = $mysqli->prepare("SELECT DATE, COUNT(*) as bookings_count FROM bookings_record WHERE MONTH(DATE) = ? AND YEAR(DATE) = ? GROUP BY DATE");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[$row['DATE']] = $row['bookings_count'];
            }
            $stmt->close();
        }
    }

    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');

    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-xs btn-success' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> ";
    $currentMonthURL = "?month=" . date('m') . "&year=" . date('Y');
    $calendar .= " <a class='btn btn-xs btn-danger' href='$currentMonthURL#calendar'>Current Month</a> ";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></center><br>";
    
    
    


    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }

    $currentDay = 1;
    $calendar .= "</tr><tr>";

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td  class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {

        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";

        if ($date < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>N/A</button>";
        } else {
            $bookingsCount = isset($bookings[$date]) ? $bookings[$date] : 0;
            $availableCount = 10 - $bookingsCount; // Calculate available count
    
            if ($availableCount <= 0) {
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>Booked Out</button><br>";
            } else {
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='book/book.php?date=" . $date . "' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Book Now</a><br>";
            }
            $calendar .= "Available: $availableCount"; // Display the available count
        }

        $calendar .= "</td>";
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    echo $calendar;
}
?>





<?php 
    $baseURL = 'images/';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="services.css">
    <link rel="stylesheet" href="service/services.js">

    <style>
          /* Modal Styles */
          .modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .modal-content {
    background-image: url(images/barbie.png);
    background-repeat: no-repeat;
    background-size: cover;
    margin: 10% auto;
    padding: 40px;
    max-width: 800px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    position: relative;
    text-align: center; /* Center align the image */
  }

  .modal-content img {
    display: inline-block; /* Ensure the image is inline and centered */
    max-width: 40%; /* Limit the image width to 40% of the modal width */
    height: auto;
    width: 100%; /* Set width to 100% to maintain aspect ratio */
    margin: 0 auto; /* Center the image horizontally */
    margin-bottom: 20px;
  }

  .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    font-weight: bold;
    color: #aaa;
    cursor: pointer;
  }

  /* Optional: Add animation to the modal */
  .modal-content {
    animation-name: modal-animation;
    animation-duration: 0.3s;
  }

  @keyframes modal-animation {
    from {
      opacity: 0;
      transform: scale(0.8);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }






/*book */

  @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
		Label the data
		*/
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:#eee;
        }

    </style>
</head>

<body style="background: url(images/barbie.png); background-attachment: fixed; background-position: center center;
 background-repeat: no-repeat; width: 100%; background-size: cover;">
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

    <h1 class="h1"
        style="text-align: center; font-size: 50px; font-weight: 700; margin-top: 20px;  margin-bottom: 40px;">Our
        Services</h1>



    



        <div class="modal" id="serviceModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3 id="modalTitle"></h3>
                <p><span id="modalPrice"></span></p>
                <img id="modalImage" src="images" alt="Service Image" style="width: 250px; height: 250px;">
                <p id="modalContent"></p>
                <p><span id="modalDuration"></span></p>
            </div>
        </div>
        




    <div class="flex">
        <div class="contain">
            <header class="title">Free Diamond Peel</header>
            <ul>
                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Underarm" data-content="Skin Station has an intensive underarm whitening service, which is a non-laser treatment. 
                The procedure involves a combination of exfoliating treatments to remove the dead skin cells contributing to hyperpigmentation." data-image="<?php echo $baseURL; ?>white_underarm.jpg" data-duration="Duration : 45 minutes" data-price="&#8369; 599">Carbon Laser Whitening Underarm</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="Skin Station has an intensive underarm whitening service, which is a non-laser treatment. 
                The procedure involves a combination of exfoliating treatments to remove the dead skin cells contributing to hyperpigmentation." data-image="<?php echo $baseURL; ?>white_kneee.jpg" data-duration="Duration : 45 minutes" data-price="&#8369; 599">Carbon Laser Whitening Knee</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Whitening Nape" data-content="Skin Station has an intensive underarm whitening service, which is a non-laser treatment. 
                The procedure involves a combination of exfoliating treatments to remove the dead skin cells contributing to hyperpigmentation." data-image="<?php echo $baseURL; ?>white_nape.jpg" data-duration="Duration : 45 minutes" data-price="&#8369; 599">Carbon Whitening Nape</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Whitening Back" data-content="Skin Station has an intensive underarm whitening service, which is a non-laser treatment. 
                The procedure involves a combination of exfoliating treatments to remove the dead skin cells contributing to hyperpigmentation." data-image="<?php echo $baseURL; ?>white_underarm.jpg" data-duration="Duration : 45 minutes" data-price="&#8369; 999">Carbon Whitening Back</a></li>
            </ul>
        </div>
        <div class="contain">
            <header class="title">Removal Laser Permanent</header>
            <ul>

                <li><a href="#" class="modal-link" data-title=" Hair Removal Underarm " data-content=" Armpit laser hair removal provides longer lasting results than other home hair removal methods, 
                because the process temporarily destroys hair follicles. Still, your desired results may require multiple sessions." data-duration="Duration : 45 minutes" data-price="&#8369; 999" data-image="<?php echo $baseURL; ?>hair_removal.jpg">Hair Removal Underarm</a></li>

                <li><a href="#" class="modal-link" data-title=" Whitening Underarm " data-content=" Skin Station has an intensive underarm whitening service, which is a non-laser treatment. 
                The procedure involves a combination of exfoliating treatments to remove the dead skin cells contributing to hyperpigmentation. " data-duration="Duration : 45 minutes" data-price="&#8369; 999" data-image="<?php echo $baseURL; ?>underarm.jpg">Whitening Underarm</a></li>

                <li><a href="#" class="modal-link" data-title=" Hair Removal Fullface " data-content=" Laser hair removal on the face uses laser light technology beamed to the hair follicles to stop hair growth. 
                Laser hair removal on the face is a noninvasive medical procedure that uses a beam of light (a laser) to remove hair from the face. There was a time when laser hair removal worked best on people 
                with dark hair and light skin, but now, thanks to advancements in laser technology, it’s a suitable procedure for anyone who has unwanted hair they’d like to remove." data-duration="Duration : 45 minutes" 
                data-price="&#8369; 799" data-image="<?php echo $baseURL; ?>full_face.jpg">Hair Removal Fullface</a></li>

                <li><a href="#" class="modal-link" data-title=" Brazillian " data-content=" In a Brazilian wax, pubic hair is groomed and removed from the front of the pubic bone, around the 
                external genitals, between the upper thighs, and around the anus." data-duration="Duration : 45 minutes" data-price="&#8369; 999" data-image="<?php echo $baseURL; ?>brazillian.jpg">Brazillian</a></li>

            </ul>
        </div>
        <div class="contain">
            <header class="title">Lash And Brows</header>
            <ul>

                <li><a href="#" class="modal-link" data-title=" Lash Shift w/ Free Tint " data-content=" lash lift curls, colors, and elevates your natural eyelashes. The procedure involves curling, lifting, 
                and perming eyelashes to produce fuller, beautiful eyes. It causes your lashes to bend upwards, leaving your eyes more bright and open. Sometimes, eyelash lift is done together with a lash 
                tint to give excellent results. This painless procedure causes your eyelashes to look fuller, thicker and darker." data-duration="Duration : 45 minutes" data-price="&#8369; 350" data-image="<?php echo $baseURL; ?>lash_shift.jpg">Lash Shift w/ Free Tint</a></li>

                <li><a href="#" class="modal-link" data-title=" Eyebrow Lamination " data-content=" Eyebrow lamination is a fairly new cosmetic brow procedure that is done in a salon. The procedure lifts 
                and smooths brows with the goal of creating sleeker, neater and fuller-looking eyebrows." data-duration="Duration : 45 minutes" data-price="&#8369; 350" data-image="<?php echo $baseURL; ?>eyebrow_lamination.jpg">Eyebrow Lamination</a></li>

                <li><a href="#" class="modal-link" data-title=" Eyelash Extension Classic " data-content=" Eyelash extensions are semi-permanent fibers that are attached you to natural eyelashes in order
                 to make your lash look longer,Fuller,and darker." data-duration="Duration : 45 minutes" data-price="&#8369; 750" data-image="<?php echo $baseURL; ?>eyelash_extension.jpg">Eyelash Extension Classic</a></li>

                 <li><a href="#" class="modal-link" data-title=" Eyelash Extension Volume " data-content=" This lash extension will give your clients a fuller, fluffy and dramatic look. It allows for 
                 a high level of customization to achieve the desired look." data-duration="Duration : 45 minutes" data-price="&#8369; 999" data-image="<?php echo $baseURL; ?>eyelash_extension_volume.jpg">Eyelash Extension Volume</a></li>

            </ul>
        </div>
        <div class="contain">
            <header class="title">Non Surgical</header>
            <ul>
                <li><a href="#" class="modal-link" data-title=" Hiko Nose Lift Thread " data-content=" Hiko is non-surgical procedure that uses protein-based PDO/PCL threads to achieve satisfying nose 
                lift results instantly with long lasting visible results without surgery " data-duration="Duration : 45 minutes" data-price="&#8369; 7,999" data-image="<?php echo $baseURL; ?>hiko_nose_threadlift.jpg">Hiko Nose Lift Thread</a></li>

                <li><a href="#" class="modal-link" data-title=" Tipnose Free Alartox " data-content=" Alartox is used as a non-surgical option for nasal wrinkles removal and nasal tip lifting. 
                It is made by injecting with toxin needles on the nose. It is also effective in reducing and removing wrinkles on the nose, which appear due to mimics, especially after smiling." 
                data-duration="Duration : 45 minutes" data-price="&#8369; 2,999" data-image="<?php echo $baseURL; ?>with_alartox.jpg">Tip nose Free Alartox</a></li>

                <li><a href="#" class="modal-link" data-title=" Lip Filler " data-content=" Lip fillers are one of the most popular types of dermal filler. They increase the volume of your lips. " 
                data-duration="Duration : 45 minutes" data-price="&#8369; 6,999" data-image="<?php echo $baseURL; ?>lip_filler.jpg">Lip Filler</a></li>

                <li><a href="#" class="modal-link" data-title=" Cog Thread " data-content=" This is a facelift done without surgery to lift and tighten the skin of the face, It is known as the 'no blade facelift'." 
                data-duration="Duration : 45 minutes" data-price="&#8369; 7,999" data-image="<?php echo $baseURL; ?>cog_thread.jpg">Cog Thread</a></li>
            </ul>
            </ul>
        </div>
        <div class="contain">
            <header class="title">Face</header>
            <ul>
                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Complete Facial</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">W/ Diamond Peel</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Intensive Facial</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Luxury Facial</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Hydra Facial</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Acne Treatment</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Anti Aging Facial</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Eyebag Removal</a></li>

                <li><a href="#" class="modal-link" data-title="Black Doll Carbon laser" data-content="The Black Doll carbon laser facial treatment is a gentle laser treatment that smooths away imperfections from the skins
                surface and reduces the signs of ageing." data-duration="Duration : 45 minutes" data-price="&#8369; 1499" data-image="<?php echo $baseURL; ?>brazillian.jpg">Black Doll w/ diamond pell</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Hifu Fullface</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Hifu Chin</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Hifu Neck</a></li>
            </ul>
        </div>
        <div class="contain">
            <header class="title">Face</header>
            <ul>
                <li><a href="#" class="modal-link" data-title="Hifu Neck " data-content="skin care treatments for the face, including steam, exfoliation (physical and chemical), extraction, 
                creams, lotions, facial masks, peels, and massage. " data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Hifu Neck</a></li>

                <li><a href="#" class="modal-link" data-title="Warts Removal Face" data-content="A Diamond Peel is a crystal-free microdermabrasion. During this procedure, a state-of-the-art diamond 
                tipped hand piece will be used to gently remove the dead cells and debris on the outer layer of your skin, leaving smoother, cleaner, brighter skin. " 
                data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Warts Removal Face</a></li>

                <li><a href="#" class="modal-link" data-title="Warts Removal Neck" data-content="The Lavelier Intensive Facial Peel is a wash-off scrub that sloughs off all the gunk, grime, and 
                dead skin on the outer layers of your epidermis." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Warts Removal Neck</a></li>

                <li><a href="#" class="modal-link" data-title="Syringoma Removal" data-content="A luxurious collagen mask is applied to the face and eyes allowing the collagen to penetrate to the 
                skin acting as a powerful brightening and hydrating treatment. After this facial the skin feels smooth and becomes more luminous. Head, shoulders and neck massage is included 
                in the treatment." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Syringoma Removal</a></li>

                <li><a href="#" class="modal-link" data-title="Skin Tag Removal" data-content="The [HydraFacial] device uses an exfoliating tip paired with suction to remove dead skin cells from 
                the surface of your face,” says Akram. After skin is exfoliated, serums are infused into the skin, she says. That last step is the key reason proponents say it’s so effective." 
                data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Skin Tag Removal</a></li>

                <li><a href="#" class="modal-link" data-title="Eviu Fullface " data-content="An acne facial treatment can help clear out blackheads and remove dead skin from blocked pores. " 
                data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Eviu Fullface</a></li>

                <li><a href="#" class="modal-link" data-title="Rejuvination only" data-content="Facial treatments are available that aim to support more mature-looking skin. Facials may also 
                aim to provide the skin with substances that allow faster cell renewal or provide the skin with antioxidants to help prevent skin damage." data-duration="Duration : 45 minutes" 
                data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Rejuvination only</a></li>

                <li><a href="#" class="modal-link" data-title="Melasma Treatment" data-content="During blepharoplasty, the surgeon cuts into the creases of the eyelids to trim sagging skin and 
                muscle and remove excess fat. The surgeon rejoins the skin with tiny dissolving stitches." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Melasma Treatment</a></li>

                <li><a href="#" class="modal-link" data-title="Pimple Injection" data-content="The Black Doll Laser face treatment is often known as The Charcoal treatment or Laser carbon 
                wrinkle reduction and creates a porcelain dolls complexion. It is one of the most advanced treatments for minor skin imperfections and promotes a smooth and glowing complexion." 
                data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Pimple Injection</a></li>

                <li><a href="#" class="modal-link" data-title="Korean BB  Glow" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Korean BB  Glow</a></li>

                <li><a href="#" class="modal-link" data-title="RF Factional" data-content="A HIFU facial uses ultrasound to create heat at a deep level in the skin. This heat damages targeted 
                skin cells, causing the body to try to repair them. " data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">RF Factional</a></li>
            </ul>
        </div>
        <div class="contain">
            <header class="title">Summing</header>
            <ul>
                <li><a href="#" class="modal-link" data-title=" RF Cavitation Tummy " data-content=" Ultrasonic cavitation, or ultrasound cavitation, is a cosmetic procedure that’s used 
                to break apart fat deposits in Ultrasonic cavitation, or ultrasound cavitation, is a cosmetic procedure that’s used to break apart fat deposits in your body. The treatment 
                claims to work as an effective, less invasive alternative to liposuction your body. The treatment claims to work as an effective, less invasive alternative to liposuction." 
                data-duration="Duration : 45 minutes" data-price="&#8369; 799" data-image="<?php echo $baseURL; ?>rf_tummy.jpg">RF Cavitation Tummy</a></li>

                <li><a href="#" class="modal-link" data-title=" RF Cavitation Face " data-content=" Ultrasonic cavitation, or ultrasound cavitation, is a cosmetic procedure that’s used to break apart 
                fat deposits in Ultrasonic cavitation, or ultrasound cavitation, is a cosmetic procedure that’s used to break apart fat deposits in your body. The treatment claims to work as an effective, 
                less invasive alternative to liposuction your body. The treatment claims to work as an effective, less invasive alternative to liposuction." data-duration="Duration : 45 minutes" data-price="&#8369; 599" 
                data-image="<?php echo $baseURL; ?>brazillian.jpg">RF Cavitation Face</a></li>

                <li><a href="#" class="modal-link" data-title=" RF Cavitation Arms " data-content=" Ultrasonic cavitation, or ultrasound cavitation, is a cosmetic procedure that’s used to break apart 
                fat deposits in Ultrasonic cavitation, or ultrasound cavitation, is a cosmetic procedure that’s used to break apart fat deposits in your body. The treatment claims to work as an effective, 
                less invasive alternative to liposuction your body. The treatment claims to work as an effective, less invasive alternative to liposuction." data-duration="Duration : 45 minutes" data-price="&#8369; 599" 
                data-image="<?php echo $baseURL; ?>RF_Cavitation_Arms.jpg">RF Cavitation Arms</a></li>

                <li><a href="#" class="modal-link" data-title=" Mesolipo Tummy " data-content=" Mesotherapy is a technique that uses injections of vitamins, enzymes, hormones, and plant extracts to rejuvenate and tighten skin, as well as remove excess fat. 
                The technique uses very fine needles to deliver a series of injections into the middle layer (mesoderm) of skin. The idea behind mesotherapy is that it corrects underlying issues like poor circulation and inflammation that cause skin damage. 
                Liposuction permanently removes fat from areas like your stomach, thighs, and back. Cosmetic surgeons perform this procedure by inserting a thin plastic tube through small incisions in your skin, and then suctioning out the fat using a surgical 
                vacuum. Liposuction is done while you’re under anesthesia." data-duration="Duration : 45 minutes" data-price="&#8369; 2,499" data-image="<?php echo $baseURL; ?>mesolipo_tummy.jpg">Mesolipo Tummy</a></li>

                <li><a href="#" class="modal-link" data-title=" Mesolipo Cheek " data-content=" Mesotherapy is a technique that uses injections of vitamins, enzymes, hormones, and plant extracts to rejuvenate and tighten skin, as well as remove excess fat. 
                The technique uses very fine needles to deliver a series of injections into the middle layer (mesoderm) of skin. The idea behind mesotherapy is that it corrects underlying issues like poor circulation and inflammation that cause skin damage. 
                Liposuction permanently removes fat from areas like your stomach, thighs, and back. Cosmetic surgeons perform this procedure by inserting a thin plastic tube through small incisions in your skin, and then suctioning out the fat using a surgical 
                vacuum. Liposuction is done while you’re under anesthesia." data-duration="Duration : 45 minutes" data-price="&#8369; 1,499" data-image="<?php echo $baseURL; ?>mesolipo_cheek.jpg">Mesolipo Cheek</a></li>

                <li><a href="#" class="modal-link" data-title=" Mesolipo Arms " data-content=" Mesotherapy is a technique that uses injections of vitamins, enzymes, hormones, and plant extracts to rejuvenate and tighten skin, as well as remove excess fat. 
                The technique uses very fine needles to deliver a series of injections into the middle layer (mesoderm) of skin. The idea behind mesotherapy is that it corrects underlying issues like poor circulation and inflammation that cause skin damage. 
                Liposuction permanently removes fat from areas like your stomach, thighs, and back. Cosmetic surgeons perform this procedure by inserting a thin plastic tube through small incisions in your skin, and then suctioning out the fat using a surgical 
                vacuum. Liposuction is done while you’re under anesthesia." data-duration="Duration : 45 minutes" data-price="&#8369; 1,999" data-image="<?php echo $baseURL; ?>mesolipo_arms.jpg">Mesolipo Arms</a></li>

                <li><a href="#" class="modal-link" data-title=" Barbie Arms " data-content=" Barbie arms (Non-surgical arm reduction) The Barbie Arm procedure sculpts your arms to achieve an ideal, slender physique." data-duration="Duration : 45 minutes" 
                data-price="&#8369; 5,999" data-image="<?php echo $baseURL; ?>barbie_arms.jpg">Barbie Arms</a></li>

                <li><a href="#" class="modal-link" data-title=" Exilis Tummy " data-content=" A painless slimming treatment that uses thermal waves to melt unwanted fat and improve skin laxity and texture. It is frequently used on the face, tummy fat, and arms. 
                Perfect for people in their 20s who want to begin preventative anti-aging measures or tone up for special occasions." data-duration="Duration : 45 minutes" data-price="&#8369; 1,799" data-image="<?php echo $baseURL; ?>elixis_tummy.jpg">Exilis Tummy</a></li>

            </ul>
        </div>
        <div class="contain">
            <header class="title">Semi Permanent</header>
            <ul>
                <li><a href="#" class="modal-link" data-title="Semi Permanent Ombre Brows " data-content="This service offers a semi-permanent eyebrow styling technique that uses a small machine to place extremely 
                thin dots of pigment into the skin, creating a soft-shaded brow pencil look" data-duration="Duration : 2 hours" data-price="&#8369; 1999" data-image="<?php echo $baseURL; ?>ombrebrows.jpg">Ombre Brows</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Microblading" data-content="This service offers a semi-permanent tattoo that creates hair-like strokes with the use of a manual pen containing very small needles." 
                data-duration="Duration : 2-3 hours" data-price="&#8369; 1699" data-image="<?php echo $baseURL; ?>microblading.png">Microblading</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Combrows" data-content=" Combo brows is a combination of two forms of semi-permanent techniques: microblading and powder brows" 
                data-duration="Duration : 2-3 hours" data-price="&#8369; 2499" data-image="<?php echo $baseURL; ?>combrobrows.png">Combrows</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent DigiBrows" data-content="Digibrows is a combination of two forms of semi-permanent techniques: microblading and powder brows" 
                data-duration="Duration : 1-2 hours" data-price="&#8369; 3999" data-image="<?php echo $baseURL; ?>digibrows.jpg">DigiBrows</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Lip Blush" data-content="This service offers a semi-permanent tattoo that can enhance the color and shape of your lips and give 
                the impression of more fullness" data-duration="Duration : 1 hour" data-price="&#8369; 1999" data-image="<?php echo $baseURL; ?>lipblush.png">Lip Blush</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Lip Correction" data-content="This service offers a semi-permanent cosmetic make-up technique that is great for adjusting the 
                irregular shape and colour of the lips." data-duration="Duration : 30-60 minutes" data-price="&#8369; 2499" data-image="<?php echo $baseURL; ?>lipcorrection.jpg">Lip Correction</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent EyeLiner Classic" data-content="This service offers a form of cosmetic tattooing treatment for eyelids to create the art of 
                eyeliner makeup, using a disposable needle and a semi-permanent makeup machine" data-duration="Duration : 2-3 hours" data-price="&#8369; 1499" data-image="<?php echo $baseURL; ?>brazillian.jpg">EyeLiner Classic</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Eyeliner With wing" data-content="This service offers a semi permanent makeup procedure that recreates the look of ... looking to 
                winged and bold that create the appearance of thicker lashes" data-duration="Duration : 2-3 hours" data-price="&#8369; 1799" data-image="<?php echo $baseURL; ?>brazillian.jpg">Eyeliner With wing</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Cheek Blush" data-content="This service offers mplementing light, rosy shades of pigment using an electric PMU machine or microneedling 
                device into the cheeks, creating a soft, subtle blush effect." data-duration="Duration : 60 minutes" data-price="&#8369; 999" data-image="<?php echo $baseURL; ?>brazillian.jpg">Cheek Blush</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Nipple Pinkish" data-content="This service offers nipple micro-pigmentation colour correction is for improving the aesthetic appearance 
                of the breast. Making the colour of the nipple brighter, more pinkish and to balance the colour of the nipple for any discolourations" data-duration="Duration : 25 minutes" data-price="&#8369; 3500" data-image="<?php echo $baseURL; ?>brazillian.jpg">Nipple Pinkish</a></li>

                <li><a href="#" class="modal-link" data-title="Semi Permanent Sculp Micropigmentation" data-content="This service offers SMP  a non-medical, tattoo-based cosmetically appealing and effective 
                cover-up that hides the unsightly conditions. The cosmetic tattoo placement creates an illusion of thicker hair" data-duration="Duration : 2-5 hours" data-price="&#8369; 7500" data-image="<?php echo $baseURL; ?>brazillian.jpg">Sculp Micropigmentation</a></li>
            </ul>
        </div>
        <div class="contain">
            <header class="title">Gluta</header>
            <ul>
                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">I.V Push</a></li>

                <li><a href="#" class="modal-link" data-title="Carbon Laser Whitening Knee" data-content="This service offers..." data-duration="Duration : 45 minutes" data-price="&#8369; 70" data-image="<?php echo $baseURL; ?>brazillian.jpg">Drip</a></li>
            </ul>
        </div>
    </div>





    

        <div id="calendar" class="container alert alert-default" style="background:#fff">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" style="background:#2ecc71; border:none; color:#fff; ">
                        <h1 style="text-align:center;">Book Now</h1>
                        </div>
                        <?php
                            $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year'])){
                                $month = $_GET['month'];
                                $year = $_GET['year'];
                            }else{
                                $month = $dateComponents['month'];
                                $year = $dateComponents['year'];
                            }
                            echo build_calendar($month, $year);
                        ?>
                    
                </div>
            </div>
        </div>















    


    <script>
    // Get the modal element
    var modal = document.getElementById("serviceModal");

    // Get the <span> element that closes the modal
    var closeBtn = document.getElementsByClassName("close")[0];

    // Get all the modal links
    var modalLinks = document.getElementsByClassName("modal-link");

    // Function to open the modal
    function openModal(title, price, content, imageSrc, duration) {
      document.getElementById("modalTitle").innerHTML = title;
      document.getElementById("modalPrice").textContent = price;
      document.getElementById("modalContent").innerHTML = content;
      document.getElementById("modalImage").src = imageSrc;
      document.getElementById("modalDuration").textContent = duration;



      modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
      modal.style.display = "none";
    }

    // Event listener for modal links
    for (var i = 0; i < modalLinks.length; i++) {
      modalLinks[i].addEventListener("click", function(event) {
        event.preventDefault();
        var title = this.getAttribute("data-title");
        var price = this.getAttribute("data-price");
        var content = this.getAttribute("data-content");
        var imageSrc = this.getAttribute("data-image");
        var duration = this.getAttribute("data-duration");

        

        openModal(title, price, content, imageSrc, duration);
      });
    }

    // Event listener for close button
    closeBtn.addEventListener("click", closeModal);

    // Event listener to close the modal when clicking outside the modal content
    window.addEventListener("click", function(event) {
      if (event.target == modal) {
        closeModal();
      }
    });
  </script>







</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

</html>