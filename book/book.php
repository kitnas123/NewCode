<?php
//for services
$con = new mysqli('localhost', 'root', '', 'jedz');

// Retrieve service data from the services table
$sql = "SELECT id, title FROM services";
$result = $con->query($sql);

// Create an array to store the service options
$services = array();
while ($row = $result->fetch_assoc()) {
    $services[$row['id']] = $row['title'];
}



//for aestheticians
$con = new mysqli('localhost', 'root', '', 'jedz');

// Retrieve aestheticians data from the aestheticians table
$sql = "SELECT ID, FIRSTNAME, LASTNAME FROM doctors";
$result = $con->query($sql);

// Create an array to store the aestheticians options
$aestheticians = array();
while ($row = $result->fetch_assoc()) {
    $aestheticians[$row['ID']] = $row['FIRSTNAME'];
}



//for date
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

function isTimeOccupied($date, $time)
{
    $con = new mysqli('localhost', 'root', '', 'jedz');
    $datetime = date('Y-m-d', strtotime($date)) . ' ' . $time;
    $sql = "SELECT COUNT(*) AS count FROM bookings_record WHERE DATE = '$date' AND TIME = '$datetime'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    return $count > 0;
}


if (isset($_POST['submit'])) {

    $fname = $_POST['FIRSTNAME'];
    $mname = $_POST['MIDDLENAME'];
    $lname = $_POST['LASTNAME'];
    $address = $_POST['ADDRESS'];
    $phone = $_POST['PHONE'];
    $email = $_POST['EMAIL'];
    $service = $_POST['SERVICE'];
    $aesthetician = $_POST['AESTHETICIAN'];
    $time = $_POST['TIME']; 
    $AUTONUM = $_POST['AUTONUM'];
    $con = new mysqli('localhost', 'root', '', 'jedz');

    $datetime = date('Y-m-d') . ' ' . $time; // Combine date and time


    $sql = "INSERT INTO bookings_record(FIRSTNAME, MIDDLENAME, LASTNAME, ADDRESS, PHONE, EMAIL, SERVICE, AESTHETICIAN, DATE, TIME, AUTONUM) 
    VALUES ('$fname', '$mname', '$lname', '$address', '$phone', '$email', (SELECT title FROM services WHERE id = '$service') , (SELECT FIRSTNAME FROM doctors WHERE id = '$aesthetician'), '$date', '$datetime', '$AUTONUM')";

    if ($con->query($sql)) {
        $message = "<div class='alert alert-success'>Booking Successful</div>";
    } else {
        $message = "<div class='alert alert-danger'>Booking was not Successful</div>";
    }
}

$availableTimes = array('9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM', '2:00 PM', '3:00 PM'); // Example available times

$a = mt_rand(100000, 999999);
for ($i = 0; $i < 6; $i++) {
    $a .= mt_rand(0, 9);
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">

    <style>
       select option[style*="text-decoration: line-through;"] {
        text-decoration: line-through;
        color: red; /* Optional: Change the color of the strikethrough text */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center alert alert-danger" style="background:#2ecc71;border:none;color:#fff"> Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($message) ? $message : ''; ?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group col-md-4">
                        <label for=""> FIRST NAME</label>
                        <input type="text" class="form-control" name="FIRSTNAME" required>
                        <input type="hidden" class="form-control" name="AUTONUM" value="<?php echo 'TRAC' . $a; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for=""> MIDDLE NAME</label>
                        <input type="text" class="form-control" name="MIDDLENAME" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for=""> LAST NAME</label>
                        <input type="text" class="form-control" name="LASTNAME" required>
                    </div> 
                    <div class="form-group col-md-4">
                        <label for="">ADDRESS</label>
                        <input type="text" class="form-control" name="ADDRESS" required>
                    </div> 
                    <div class="form-group col-md-4">
                        <label for=""> PHONE NUMBER</label>
                        <input type="text" class="form-control" name="PHONE" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for=""> EMAIL</label>
                        <input type="email" class="form-control" name="EMAIL" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">SELECT SERVICE</label>
                        <select class="form-control" name="SERVICE" required>
                            <option value="">Select Service</option>
                            <?php foreach ($services as $id => $title) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">SELECT AESTHETICIAN</label>
                        <select class="form-control" name="AESTHETICIAN" required>
                            <option value="">Select Aesthetician</option>
                            <?php foreach ($aestheticians as $ID => $FIRSTNAME) { ?>
                                <option value="<?php echo $ID; ?>"><?php echo $FIRSTNAME; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for=""> TIME</label>
                        <select class="form-control" name="TIME" required>
                            <option value="">Select Time</option>
                            <?php
                            foreach ($availableTimes as $time) {
                                $occupied = isTimeOccupied($date, $time);
                                $disabled = $occupied ? 'disabled' : '';
                                $strikeout = $occupied ? 'text-decoration: line-through;' : '';
                            ?>
                                <option value="<?php echo $time; ?>" <?php echo $disabled; ?> style="<?php echo $strikeout; ?>"><?php echo $time; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                    <a href="../services.php#calendar" class="btn btn-success">Back</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
