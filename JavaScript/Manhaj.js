// Display the default content on page load
document.addEventListener('DOMContentLoaded', () => {
    const defaultContent = document.querySelector('.content.active');
    if (defaultContent) {
        defaultContent.style.display = 'block';
        defaultContent.classList.add('fade-in');
    }
});

function showContent(contentId) {
    // Hide all content sections
    const allContent = document.querySelectorAll('.content');
    allContent.forEach((content) => {
        content.style.display = 'none'; // Hide all content sections
        content.classList.remove('fade-in', 'active'); // Remove fade-in and active classes
    });

    // Show the selected content section
    const selectedContent = document.getElementById(contentId);
    if (selectedContent) {
        selectedContent.style.display = 'block'; // Make it visible

        // Use a timeout to ensure animation restarts correctly
        setTimeout(() => {
            selectedContent.classList.add('fade-in'); // Add fade-in animation
        }, 50); // Slight delay for the animation to apply

        selectedContent.classList.add('active'); // Mark as active
    }
}
