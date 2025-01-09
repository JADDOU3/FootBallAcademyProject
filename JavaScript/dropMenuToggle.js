// Check the stored value for isLoggedin (default to false if not set)
let isLoggedin = JSON.parse(localStorage.getItem('isLoggedin')) || false;

// Function to toggle dropdown visibility
function toggleDropdownVisibility() {
    isLoggedin = true; // Set isLoggedin to true after login
    localStorage.setItem('isLoggedin', JSON.stringify(isLoggedin));

    const dropdownMenu = document.getElementsByClassName("dropdown")[0];
    if (dropdownMenu) {
        dropdownMenu.style.display = "inline-block"; // Show the dropdown
    }
}

// Function to handle logout
function logout() {
    // Set isLoggedin to false
    isLoggedin = false;
    localStorage.setItem('isLoggedin', JSON.stringify(isLoggedin));

    // Hide the dropdown menu
    const dropdownMenu = document.getElementsByClassName("dropdown")[0];
    if (dropdownMenu) {
        dropdownMenu.style.display = "none";
    }

    // Redirect to the logout PHP script
    window.location.href = "logout.php";
}

// Apply the initial state based on localStorage when the page loads
window.onload = function() {
    const dropdownMenu = document.getElementsByClassName("dropdown")[0];
    if (dropdownMenu) {
        if (isLoggedin) {
            dropdownMenu.style.display = "inline-block"; // Show the dropdown
        } else {
            dropdownMenu.style.display = "none"; // Hide the dropdown
        }
    }
};