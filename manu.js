// Live Search Function
function liveSearch() {
    let query = document.getElementById("searchInput").value.trim();

    if (query.length > 0) {
        fetch(`search.php?query=${encodeURIComponent(query)}`)
            .then(response => response.text())
            .then(data => {
                let resultsDiv = document.getElementById("searchResults");
                resultsDiv.innerHTML = data;
                resultsDiv.style.display = "block";
            });
    } else {
        let resultsDiv = document.getElementById("searchResults");
        resultsDiv.innerHTML = "";
        resultsDiv.style.display = "none";
    }
}

// Select item from search results
function selectItem(item) {
    document.getElementById("searchInput").value = item;
    document.getElementById("searchResults").innerHTML = "";
    document.getElementById("searchResults").style.display = "none";
}

// Show or hide the profile menu
function toggleProfileMenu() {
    let menu = document.getElementById("profileMenu");
    if (menu) {
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }
}

// Hide profile menu when clicking outside
document.addEventListener("click", function(event) {
    let menu = document.getElementById("profileMenu");
    if (!event.target.closest(".profile-container")) {
        if (menu) menu.style.display = "none";
    }
});
