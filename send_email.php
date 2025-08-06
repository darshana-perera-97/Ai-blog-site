<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include PHPMailer
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get form data
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    $newsletter = isset($_POST['newsletter']) ? 'Yes' : 'No';

    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($subject) || empty($message)) {
        throw new Exception('All required fields must be filled out');
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address');
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    // Include configuration
    require_once 'config/smtp_config.php';

    // Server settings
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Port = SMTP_PORT;

    // Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress(TO_EMAIL, TO_NAME);
    $mail->addReplyTo($email, $firstName . ' ' . $lastName);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission: ' . $subject;
    
    // Create HTML email body
    $emailBody = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #007bff; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f8f9fa; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #007bff; }
            .value { margin-top: 5px; }
            .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Contact Form Submission</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>Name:</div>
                    <div class='value'>$firstName $lastName</div>
                </div>
                <div class='field'>
                    <div class='label'>Email:</div>
                    <div class='value'>$email</div>
                </div>
                <div class='field'>
                    <div class='label'>Subject:</div>
                    <div class='value'>$subject</div>
                </div>
                <div class='field'>
                    <div class='label'>Message:</div>
                    <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
                </div>
                <div class='field'>
                    <div class='label'>Newsletter Subscription:</div>
                    <div class='value'>$newsletter</div>
                </div>
            </div>
            <div class='footer'>
                <p>This message was sent from the GlobeAI contact form.</p>
                <p>Submitted on: " . date('F j, Y \a\t g:i A') . "</p>
            </div>
        </div>
    </body>
    </html>";

    $mail->Body = $emailBody;
    $mail->AltBody = "
    New Contact Form Submission
    
    Name: $firstName $lastName
    Email: $email
    Subject: $subject
    Message: $message
    Newsletter Subscription: $newsletter
    
    Submitted on: " . date('F j, Y \a\t g:i A');

    // Send email
    $mail->send();

    // Send success response
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
    ]);

} catch (Exception $e) {
    // Log error (you might want to log to a file instead)
    error_log("Email sending failed: " . $e->getMessage());
    
    // Send error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again later.'
    ]);
}
?> 