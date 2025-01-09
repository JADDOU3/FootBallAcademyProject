document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".btn");
    const form = document.getElementById("signup-form");
    const subscriptionType = document.getElementById("subs-type");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            // Get the subscription type from the button's data-type attribute
            const selectedType = button.getAttribute("data-type");

            // Update the subscription type in the form
            subscriptionType.value = selectedType;

            // Scroll to the form
            form.scrollIntoView({ behavior: "smooth" });
        });
    });
});
