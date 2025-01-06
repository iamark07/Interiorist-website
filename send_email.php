<!-- send grid -->

<?php
// Include config.php for database connection
include 'config.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Composer's autoloader (if using Composer)
// require 'vendor/autoload.php';

// Or manually include files (if downloaded manually)
// require 'vendor/phpmailer/src/PHPMailer.php';
// require 'vendor/phpmailer/src/SMTP.php';
// require 'vendor/phpmailer/src/Exception.php';
require __DIR__ . "/vendor/autoload.php";

// Retrieve form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Insert data into the database
$sql = "INSERT INTO contact_form (full_name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
$result = mysqli_query($conn, $sql);

if ($result) {
    // If data is inserted successfully, proceed with sending email
    try {
        // PHPMailer instance
        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'arbazkarimi@gmail.com'; // Your Gmail address
        $mail->Password = 'myxpcouwqhrdaoms'; // Your Gmail password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email sender & recipient
        $mail->setFrom('arbazkarimi@gmail.com', $name); // Sender
        $mail->addAddress('arbazkarimi@gmail.com'); // Send to your email address
        $mail->addReplyTo($email, $name); // Optional: Reply-To set to user's email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Message:</strong> {$message}</p>
        ";

        // Send email
        if ($mail->send()) {
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <!-- fav icon -->
                <link rel='icon' type='image/png' href='assets/img/tech-beat-service-logo-2.png' />
                <title>Email Send Success</title>
                <script src='https://cdn.tailwindcss.com'></script>
                <style>
                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                            transform: scale(0.8);
                        }
                        100% {
                            opacity: 1;
                            transform: scale(1);
                        }
                    }
            
                    @keyframes wave {
                        0%, 100% {
                            transform: scale(0.9);
                            opacity: 0.8;
                        }
                        50% {
                            transform: scale(1.1);
                            opacity: 1;
                        }
                    }
                </style>
            
                <!-- Google Tag Manager -->
                <script>(function (w, d, s, l, i) {
                    w[l] = w[l] || []; w[l].push({
                        'gtm.start':
                            new Date().getTime(), event: 'gtm.js'
                    }); var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', 'GTM-MXFBJQ4N');</script>
                <!-- End Google Tag Manager -->

            </head>
            <body class='flex items-center justify-center h-screen bg-gray-100'>
            
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-MXFBJQ4N'
                height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
            
            <!-- Success Animation Container -->
            <div class='relative bg-white p-6 rounded-lg shadow-lg text-center animate-fadeIn'>
                <!-- Background Effect -->
                <div class='absolute inset-0 rounded-lg bg-blue-100 -z-10 opacity-50 animate-wave'></div>
                <!-- Checkmark Icon -->
                <div class='relative z-10 text-[#57a5f6]'>
                    <svg class='w-16 h-16 mx-auto mb-4' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M9 12l2 2 4-4M6 12a9 9 0 1012 0 9 9 0 10-12 0z' />
                    </svg>
                </div>
                <!-- Success Message -->
                <p class='relative z-10 text-xl font-semibold text-gray-800'>Email Sent Successfully!</p>
                <p class='relative z-10 text-gray-500 mt-2'>Your message has been delivered.</p>
                <div class='text-center mt-8'>
                    <a href='index.php' class='inline-block bg-[#57a5f6] text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-[#57a5f6] transition-all duration-300 poppins-regular'>
                        Back To Home
                    </a>
                </div>
            </div>
            
            </body>
            </html>";
            
        } else {
            echo "Failed to send the email.";
        }
    } catch (Exception $e) {
        echo "Email sending error: {$mail->ErrorInfo}";
    }
} else {
    echo "Failed to save contact data to the database.";
}
