// logout.js
function logout() {
    // Clear the login state
    localStorage.removeItem('loggedIn');
    // Redirect to the login page
    window.location.href = 'Login.html';
}

// Show or hide the logout button based on login state
document.addEventListener('DOMContentLoaded', function () {
    const loggedIn = localStorage.getItem('loggedIn');
    const logoutButton = document.getElementById('logoutButton');

    if (loggedIn) {
        // If logged in, show the logout button
        logoutButton.style.display = 'inline';
    } else {
        // If not logged in, hide the logout button
        logoutButton.style.display = 'none';
    }

    // Attach the logout function to the logout button
    logoutButton.addEventListener('click', logout);
});
