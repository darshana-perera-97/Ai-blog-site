# Supahub Navbar

A modern, responsive navigation bar built with HTML, CSS, JavaScript, and Bootstrap 5, designed to match the Supahub brand styling.

## Features

- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Modern Styling**: Clean, professional design with purple brand colors
- **Interactive Elements**: 
  - Dropdown menus for Features and Blog
  - Hover effects and smooth transitions
  - Mobile-friendly hamburger menu
- **Accessibility**: Proper focus states and keyboard navigation
- **Bootstrap 5**: Built with the latest Bootstrap framework

## File Structure

```
├── index.html      # Main HTML file with navbar structure
├── styles.css      # Custom CSS styling
├── script.js       # JavaScript functionality
└── README.md       # This file
```

## How to Use

1. **Open the HTML file**: Simply open `index.html` in your web browser
2. **Customize the content**: Edit the navigation links, dropdown items, and brand text in `index.html`
3. **Modify styling**: Adjust colors, fonts, and spacing in `styles.css`
4. **Add functionality**: Extend the JavaScript in `script.js` for additional features

## Customization

### Colors
The navbar uses CSS custom properties (variables) for easy color customization:

```css
:root {
    --primary-purple: #6f42c1;    /* Main brand color */
    --light-purple: #e9ecef;      /* Light purple for badges */
    --dark-gray: #495057;         /* Dark text color */
    --light-gray: #6c757d;        /* Light text color */
    --white: #ffffff;             /* White background */
}
```

### Brand Elements
- **Logo**: Uses Font Awesome lightning bolt icon
- **Brand Name**: "Supahub" with custom styling
- **BETA Tag**: Small gray text indicator
- **BLOG Badge**: Purple background badge

### Navigation Items
- **Features**: Dropdown menu with sample items
- **Pricing**: Simple link
- **Blog**: Dropdown menu with sample items
- **Login**: Simple link
- **Sign up for free**: Call-to-action button

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Dependencies

- **Bootstrap 5.3.0**: CSS and JavaScript framework
- **Font Awesome 6.4.0**: Icons library

All dependencies are loaded via CDN, so an internet connection is required.

## Features Included

- ✅ Responsive design
- ✅ Dropdown menus
- ✅ Mobile hamburger menu
- ✅ Smooth transitions
- ✅ Hover effects
- ✅ Scroll effects
- ✅ Accessibility features
- ✅ Modern styling

## Next Steps

To integrate this navbar into your project:

1. Copy the HTML structure to your main layout
2. Include the CSS and JavaScript files
3. Customize the content and styling to match your brand
4. Add your own functionality to the JavaScript file

The navbar is ready to use and can be easily extended with additional features as needed. 