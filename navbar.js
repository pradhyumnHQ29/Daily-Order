document.addEventListener("DOMContentLoaded", function () {
    const preloader = document.getElementById("preloader");
    const typingText = document.getElementById("typing-text");
    const loaderLogo = document.querySelector(".loader-logo");

    if (sessionStorage.getItem("preloaderShown")) {
        preloader.style.display = "none";
        document.body.style.overflow = "auto";
    } else {
        sessionStorage.setItem("preloaderShown", true);

        // Start Typing Effect using Web Worker after 600ms
        setTimeout(() => {
            startTypingEffectWorker();
        }, 600);

        setTimeout(() => {
            preloader.classList.add("hidden");
            document.body.style.overflow = "auto";
        }, 2500);

        setTimeout(() => {
            loaderLogo.style.animation = "none"; 
        }, 2500);
    }

    // Web Worker wala function
    function startTypingEffectWorker() {
        if (window.Worker) {
            const worker = new Worker("typingWorker.js"); // Make sure path is correct

            typingText.innerHTML = "";

            worker.postMessage("Order fresh & tasty food anytime, anywhere.");

            worker.onmessage = function (e) {
                if (e.data !== "done") {
                    typingText.innerHTML += e.data;
                }
            };
        } else {
            // Agar worker supported nahi hai
            typingText.innerHTML = "Order fresh & tasty food anytime, anywhere.";
        }
    }
});

/* Slide button */
function slideLeft() {
    setTimeout(() => {
        document.getElementById('category-container').scrollBy({
            left: -300,
            behavior: 'smooth'
        });
    }, 200);
}

function slideRight() {
    setTimeout(() => {
        document.getElementById('category-container').scrollBy({
            left: 300,
            behavior: 'smooth'
        });
    }, 200);
}
