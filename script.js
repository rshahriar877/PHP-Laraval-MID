document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Validate Student Name
        const name = document.getElementById('name').value;
        const nameError = document.getElementById('nameError');
        if (!/^[a-zA-Z\s]+$/.test(name)) {
            nameError.textContent = 'Name must contain only letters and spaces.';
            valid = false;
        } else {
            nameError.textContent = '';
        }

        // Validate Roll Number
        const roll = document.getElementById('roll').value;
        const rollError = document.getElementById('rollError');
        if (!/^\d+$/.test(roll)) {
            rollError.textContent = 'Roll Number must be a unique number.';
            valid = false;
        } else {
            rollError.textContent = '';
        }

        // Validate Mobile Number
        const mobile = document.getElementById('mobile').value;
        const mobileError = document.getElementById('mobileError');
        if (!/^\d{10,}$/.test(mobile)) {
            mobileError.textContent = 'Mobile number must be at least 10 digits long.';
            valid = false;
        } else {
            mobileError.textContent = '';
        }

        // Validate Email
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('emailError');
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            emailError.textContent = 'Email must be a valid email address.';
            valid = false;
        } else {
            emailError.textContent = '';
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});
