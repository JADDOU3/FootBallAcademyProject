document.addEventListener('DOMContentLoaded', function () {
    // Fetch notifications when the page loads
    fetchNotifications();

    // Fetch notifications every 10 seconds (polling)
    setInterval(fetchNotifications, 10000);

    // Add click event to mark notifications as read
    document.addEventListener('click', function (event) {
        if (event.target.closest('#notification-item')) {
            markNotificationsAsRead();
        }
    });
});

// Function to fetch notifications from the server
function fetchNotifications() {
    fetch('../PHP/fetch_notifications.php')
        .then(response => response.json())
        .then(data => {
            const notificationCount = document.getElementById('notification-count');
            const notificationItem = document.getElementById('notification-item');

            // Update notification count
            notificationCount.textContent = data.length;

            // Display notifications in the dropdown
            if (data.length > 0) {
                let notificationList = '<div class="notification-list">';
                data.forEach(notification => {
                    notificationList += `
                        <div class="notification">
                            <p>${notification.message}</p>
                            <small>${new Date(notification.created_at).toLocaleString()}</small>
                        </div>
                    `;
                });
                notificationList += '</div>';
                notificationItem.innerHTML = `<i id="notification-bell" class="fa-solid fa-bell"></i>
                                              <span id="notification-count" class="notification-badge">${data.length}</span> الاشعارات
                                              ${notificationList}`;
            } else {
                notificationItem.innerHTML = `<i id="notification-bell" class="fa-solid fa-bell"></i>
                                              <span id="notification-count" class="notification-badge">0</span> الاشعارات`;
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

// Function to mark notifications as read
function markNotificationsAsRead() {
    fetch('../PHP/mark_notifications_as_read.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                fetchNotifications(); // Refresh notifications after marking as read
            }
        })
        .catch(error => console.error('Error marking notifications as read:', error));
}