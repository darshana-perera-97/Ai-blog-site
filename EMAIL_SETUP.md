# Email Setup Guide for GlobeAI Contact Form

This guide will help you set up email functionality for your contact form using SMTP.

## Files Created/Modified

1. `send_email.php` - Main email handling script
2. `config/smtp_config.php` - SMTP configuration file
3. `script.js` - Updated with form submission handling
4. `styles.css` - Added notification styles

## Setup Instructions

### 1. Configure SMTP Settings

Edit the file `config/smtp_config.php` and update the following values:

```php
// Gmail Example
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'your-email@gmail.com'); // Your Gmail address
define('SMTP_PASSWORD', 'your-app-password'); // Your Gmail app password

// Email Settings
define('FROM_EMAIL', 'your-email@gmail.com'); // Your email
define('FROM_NAME', 'GlobeAI Contact Form');
define('TO_EMAIL', 'author@globeai.com'); // Where to receive emails
define('TO_NAME', 'GlobeAI Author');
```

### 2. Gmail Setup (Recommended)

If using Gmail, follow these steps:

1. **Enable 2-Factor Authentication**:
   - Go to your Google Account settings
   - Navigate to Security
   - Enable 2-Step Verification

2. **Generate App Password**:
   - Go to Google Account settings
   - Navigate to Security
   - Under "2-Step Verification", click "App passwords"
   - Select "Mail" and "Other (Custom name)"
   - Enter "GlobeAI Contact Form" as the name
   - Copy the generated 16-character password
   - Use this password in `SMTP_PASSWORD`

### 3. Alternative Email Providers

#### Outlook/Hotmail
```php
define('SMTP_HOST', 'smtp-mail.outlook.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
```

#### Yahoo Mail
```php
define('SMTP_HOST', 'smtp.mail.yahoo.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
```

#### Custom SMTP Server
```php
define('SMTP_HOST', 'your-smtp-server.com');
define('SMTP_PORT', 587); // or 465 for SSL
define('SMTP_SECURE', 'tls'); // or 'ssl' for port 465
```

### 4. Server Requirements

Make sure your server has:
- PHP 7.4 or higher
- PHPMailer (already included in your project)
- SMTP access enabled

### 5. Testing the Setup

1. Fill out the contact form on your website
2. Submit the form
3. Check if you receive the email
4. Check the browser console for any errors

### 6. Troubleshooting

#### Common Issues:

1. **"SMTP connect() failed"**:
   - Check your SMTP settings
   - Verify your email and password
   - Ensure 2FA is enabled (for Gmail)

2. **"Authentication failed"**:
   - Use app password instead of regular password (Gmail)
   - Check if your email provider allows SMTP access

3. **"Connection timeout"**:
   - Check your firewall settings
   - Verify SMTP port is not blocked
   - Try different ports (587, 465, 25)

4. **Form not submitting**:
   - Check browser console for JavaScript errors
   - Verify `send_email.php` is accessible
   - Check server error logs

### 7. Security Considerations

1. **Keep credentials secure**:
   - Don't commit `smtp_config.php` to public repositories
   - Use environment variables in production

2. **Rate limiting**:
   - Consider implementing rate limiting to prevent spam
   - Add CAPTCHA for additional protection

3. **Input validation**:
   - The script includes basic validation
   - Consider adding more robust validation

### 8. Production Deployment

For production:

1. **Disable error reporting**:
   ```php
   // In send_email.php, comment out or remove:
   // error_reporting(E_ALL);
   // ini_set('display_errors', 1);
   ```

2. **Use environment variables**:
   ```php
   define('SMTP_USERNAME', $_ENV['SMTP_USERNAME']);
   define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD']);
   ```

3. **Add logging**:
   ```php
   error_log("Email sent successfully to: " . $email);
   ```

### 9. Features Included

- ✅ Form validation
- ✅ SMTP email sending
- ✅ HTML email templates
- ✅ Success/error notifications
- ✅ Loading states
- ✅ Mobile responsive design
- ✅ Security headers
- ✅ Error handling

### 10. Customization

You can customize:
- Email template in `send_email.php`
- Notification styles in `styles.css`
- Form validation in `send_email.php`
- SMTP settings in `config/smtp_config.php`

## Support

If you encounter issues:
1. Check the browser console for errors
2. Check your server's error logs
3. Verify your SMTP settings
4. Test with a simple email client first

The email functionality is now ready to use! 🎉 