// This function runs when the user types in the search box
function liveSearch() {
    let query = document.getElementById("searchInput").value.trim();

    if (query.length > 0) {
        // Send request to the server with the search text
        fetch(`search.php?query=${encodeURIComponent(query)}`)
            .then(response => response.text())
            .then(data => {
                // Show the search results
                let resultsDiv = document.getElementById("searchResults");
                resultsDiv.innerHTML = data;
                resultsDiv.style.display = "block";
            });
    } else {
        // Hide the results if input is empty
        let resultsDiv = document.getElementById("searchResults");
        resultsDiv.innerHTML = "";
        resultsDiv.style.display = "none";
    }
}

// This function runs when the user clicks on a result item
function selectItem(item) {
    // Set the input box value to the selected item
    document.getElementById("searchInput").value = item;
    // Hide the search results
    document.getElementById("searchResults").innerHTML = "";
    document.getElementById("searchResults").style.display = "none";
}

// This function shows or hides the profile menu
function toggleProfileMenu() {
    let menu = document.getElementById("profileMenu");
    // Toggle the menu display
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

// This hides the profile menu if user clicks outside of it
document.addEventListener("click", function(event) {
    let menu = document.getElementById("profileMenu");
    if (!event.target.closest(".profile-container")) {
        menu.style.display = "none";
    }
});

// Lazy load the profile menu toggle function only when it's required (on click)
document.getElementById('profileMenuToggle').addEventListener('click', function() {
    import('./profileMenu.js').then(module => {
        module.toggleProfileMenu(); // Calling lazy-loaded function from profileMenu.js
    }).catch(error => {
        console.error("Profile menu script load failed:", error);
    });
});

/*profile**/
// This function shows or hides the profile menu
export function toggleProfileMenu() {
    let menu = document.getElementById("profileMenu");
    // Toggle the menu display
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
