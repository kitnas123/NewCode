<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    // Get the recipient email and message from the form submission
    $recipientEmail = $_POST['re_email'];
    $message = $_POST['message'];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'deguzmanvincent6@gmail.com';
        $mail->Password = 'vincentnavarrete17';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient details
        $mail->setFrom('deguzmanvincent6@gmail.com', 'Vincent');
        $mail->addAddress($recipientEmail);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Message from Jedz Aesthetic Clinic';
        $mail->Body = $message;

        // Send the email
        $mail->send();

        // Email sent successfully
        echo 'Message sent successfully!';
    } catch (Exception $e) {
        // Error occurred while sending email
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
?>