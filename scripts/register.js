function checkForm() {

    if (username.classList.contains('is-invalid')) {
        username.classList.remove('is-invalid')
    }
    if (password.classList.contains('is-invalid')) {
        password.classList.remove('is-invalid')
    }
    if (passwordConfirm.classList.contains('is-invalid')) {
        passwordConfirm.classList.remove('is-invalid')
    }
    msg.innerHTML = ''

    if (username.value.length < 3) {
        username.classList.remove('is-valid')
        username.classList.add('is-invalid')
        msg.innerHTML += 'Username must be at least three characters long <br>'
    } else {
        username.classList.add('is-valid')
    }
    if (password.value.length < 8) {
        password.classList.remove('is-valid')
        password.classList.add('is-invalid')
        msg.innerHTML += 'Password must be at least eight characters long <br>'
    } else {
        password.classList.add('is-valid')
    }
    if (password.value != passwordConfirm.value) {
        passwordConfirm.classList.remove('is-valid')
        passwordConfirm.classList.add('is-invalid')
        msg.innerHTML += 'Passwords do not match <br>'
    } else if (password.value.length >= 8) {
        passwordConfirm.classList.add('is-valid')
    }

    if (msg.innerHTML == '') {
        msg.style.display = 'none'
    } else {
        msg.style.display = 'block'
    }
}

username = document.getElementById('username')
password = document.getElementById('password')
passwordConfirm = document.getElementById('password-confirm')
msg = document.getElementById('msg')
msg.style.display = 'none'

username.addEventListener('keyup', checkForm)
password.addEventListener('keyup', checkForm)
passwordConfirm.addEventListener('keyup', checkForm)