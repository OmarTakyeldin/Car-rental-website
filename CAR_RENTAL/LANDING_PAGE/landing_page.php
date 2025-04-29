<?php
    include("get_cars.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./landing_page_style.css">
    <script
      src="https://kit.fontawesome.com/66aa7c98b3.js"
      crossorigin="anonymous"></script>
    <title>CarNow.my</title>
</head>

<body>
    <script>
    function scrollToElement(id, offset) {
        const element = document.getElementById(id);
        const position = element.offsetTop - offset;
        window.scrollTo({ top: position, behavior: 'smooth' });
    }
    </script>
    <nav class="navbar">
        <img src="../car-now-logo.png" alt="logo" width="100px">
        <ul class="links">
            <a href="#infographics"><li>About</li></a>
            <a href="#" onclick="scrollToElement('cta', 200);"><li>New Booking</li></a>
            <a href="../TRACK/track.php"><li>Track Reservation</li></a>
            <a href="../CONTACT/contact.php"><li>Contact Us</li></a>
        </ul>
    </nav>



    <header class="hero">
        <div class="container spacing">
            <h1 class="primary-title">Elevate your travel experience.</h1>
            <p>Car-Now provides a premium car rental service with a wide range of vehicles at competitive prices. We pride ourselves on exceptional customer support, and a seamless rental experience. Choose us and drive with confidence and ease.</p>
            <a href="#products" class="btn">See what we have</a>
        </div>
    </header>


    <main>


    <section class="products" id="products">
        <div class="container">
            <h2 class="section-title">Cars available</h2>
            <div class="split" id="car-slideshow">
            </div>
        </div>
    </section>

        <section class="infographics" id="infographics">
            <div class="container">
                <h2 class="section-title">What we offer?</h2>
                <div class="flex-grid-container">
                    <div class="flex-row">
                        <img src="./img/Screenshot_2023-03-19_at_8.32.58_PM-removebg-preview.png" alt="removed">
                        <div class="content-container">
                            <ul>
                                <li>Access to a wide selection of vehicles, including 11+ luxury and sports cars</li>
                                <li>Fast and efficient pickup and drop-off process</li>
                                <li>GPS navigation, child car seats, and additional insurance coverage</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex-row">
                        <div class="content-container">
                            <ul>
                                <li>24/7 online chat support to assist you</li>
                                <li>No hidden fees or charges - everything is transparent and upfront</li>
                                <li>Discounts for loyal customers and referrals</li>
                                
                            </ul>
                        </div>
                        <img src="./img/Screenshot_2023-03-19_at_8.33.02_PM-removebg-preview.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="call-to-action" id="cta">
            <div class="container">
                <div class="action-container">
                    <div class="circle-orange-small"></div>
                    <div class="circle-blue"></div>
                    <div class="circle-orange-big"></div>
                    <div class="circle-center"></div>
                    <div class="circle-center-text">
                        <div class="circle-green"></div>
                        <h1 class="question">Need a car?</h1>
                        <a href="../CONTACT/contact.php" class="cta" >
                            <button>Book Now</button>
                            <div class="join-btn">
                                
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>


        <section class="reviews">
            <div class="container">
                <h2 class="section-title">Testimonials</h2>
                <div class="grid-container">

                    <div class="review-cards">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <p class="review__username">Jon Smith</p>
                        <p class="review">"Car-Now made renting a car so easy! Their web app was user-friendly, and their customer service team was incredibly helpful. I would definitely recommend them to anyone looking for a hassle-free car rental experience."</p>
                    </div>
                    <div class="review-cards">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <p class="review__username">Michael Lee</p>
                        <p class="review">"I was impressed with the range of vehicles Car-Now had available for rent. The process was seamless, and the pricing was very competitive. I would definitely use their service again."</p>
                    </div>
                    <div class="review-cards">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <p class="review__username">Karen Tan</p>
                        <p class="review">"Car-Now's customer support team went above and beyond to ensure I had the right vehicle for my trip. Their attention to detail and commitment to customer satisfaction was impressive. I highly recommend them."</p>
                    </div>
                    <div class="review-cards">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <p class="review__username">Vishnu Dakashran</p>
                        <p class="review">"I was very happy with the service I received from Car-Now. Their web app was easy to use, and the pickup process was quick and efficient. The car I rented was in excellent condition, and I had a great experience overall."</p>
                    </div>
                </div>
            </div>

        </section>


        <section class="footer">
                <div class="heading">
                  <img src="../car-now-logo.png" alt="logo" width="100px" style="border-radius: 14px ;">
                </div>
                <div class="content">
                  <div class="social-media">
                    <h4>Socials</h4>
                    <p>
                      <a href=#><i class="fab fa-instagram"></i> Instagram</a>
                      
                    </p>
                    <p>
                        <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
                    </p>
                    <p>
                        <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                    </p>

                  </div>
                  <div class="links">
                    <h4>Quick links</h4>
                    <p><a href="#">Home</a></p>
                    <p><a href="#">About</a></p>
                    <p><a href="../TRACK/track.php">Track Reservation</a></p>
                    <p><a href="../CONTACT/contact.php">Contact</a></p>
                  </div>
                  <div class="details">
                    <h4 class="address">Address</h4>
                    <p>
                      University of Nottingham Malaysia <br />
                      43500 Semenyih, Selangor
                    </p>
                    <h4 class="mobile">Mobile</h4>
                    <p><a href="#">+03-8924 8000</a></p>
                    <h4 class="mail">Email</h4>
                    <p><a href="#">info@carnow.my</a></p>
                  </div>
                </div>
                <footer>
                  <hr />
                  &copy; Car-now Malaysia Technologies Pvt. Ltd.
                </footer>
        </section>

    </main>


</body>


<script>
    // Parse the JSON data generated by the PHP script
    const allCars = <?php echo $allCarsJson; ?>;

    // Initialize the carousel with the first set of cars
    const slideshow = document.querySelector('#car-slideshow');
    for (let i = 0; i < 3; i++) {
        const carElement = document.createElement('a');
        carElement.href = '#';
        carElement.classList.add('featured__item');
        carElement.innerHTML = `
        <img src="${allCars[i].car_img}" alt="${allCars[i].car_name}" class="featured__img">
        <p class="featured__details">${allCars[i].car_name}</p>
        <p class="featured__price">from RM${allCars[i].price}</p>
        `;
        slideshow.appendChild(carElement);
    }

    // Start the interval timer for fetching new car data
    setInterval(() => {
        // Shuffle the array of cars to get a random set of 3
        const randomCars = shuffleArray(allCars).slice(0, 3);

        // Clear the carousel
        slideshow.innerHTML = '';

        // Add the new set of cars to the carousel
        for (let i = 0; i < randomCars.length; i++) {
            const car = randomCars[i];
            const carElement = document.createElement('a');
            carElement.href = '#';
            carElement.classList.add('featured__item', 'hidden'); // add the hidden class to newly added items
            carElement.innerHTML = `
            <img src="${car.car_img}" alt="${car.car_name}" class="featured__img">
            <p class="featured__details">${car.car_name}</p>
            <p class="featured__price">from RM${car.price}</p>
            `;
            slideshow.appendChild(carElement);
        }

        // Wait for a brief moment to allow the DOM to update before removing the hidden class
        setTimeout(() => {
            const items = document.querySelectorAll('.featured__item');
            for (let i = 0; i < items.length; i++) {
                const item = items[i];
                item.classList.remove('hidden'); // remove the hidden class to reveal the item with a fade-in effect
            }
        }, 50);
    }, 5000);

    // Shuffle an array using the Fisher-Yates algorithm
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }
</script>


</html>