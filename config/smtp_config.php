<?php
// SMTP Configuration
// Update these values with your actual SMTP settings

// Gmail SMTP Settings (example)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'ds.perera.test@gmail.com'); // Replace with your email
define('SMTP_PASSWORD', 'ycfdgqfhinumrzjx'); // Replace with your app password

// Email Settings
define('FROM_EMAIL', 'darshana.p@hsenidmobile.com'); // Replace with your email
define('FROM_NAME', 'GlobeAI Contact Form');
define('TO_EMAIL', 'darshana.p@hsenidmobile.com'); // Replace with your email
define('TO_NAME', 'GlobeAI Author');

// Alternative SMTP providers you can use:

// Outlook/Hotmail
// define('SMTP_HOST', 'smtp-mail.outlook.com');
// define('SMTP_PORT', 587);

// Yahoo Mail
// define('SMTP_HOST', 'smtp.mail.yahoo.com');
// define('SMTP_PORT', 587);

// Custom SMTP Server
// define('SMTP_HOST', 'your-smtp-server.com');
// define('SMTP_PORT', 587);

// For Gmail, you need to:
// 1. Enable 2-factor authentication
// 2. Generate an App Password
// 3. Use the App Password instead of your regular password

// For other providers, check their documentation for SMTP settings
?> 