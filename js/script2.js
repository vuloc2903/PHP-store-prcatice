document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.querySelector('input[name="username"]');
    const usernameLabel = document.querySelector('label[for="username"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const passwordLabel = document.querySelector('label[for="password"]');
    const emailInput = document.querySelector('input[name="email"]');
    const emailLabel = document.querySelector('label[for="email"]');

    usernameInput.addEventListener('input', handleInputChange);
    passwordInput.addEventListener('input', handleInputChange);
    emailInput.addEventListener('input', handleInputChange);

    function handleInputChange(event) {
        const input = event.target;
        let label;

        if (input.name === 'username') {
            label = usernameLabel;
        } else if (input.name === 'password') {
            label = passwordLabel;
        } else if (input.name === 'email') {
            label = emailLabel;
        }

        if (input.value) {
            label.style.opacity = 0;
        } else {
            label.style.opacity = 1;
        }
    }
});