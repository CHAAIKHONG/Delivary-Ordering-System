document.addEventListener('DOMContentLoaded', function(){
    var password = document.querySelector('input[name="pass"]');
    var button = document.getElementById('concel');

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

    var con_password = document.querySelector('input[name="confirm_pass"]');
    var con_button = document.getElementById('confirm_concel');
    
    if (con_password && con_button) {
        con_button.addEventListener('click', function(){
            if (con_password.type === 'password') {
                con_password.setAttribute('type', 'text');
                con_button.classList.add('open');
            } else {
                con_password.setAttribute('type', 'password');
                con_button.classList.remove('open');
            }
        });
    }
});

