document.getElementById('loginForm').addEventListener('submit', function (event) {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    if (username === '' || password === '') {
        alert('Please fill in both the username and password fields.');
        event.preventDefault(); // Prevent form submission
        return;
    }

    // Additional validation (e.g., minimum length)
    if (username.length < 3 || password.length < 6) {
        alert('Username must be at least 3 characters and password at least 6 characters.');
        event.preventDefault();
        return;
    }

    // Allow form submission
    alert('Login successful (Validation passed).');
});

