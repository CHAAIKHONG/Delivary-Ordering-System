document.addEventListener('DOMContentLoaded', function(){
    var password = document.getElementById('password');
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
});
