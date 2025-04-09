<?php include('menu.php'); ?>

<!-- Preloader -->
<div id="preloader">
    <div class="loader-container">
        <img src="logo.webp" alt="Daily Orders" class="loader-logo">
        <h1 class="loader-text">Daily Orders</h1>
    </div>
</div>

<!-- Hero Section -->
<header class="hero">
    <div class="hero-text">
        <h1 id="welcome-text">Delicious Food at Your Doorstep</h1>
        <p id="typing-text">Order fresh & tasty food anytime, anywhere.</p>
        <a href="category.php" class="btn">Order Now</a>
    </div>
</header>

<!-- Categories Section -->
<section class="categories">
    <h2>Explore Our Categories</h2>
    <div class="category-container">
        <div class="category">
            <a href="category.php"><img src="food-image/barger.jpg" alt="Burger"></a>
            <p>Burgers</p>
        </div>
        <div class="category">
            <a href="category.php"><img src="food-image/pizza.jpg" alt="Pizza"></a>
            <p>Pizza</p>
        </div>
        <div class="category">
            <a href="category.php"><img src="food-image/pasta.jpg" alt="Pasta"></a>
            <p>Pasta</p>
        </div>
        <div class="category">
            <a href="category.php"><img src="food-image/chaumin.jpg" alt="Chaumin"></a>
            <p>Chaumin</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Foodie | Designed with ❤️</p>
</footer>

<?php include('footer.php'); ?>

<!-- CSS Styles -->
<style>
    body { margin: 0; font-family: Arial, sans-serif; overflow: hidden; }
    
    /* Preloader */
    #preloader {
        position: fixed;
        width: 100%;
        height: 100%;
        background: #121212;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 9999;
    }
    
    .loader-container {
        text-align: center;
    }

    .loader-logo {
        width: 120px;
        animation: bounce 1.8s infinite;
    }

    .loader-text {
        font-size: 32px;
        color: #ff5e62;
        font-weight: bold;
        animation: fadeIn 3ms infinite alternate;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    @keyframes fadeIn {
        0% { opacity: 0.3; }
        100% { opacity: 1; }
    }

    /* Hide preloader after 2.5 seconds */
    .hidden {
        opacity: 0;
        transition: opacity 0.8s ease-out;
        pointer-events: none;
    }
</style>

<!-- JavaScript for Preloader & Typing Effect -->

<!-- JavaScript for Preloader & Typing Effect with Session Storage -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const preloader = document.getElementById("preloader");
        const typingText = document.getElementById("typing-text");
        const loaderLogo = document.querySelector(".loader-logo");

        // Check if preloader was shown before
        if (sessionStorage.getItem("preloaderShown")) {
            // Agar preloader pehle dikh chuka hai, toh use skip kar do
            preloader.style.display = "none";
            document.body.style.overflow = "auto";
        } else {
            // First time visit, show preloader
            sessionStorage.setItem("preloaderShown", true);

            // Start Typing Effect after 600ms delay
            setTimeout(() => {
                const text = "Order fresh & tasty food anytime, anywhere.";
                let index = 0;
                function typeEffect() {
                    if (index < text.length) {
                        typingText.innerHTML += text.charAt(index);
                        index++;
                        setTimeout(typeEffect, 50); // Speed 50ms
                    }
                }
                typingText.innerHTML = ""; 
                typeEffect();
            }, 600);

            // Ensure preloader stays visible for at least 2.5s
            setTimeout(() => {
                preloader.classList.add("hidden");
                document.body.style.overflow = "auto";
            }, 2500);

            // Stop Bounce Animation smoothly after 2.5s
            setTimeout(() => {
                loaderLogo.style.animation = "none"; 
            }, 2500);
        }
    });
</script>

<!-- CSS Adjustments -->
<style>
    /* Preloader Animation */
    .loader-logo {
        width: 120px;
        animation: bounce 1.5s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); } /* Smooth bounce */
    }

    /* Smooth Fade-out Effect */
    .hidden {
        opacity: 0;
        transition: opacity 0.6s ease-out;
        pointer-events: none;
    }
</style>



</script>
