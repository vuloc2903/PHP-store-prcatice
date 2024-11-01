document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.querySelector('input[name="username"]');
    const usernameLabel = document.querySelector('label[for="username"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const passwordLabel = document.querySelector('label[for="password"]');
    usernameInput.addEventListener('input', handleInputChange);
    passwordInput.addEventListener('input', handleInputChange);
  
    function handleInputChange(event) {
      const input = event.target;
      const label = input.name === 'username' ? usernameLabel : passwordLabel;
  
      if (input.value) {
        label.style.opacity = 0;
      } else {
        label.style.opacity = 1;
      }
    }
  });
  