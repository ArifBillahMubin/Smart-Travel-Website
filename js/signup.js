// Wait for the DOM to fully load
document.addEventListener("DOMContentLoaded", () => {
    const signupForm = document.querySelector("#signup-form");

    // Handle form submission
    signupForm.addEventListener("submit", (event) => {
        event.preventDefault(); // Prevent form from being submitted immediately

        // Get input values
        const username = document.querySelector("#username").value.trim();
        const email = document.querySelector("#email").value.trim();
        const password = document.querySelector("#password").value.trim();
        const confirmPassword = document.querySelector("#confirm-password").value.trim();

        // Validate form inputs
        if (!username || !email || !password || !confirmPassword) {
            alert("All fields are required!");
            return;
        }

        if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return;
        }

        // If validation passes, submit the form (or simulate signup)
        alert("Signup successful!");
        signupForm.submit(); // Uncomment this to actually submit the form
    });

    // Validate email format
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
