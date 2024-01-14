<?php
require_once('functions.php');
// check if user is logged in
$login = new Login();
$user_data = $login->check_login($_SESSION['eng_userid'], false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Stytem AP | Dashboard</title>
    <link rel="stylesheet" href="home_styles.css">
    <!-- Google Icons Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="index.php" class="logo">
                BookING SYS
            </a>
            <ul class="menu-links">
                <li><a href="bookEventsForm.php">Book an Event</a></li>
                <?php if ($user_data == true) : ?>
                    <li class="join-btn"><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li><a href="login.php">Sign In</a></li>
                <?php endif; ?>
                <span id="close-menu-btn" class="material-symbols-outlined">close</span>
            </ul>
            <span id="hamburger-btn" class="material-symbols-outlined">menu</span>
        </nav>
    </header>

    <section class="hero-section">
        <div class="content">
            <h1>Find the right Event For you</h1>
            <div class="popular-tags">
                Popular:
                <ul class="tags">
                    <?php if ($user_data == true) : ?>
                        <li><a href="edit.php">Edit Event</a></li>
                    <?php endif; ?>
                    <li><a href="credits.php">Credits</a></li>
                </ul>
            </div>
        </div>
        <div class="more">
            <h3>Special Offers</h1>
                <aside id="offers"></aside>
        </div>
    </section>

    <script>
        const header = document.querySelector("header");
        const hamburgerBtn = document.querySelector("#hamburger-btn");
        const closeMenuBtn = document.querySelector("#close-menu-btn");

        // Toggle mobile menu on hamburger button click
        hamburgerBtn.addEventListener("click", () => header.classList.toggle("show-mobile-menu"));

        // Close mobile menu on close button click
        closeMenuBtn.addEventListener("click", () => hamburgerBtn.click());

        document.addEventListener('DOMContentLoaded', function() {
            // Function to fetch and display offers
            function fetchAndDisplayOffers() {
                fetch('getOffers.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('No offers available');
                        }
                        return response.json();
                    })
                    .then(data => {
                        displayOffer(data);
                    })
                    .catch(error => {
                        displayError(error.message);
                    });
            }

            // Function to display the offer in the 'offers' aside
            function displayOffer(offer) {
                var offersAside = document.getElementById('offers');
                if (offersAside) {
                    offersAside.innerHTML = ''; // Clear previous content

                    var title = document.createElement('h2');
                    title.textContent = offer.eventTitle;

                    var category = document.createElement('p');
                    category.textContent = offer.catDesc;

                    var price = document.createElement('p');
                    price.textContent = 'Price: ' + offer.eventPrice;

                    offersAside.appendChild(title);
                    offersAside.appendChild(category);
                    offersAside.appendChild(price);
                }
            }

            // Function to display an error message in the 'offers' aside
            function displayError(errorMessage) {
                var offersAside = document.getElementById('offers');
                if (offersAside) {
                    offersAside.innerHTML = '<p>' + errorMessage + '</p>';
                }
            }

            // Initial fetch and display of offers
            fetchAndDisplayOffers();

            // Fetch and display offers every 5 seconds
            setInterval(fetchAndDisplayOffers, 5000);
        });
    </script>
</body>

</html>