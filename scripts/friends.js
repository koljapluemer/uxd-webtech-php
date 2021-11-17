// ------------------- //
// CONFIG STUFF, PLEASE PASTE:
// after this, you have conf.server, conf.id and conf.token
// use like this (ex.): `${conf.server}/chat/` instead of hard-coding the values 
let conf = {}
import('./config/config.js').then(module => {
    conf = module.val();
  });
// ------------------- //



// the html elements we need over and over
const input = document.getElementById('username')
const recommendations = document.getElementById('recommendations')
// helper variable so we have to hit the server less often
let users = []

// if user clicks on a name, it gets autocompleted in the input field
// called as an event listener on each name list element
function autocompleteName(event) {
    input.value = event.target.innerHTML
}

// called by event listener when user types
// the real meat is in getAllUsers, this just resets the recommendation div to the default message 
// if the input box is empty (dont want to display hundreds of users)
function getPossibleUsers() {
    if (input.value === '') {
        recommendations.innerHTML = 'Start typing to see friend recommendations...'
    } else {
        getAllUsers()
    }
}

// AJAX function mostly stolen from the doc
// if we get the users sucessfully, we filter them by the characters in the input field 
// and then use some rather verbose JS to make a list with all users, which you can also click on
function getAllUsers() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            users = JSON.parse(xmlhttp.responseText);
            const relevantUsers = users.filter(user => user.toLowerCase().includes(input.value.toLowerCase()))
            ul = document.createElement('ul')
            recommendations.innerHTML = ''
            for (user of relevantUsers) {
                li = document.createElement('li')
                li.innerHTML = user
                li.style = 'cursor: pointer'
                li.addEventListener('click', autocompleteName)
                ul.appendChild(li)
            }
            recommendations.appendChild(ul)
        }
    };
    xmlhttp.open("GET", `${conf.server}/chat/${conf.id}/user`, true);
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', `Bearer ${conf.token}`);
    xmlhttp.send();   
}

function validateName() {
    if (!users.includes(input.value)) {
        alert('This user does not exist!')
        return false
    }
}

input.addEventListener(
    'input',
    getPossibleUsers,
    false
  );