// Toggle password visibility
document.addEventListener('DOMContentLoaded', () => {
    const eyeIcons = document.querySelectorAll('.eye');

    eyeIcons.forEach(eye => {
        eye.addEventListener('click', () => {
            const inputGroup = eye.closest('.input-group');
            const passwordInput = inputGroup.querySelector('input[type="password"], input[type="text"]');
            
            if (!passwordInput) return;

            // Toggle input type
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eye.textContent = '👁️‍🗨️'; // Eye with speech bubble (closed eye alternative)
            } else {
                passwordInput.type = 'password';
                eye.textContent = '👁️'; // Open eye
            }
        });

        // Add cursor pointer style
        eye.style.cursor = 'pointer';
    });
});
