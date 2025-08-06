<?php
// send_mail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Only POST allowed');
}

// Basic required-field check
$required = ['name', 'email', 'phone', 'message'];
$missing = [];
foreach ($required as $f) {
    if (empty($_POST[$f])) {
        $missing[] = $f;
    }
}
if ($missing) {
    exit('Missing field(s): ' . implode(', ', $missing));
}

$mail = new PHPMailer(true);
try {
    // SMTP setup
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'mediamobitelmspace@gmail.com';
    $mail->Password = 'hxkl hphr tktm qmys';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Recipient & sender
    $mail->setFrom('darshana.p@hsenidmobile.com', 'mSpace');
    $mail->addAddress('darshana.p@hsenidmobile.com');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'New Customer Inquiry - mSpace Contact Form';

    // Create a fully mobile responsive email template
    $body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>New Customer Inquiry - V-Appstore</title>
        <!--[if mso]>
        <noscript>
            <xml>
                <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
            </xml>
        </noscript>
        <![endif]-->
        <style>
            /* Reset styles for email clients */
            body, table, td, p, a, li, blockquote {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            
            table, td {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            
            img {
                -ms-interpolation-mode: bicubic;
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
            }
            
            /* Base styles - mSpace theme */
            body {
                margin: 0 !important;
                padding: 0 !important;
                background-color: #fff !important;
                font-family: "Lato", sans-serif !important;
                font-size: 15px !important;
                line-height: 1.9em !important;
                color: #2a2c2b !important;
                letter-spacing: 1px !important;
            }
            
            /* Container */
            .email-wrapper {
                width: 100% !important;
                background-color: #fff !important;
                padding: 20px 0 !important;
            }
            
            .email-container {
                max-width: 600px !important;
                margin: 0 auto !important;
                background-color: #ffffff !important;
                border-radius: 8px !important;
                overflow: hidden !important;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
            }
            
            /* Header - mSpace branding */
            .header {
                text-align: center !important;
                padding: 30px 20px !important;
                border-bottom: 1px solid #eee !important;
                background: linear-gradient(135deg, #f7f7f7 0%, #f7f7f7 100%) !important;
            }
            
            .logo {
                text-align: center !important;
                margin-bottom: 1px !important;
                display: block !important;
            }
            
            .logo img {
                max-width: 200px !important;
                height: auto !important;
                display: block !important;
                margin: 0 auto !important;
            }
            
            .company-name {
                font-size: 20px !important;
                font-weight: 700 !important;
                margin: 0 !important;
                color: #ffffff !important;
                letter-spacing: 1px !important;
            }
            
            /* Content */
            .content {
                padding: 30px 20px !important;
                background-color: #ffffff !important;
                borrder:1px solid #f7f7f7;
                border-radius:0px 0px 10px 10px
            }
            
            .greeting {
                font-size: 16px !important;
                font-weight: 500 !important;
                color: #2a2c2b !important;
                margin-bottom: 20px !important;
                margin-top: 0 !important;
                letter-spacing: 1px !important;
            }
            
            .intro-text {
                color: #2a2c2b !important;
                margin-bottom: 30px !important;
                font-size: 15px !important;
                line-height: 1.9em !important;
                letter-spacing: 1px !important;
            }
            
            /* Summary Box */
            .summary-box {
                background-color: #f8f9fa !important;
                padding: 20px !important;
                border-radius: 6px !important;
                margin-bottom: 30px !important;
                border-left: 4px solid #00ce36 !important;
            }
            
            .summary-item {
                margin-bottom: 15px !important;
                font-size: 15px !important;
                letter-spacing: 1px !important;
            }
            
            .summary-item:last-child {
                margin-bottom: 0 !important;
            }
            
            .summary-label {
                font-weight: 700 !important;
                color: #2a2c2b !important;
                display: inline-block !important;
                min-width: 120px !important;
                letter-spacing: 1px !important;
            }
            
            .summary-value {
                color: #0b4c8d !important;
                font-weight: 700 !important;
                letter-spacing: 1px !important;
            }
            
            /* Details Section */
            .details-section {
                margin: 30px 0 !important;
            }
            
            .details-header {
                margin-bottom: 20px !important;
                font-size: 14px !important;
                color: #2a2c2b !important;
                letter-spacing: 1px !important;
            }
            
            .details-header span {
                display: block !important;
                margin-bottom: 5px !important;
            }
            
            /* Table */
            .details-table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin-bottom: 20px !important;
            }
            
            .details-table th {
                text-align: left !important;
                padding: 12px 8px !important;
                border-bottom: 2px solid #00ce36 !important;
                font-weight: 700 !important;
                color: #2a2c2b !important;
                font-size: 14px !important;
                letter-spacing: 1px !important;
            }
            
            .details-table td {
                padding: 12px 8px !important;
                border-bottom: 1px solid #f5f5f5 !important;
                color: #2a2c2b !important;
                font-size: 14px !important;
                vertical-align: top !important;
                letter-spacing: 1px !important;
            }
            
            .details-table tr:last-child td {
                border-bottom: 2px solid #0b4c8d !important;
                font-weight: 700 !important;
            }
            
            /* Message content styling */
            .message-content {
                white-space: pre-wrap !important;
                line-height: 1.6 !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
                max-width: 400px !important;
                border-radius: 6px !important;
                font-size: 14px !important;
                color: #2a2c2b !important;
                letter-spacing: 0.5px !important;
                margin: 0 !important;
                display: block !important;
            }
            
            /* Links */
            .email-link, .phone-link {
                color: #0b4c8d !important;
                text-decoration: none !important;
                font-weight: 700 !important;
                transition: 0.5s all !important;
            }
            
            .email-link:hover, .phone-link:hover {
                color: #00ce36 !important;
            }
            
            .support-link {
                color: #0b4c8d !important;
                text-decoration: none !important;
                font-weight: 700 !important;
            }
            
            /* Support and Closing */
            .support-text {
                color: #2a2c2b !important;
                margin: 30px 0 !important;
                font-size: 15px !important;
                line-height: 1.9em !important;
                letter-spacing: 1px !important;
            }
            
            .closing {
                margin: 30px 0 !important;
                color: #2a2c2b !important;
            }
            
            .team-name {
                font-weight: 700 !important;
                color: #0b4c8d !important;
                letter-spacing: 1px !important;
            }
            
            /* Footer */
            .fallback-section {
                margin-top: 40px !important;
                padding-top: 20px !important;
                border-top: 1px solid #eee !important;
                text-align: center !important;
            }
            
            .fallback-text {
                color: #999 !important;
                font-size: 14px !important;
                margin-bottom: 10px !important;
                font-style: italic !important;
                letter-spacing: 1px !important;
            }
            
            /* Mobile Responsive */
            @media only screen and (max-width: 600px) {
                .email-wrapper {
                    padding: 10px 0 !important;
                }
                
                .email-container {
                    margin: 0 10px !important;
                    border-radius: 6px !important;
                }
                
                .header {
                    padding: 20px 15px !important;
                }
                
                .logo img {
                    max-width: 150px !important;
                }
                
                .company-name {
                    font-size: 18px !important;
                }
                
                .content {
                    padding: 20px 15px !important;
                }
                
                .greeting {
                    font-size: 16px !important;
                }
                
                .summary-box {
                    padding: 15px !important;
                }
                
                .summary-item {
                    margin-bottom: 12px !important;
                }
                
                .summary-label {
                    display: block !important;
                    min-width: auto !important;
                    margin-bottom: 5px !important;
                }
                
                .details-table {
                    font-size: 13px !important;
                }
                
                .details-table th,
                .details-table td {
                    padding: 8px 4px !important;
                    font-size: 13px !important;
                }
                
                .details-header span {
                    font-size: 12px !important;
                }
                
                .message-content {
                    max-width: 100% !important;
                    font-size: 13px !important;
                }
            }
            
            /* Small mobile devices */
            @media only screen and (max-width: 480px) {
                .email-container {
                    margin: 0 5px !important;
                }
                
                .header {
                    padding: 15px 10px !important;
                }
                
                .content {
                    padding: 15px 10px !important;
                }
                
                .summary-box {
                    padding: 12px !important;
                }
                
                .details-table th,
                .details-table td {
                    padding: 6px 2px !important;
                    font-size: 12px !important;
                }
                
                .greeting {
                    font-size: 16px !important;
                }
                
                .intro-text {
                    font-size: 14px !important;
                }
                
                .logo img {
                    max-width: 120px !important;
                }
                
                .message-content {
                    max-width: 100% !important;
                    font-size: 12px !important;
                }
            }
            
            /* Dark mode support */
            @media (prefers-color-scheme: dark) {
                .email-container {
                    background-color: #1a1a1a !important;
                    color: #ffffff !important;
                }
                
                .header {
                    background: linear-gradient(135deg,#f7f7f7 0%, #f7f7f7 100%) !important;
                }
                .content {
                    background-color: #1a1a1a !important;
                }
                
                .greeting, .company-name {
                    color: #ffffff !important;
                }
                
                .intro-text, .support-text {
                    color: #cccccc !important;
                }
                
                .summary-box {
                    background-color: #2a2a2a !important;
                }
                
                .details-table th {
                    color: #ffffff !important;
                    border-bottom-color: #00ce36 !important;
                }
                
                .details-table td {
                    color: #ffffff !important;
                    border-bottom-color: #333 !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="email-wrapper">
            <div class="email-container">
                <div class="header">
                    <div class="logo">
                        <img src="https://mspace.lk/images/logo3.png" alt="mSpace Logo" style="max-width: 200px; height: auto; margin-bottom: 15px;">
                    </div>
                    
                </div>
                
                <div class="content">
                    <div class="greeting">Hi mSpace Team,</div>
                    
                    <div class="intro-text">
                        A new customer inquiry has been submitted through the mSpace contact form. Please review the details below and respond accordingly.
                    </div>                    
                    <div class="details-section">
                        
                        <table class="details-table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>' . htmlspecialchars($_POST['name']) . '</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto:' . htmlspecialchars($_POST['email']) . '" class="email-link">' . htmlspecialchars($_POST['email']) . '</a></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><a href="tel:' . htmlspecialchars($_POST['phone']) . '" class="phone-link">' . htmlspecialchars($_POST['phone']) . '</a></td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td><div class="message-content">' . htmlspecialchars($_POST['message']) . '</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                 
                </div>
            </div>
        </div>
    </body>
    </html>';

    $mail->Body = $body;

    $mail->send();

    // On success, show a modern popup then redirect
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message sent successfully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e2e2e2ff 0%, #cacacaff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .success-popup {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
            animation: slideInUp 0.6s ease-out;
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0b4c8d, #00ce36);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: bounceIn 0.8s ease-out 0.3s both;
        }
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        .success-icon i {
            color: white;
            font-size: 2.5rem;
        }
        .success-title {
            color: #00ce36;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }
        .success-message {
            color: #6c757d;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .redirect-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
            border-left: 4px solid #0b4c8d;
        }
        .redirect-info i {
            color: #0b4c8d;
            margin-right: 0.5rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0b4c8d, #00ce36);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #00ce36, #0b4c8d);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 206, 54, 0.3);
        }
    </style>
</head>
<body>
    <div class="success-popup">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h2 class="success-title">Message sent successfully!</h2>
        <p class="success-message">
            Your message has been successfully delivered to mSpace admin. 
            We'll get back to you as soon as possible.
        </p>
        <div class="redirect-info">
            <i class="fas fa-info-circle"></i>
            You will be redirected to the home page in <span id="countdown">5</span> seconds
        </div>
        <button class="btn btn-primary" onclick="redirectNow()">
            <i class="fas fa-home me-2"></i>Go to Home Page
        </button>
    </div>

    <script>
        // Countdown timer
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(timer);
                redirectNow();
            }
        }, 1000);
        
        function redirectNow() {
            window.location.href = "index.html";
        }
    </script>
</body>
</html>
HTML;
    exit;
} catch (Exception $e) {
    // On failure, show error in a styled popup
    $err = addslashes($mail->ErrorInfo);
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Message Not Sent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0b4c8d 0%, #00ce36 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Lato', sans-serif;
        }
        .error-popup {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
            animation: slideInUp 0.6s ease-out;
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .error-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #dc3545, #0b4c8d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: bounceIn 0.8s ease-out 0.3s both;
        }
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        .error-icon i {
            color: white;
            font-size: 2.5rem;
        }
        .error-title {
            color: #dc3545;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }
        .error-message {
            color: #6c757d;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .error-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
            border-left: 4px solid #0b4c8d;
            text-align: left;
            font-family: monospace;
            font-size: 0.9rem;
            max-height: 150px;
            overflow-y: auto;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.3s ease;
            margin-right: 1rem;
            letter-spacing: 1px;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #495057);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        .btn-primary {
            background: linear-gradient(135deg, #0b4c8d, #00ce36);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #00ce36, #0b4c8d);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 206, 54, 0.3);
        }
    </style>
</head>
<body>
    <div class="error-popup">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h2 class="error-title">Message Not Sent</h2>
        <p class="error-message">
            Sorry, there was an error sending your message. Please try again or contact us directly.
        </p>
        <div class="error-details">
            <strong>Error Details:</strong><br>
            {$err}
        </div>
        <div>
            <button class="btn btn-secondary" onclick="goBack()">
                <i class="fas fa-arrow-left me-2"></i>Go Back
            </button>
            <button class="btn btn-primary" onclick="goHome()">
                <i class="fas fa-home me-2"></i>Go to Home
            </button>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
        
        function goHome() {
            window.location.href = "index.html";
        }
    </script>
</body>
</html>
HTML;
    exit;
}
