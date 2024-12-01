<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureGuard | Your Trusted Sanitation Partner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
   
    <style>

        body {
            background-color: var(--bg-color);
            font-family: 'Sf-Pro';
            color:#000000;
            margin: 0;
            display:flex;
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: white;
        }

        .carousel img {
            height: 400px;
            object-fit: cover;
        }

        .hero {
            text-align: center;
            padding: 40px 20px;
            background-color: var(--primary-color);
            color: white;
        }

        .facts, .developers {
            padding: 40px 20px;
        }

        .facts h3, .developers h3 {
            margin-bottom: 20px;
        }

        .facts .fact-card, .developers .developer-card {
            background-color: var(--bg-color);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .products {
            padding: 40px 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            height: 200px;
            margin-bottom: 15px;
        }

        .product-card h5 {
            margin-bottom: 10px;
        }

        .product-card .price {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px;
        }
/* General Carousel Styles */
.swiper-container {
    width: 80%;
    margin: 40px auto;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
}

.carousel-image {
    transition: transform 0.5s ease, opacity 0.5s ease;
    border-radius: 10px;
}

.center-img {
    width: 50%;
    transform: scale(1.1);
    opacity: 1;
    z-index: 2;
}

.side-img {
    width: 30%;
    transform: scale(0.85);
    opacity: 0.5;
    z-index: 1;
}
</style>

</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">PureGuard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#developers">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to PureGuard</h1>
        <p>Your trusted sanitation partner for a cleaner and safer tomorrow.</p>
    </div>
<!-- Carousel Section -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide">
            <div class="d-flex justify-content-center align-items-center">
                <img src="img/banner2.jpg" class="carousel-image side-img" alt="Hand Sanitizer">
                <img src="img/banner1.jpg" class="carousel-image center-img" alt="Disinfectant Spray">
                <img src="img/banner3.jpg" class="carousel-image side-img" alt="Antibacterial Wipes">
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide">
            <div class="d-flex justify-content-center align-items-center">
                <img src="img/banner1.jpg" class="carousel-image side-img" alt="Disinfectant Spray">
                <img src="img/banner3.jpg" class="carousel-image center-img" alt="Antibacterial Wipes">
                <img src="img/banner4.jpg" class="carousel-image side-img" alt="Air Purifier">
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide">
            <div class="d-flex justify-content-center align-items-center">
                <img src="img/banner3.jpg" class="carousel-image side-img" alt="Antibacterial Wipes">
                <img src="img/banner4.jpg" class="carousel-image center-img" alt="Air Purifier">
                <img src="img/banner5.jpg" class="carousel-image side-img" alt="Sanitizing Gel">
            </div>
        </div>
    </div>
    <!-- Swiper Navigation -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>





    <!-- Facts Section -->
    <div class="facts">
        <div class="container">
            <h3>Why Choose PureGuard?</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="fact-card">
                        <h5>99.9% Effective</h5>
                        <p>Our products eliminate 99.9% of germs and bacteria.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fact-card">
                        <h5>Eco-Friendly</h5>
                        <p>We prioritize sustainable and biodegradable materials.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fact-card">
                        <h5>Trusted by Experts</h5>
                        <p>Recommended by health professionals worldwide.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Developers Section -->
    <div id="developers" class="developers">
        <div class="container">
            <h3>Meet the Developers</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="developer-card">
                        <h5>Jane Doe</h5>
                        <p>Lead Designer & Developer</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="developer-card">
                        <h5>John Smith</h5>
                        <p>Product Manager & Strategist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 PureGuard. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
