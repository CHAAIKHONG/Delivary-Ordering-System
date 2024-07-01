document.addEventListener('DOMContentLoaded', function(){
    var password = document.querySelector('input[name="pass"]');
    var button = document.getElementById('concel');
    var confirmPassword = document.querySelector('input[name="confirm_pass"]');
    var confirmButton = document.getElementById('confirm_concel');
    var form = document.getElementById('registerForm');
    var errorMessage = document.getElementById('error_message');

    if (password && button) {
        button.addEventListener('click', function(){
            if (password.type === 'password') {
                password.setAttribute('type', 'text');
                button.classList.add('open');
            } else {
                password.setAttribute('type', 'password');
                button.classList.remove('open');
            }
        });
    }

    if (confirmPassword && confirmButton) {
        confirmButton.addEventListener('click', function(){
            if (confirmPassword.type === 'password') {
                confirmPassword.setAttribute('type', 'text');
                confirmButton.classList.add('open');
            } else {
                confirmPassword.setAttribute('type', 'password');
                confirmButton.classList.remove('open');
            }
        });
    }

    form.addEventListener('submit', function(event) {
        if (password.value !== confirmPassword.value) {
            event.preventDefault();
            errorMessage.textContent = 'Password and Confirm Password do not match. Please re-enter.';
            password.value = '';
            confirmPassword.value = '';
        }
    });
});