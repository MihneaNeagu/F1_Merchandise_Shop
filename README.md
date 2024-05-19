# F1 Merchandise Shop

Welcome to the F1 Merchandise Shop! This project is a fully functional e-commerce website where users can browse and purchase official Formula 1 team merchandise. The website is built with PHP, HTML, CSS, and JavaScript and is hosted using Netlify for free domain and hosting.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Setup Instructions](#setup-instructions)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

## Features

1. **User Authentication**:
    - Register new users.
    - Login and logout functionality.
    - User session management.

2. **Product Browsing**:
    - View a variety of F1 team merchandise.
    - Filter products by team and product type.
    - Search products by keywords.

3. **Shopping Cart**:
    - Add products to the shopping cart.
    - View and manage items in the cart.
    - Place orders.

4. **Dynamic Dropdowns**:
    - Filter items based on the selected team, providing a second dropdown with team-specific items.

5. **Live Search**:
    - Search products dynamically as you type.

6. **Image Pop-Up**:
    - Click on product images to view a larger version in a modal pop-up with a caption.

7. **Responsive Design**:
    - Ensures optimal viewing experience across various devices.

8. **Enhanced Aesthetics**:
    - Sporty, racing-themed design with appropriate team backgrounds.

9. **Footer**:
    - Contact details and links to official F1 social media.

## Technologies Used

- **Frontend**:
    - HTML5
    - CSS3
    - JavaScript (ES6)

- **Backend**:
    - PHP

- **Database**:
    - MySQL

- **Hosting**:
    - Netlify

## Setup Instructions

1. **Clone the Repository**:
    ```sh
    git clone https://github.com/yourusername/f1-merch-shop.git
    cd f1-merch-shop
    ```

2. **Set Up the Database**:
    - Create a MySQL database named `f1_shop`.
    - Import the database schema from `database/schema.sql`.
    - Update the database configuration in the PHP files (e.g., `shop.php`, `cart.php`, `login.php`, `register.php`).

3. **Deploy the Project**:
    - Sign up and log in to Netlify.
    - Create a new site from Git and connect your repository.
    - Deploy the site.

4. **Set Up Domain**:
    - Sign up and log in to InfinityFree (or another domain provider).
    - Create a new account and choose a free subdomain.
    - Update DNS settings to point to your Netlify site.


### Description of Key Files

- **home.html**: The homepage with a welcome message and brief description.
- **shop.php**: The main shop page where users can browse and filter products.
- **cart.php**: The shopping cart page where users can view and manage their cart.
- **login.html & login.php**: User login functionality.
- **register.html & register.php**: User registration functionality.
- **user.php**: User profile page showing past orders.
- **style.css**: Stylesheet for the website.
- **validation.js**: JavaScript file for dynamic dropdowns, live search, and image pop-up functionality.

## Contributing

We welcome contributions to enhance the F1 Merchandise Shop. To contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -am 'Add a new feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.


