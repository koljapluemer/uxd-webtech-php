username = document.getElementById('username')
password = document.getElementById('password')
passwordConfirm = document.getElementById('password-confirm')

document.getElementById('checkSubmission').onsubmit = function(evt) {

    username.style.border = "1px solid green";
    password.style.border = "1px solid green";
    passwordConfirm.style.border = "1px solid green";
    msg.innerHTML = ''

    isValid = true



    if (username.value.length < 3) {
        msg.innerHTML += '»Name« bitte ausfüllen <br>'
        username.style.border = "1px solid red";
        isValid = false
    }
    if (password.value.length < 8) {
        msg.innerHTML += 'Passwort muss mind. 8 Zeichen haben <br>'
        password.style.border = "1px solid red";
        isValid = false

    }
    if (password.value != input3.value) {
        msg.innerHTML += 'Passworter stimmen nicht überein <br>'
        input3.style.border = "1px solid red";
        isValid = false

    }

    if (isValid) {
        msg.innerHTML = 'Registrierung erfolgreich'
    } else {
        evt.preventDefault();
    }

}