// Function to handle the intersection event
function animateOnScroll(entries, observer) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in-view');
            observer.unobserve(entry.target);
        }
    });
}


document.addEventListener("DOMContentLoaded", () => {
    // Intersection Observer for triggering animations
    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-in-view");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );

    const elements = document.querySelectorAll(".animate-from-below");
    elements.forEach(el => observer.observe(el));
});
