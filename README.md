F1 Merchandise Shop
Welcome to the F1 Merchandise Shop! This project is a fully functional e-commerce website where users can browse and purchase official Formula 1 team merchandise. The website is built with PHP, HTML, CSS, and JavaScript and is hosted using Netlify for free domain and hosting.

Table of Contents
Features
Technologies Used
Setup Instructions
Project Structure
Contributing
License
Features
User Authentication:

Register new users.
Login and logout functionality.
User session management.
Product Browsing:

View a variety of F1 team merchandise.
Filter products by team and product type.
Search products by keywords.
Shopping Cart:

Add products to the shopping cart.
View and manage items in the cart.
Place orders.
Dynamic Dropdowns:

Filter items based on the selected team, providing a second dropdown with team-specific items.
Live Search:

Search products dynamically as you type.
Image Pop-Up:

Click on product images to view a larger version in a modal pop-up with a caption.
Responsive Design:

Ensures optimal viewing experience across various devices.
Enhanced Aesthetics:

Sporty, racing-themed design with appropriate team backgrounds.
Footer:

Contact details and links to official F1 social media.
Technologies Used
Frontend:

HTML5
CSS3
JavaScript (ES6)
Backend:

PHP
Database:

MySQL
Hosting:

Netlify
Setup Instructions
Clone the Repository:
git clone https://github.com/yourusername/f1-merch-shop.git
cd f1-merch-shop
Set Up the Database:

Create a MySQL database named f1_shop.
Import the database schema from database/schema.sql.
Update the database configuration in the PHP files (e.g., shop.php, cart.php, login.php, register.php).
Deploy the Project:

Sign up and log in to Netlify.
Create a new site from Git and connect your repository.
Deploy the site.
Set Up Domain:

Sign up and log in to InfinityFree (or another domain provider).
Create a new account and choose a free subdomain.
Update DNS settings to point to your Netlify site.
Project Structure
F1_MERCH_SHOP/
├── images/
│   ├── aston_martin_background.jpg
│   ├── aston_martin_cap.jpg
│   ├── ...
├── cart.php
├── home.html
├── login.html
├── login.php
├── logout.php
├── register.html
├── register.php
├── registration_succesful.html
├── shop.php
├── style.css
├── user.php
└── validation.js
Description of Key Files
home.html: The homepage with a welcome message and brief description.
shop.php: The main shop page where users can browse and filter products.
cart.php: The shopping cart page where users can view and manage their cart.
login.html & login.php: User login functionality.
register.html & register.php: User registration functionality.
user.php: User profile page showing past orders.
style.css: Stylesheet for the website.
validation.js: JavaScript file for dynamic dropdowns, live search, and image pop-up functionality.
Contributing
We welcome contributions to enhance the F1 Merchandise Shop. To contribute:

Fork the repository.
Create a new branch (git checkout -b feature/your-feature).
Commit your changes (git commit -am 'Add a new feature').
Push to the branch (git push origin feature/your-feature).
Open a pull request.
License
This project is licensed under the MIT License. See the LICENSE file for details.
