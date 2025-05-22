// notifications.js

function displayNotification(message) {
    const notificationContainer = document.createElement('div');
    notificationContainer.className = 'notification';
    notificationContainer.innerText = message;

    document.body.appendChild(notificationContainer);

    // Automatically remove the notification after 3 seconds
    setTimeout(() => {
        notificationContainer.remove();
    }, 3000);
}

// Example usage
displayNotification("You have a new message!");
