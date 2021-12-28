// ------------------- //
// CONFIG STUFF, PLEASE PASTE:
// after this, you have conf.server, conf.id and conf.token
// use like this (ex.): `${conf.server}/chat/` instead of hard-coding the values 
let conf = {}
import ('./config/config.js').then(module => {
    conf = module.val();
});
// ------------------- //



// HTML ELEMENTE ALS GLOBALE VARIABLEN
const input = document.getElementById('username')
const recommendations = document.getElementById('recommendations')
let users = []

// EVENT LISTENER, UM BEIM KLICK AUF EINEN NAMEN DEN NAMEN IN DAS INPUT FELD ZU SCHREIBEN
function autocompleteName(event) {
    input.value = event.target.innerHTML
    recommendations.innerHTML = ''
}

// EVENT LISTENER, DER REAGIERT, WENN USER TIPPT
function getPossibleUsers() {
    // FUNKTION SOLL NUR AUSGEFÜHRT WERDEN, WENN DAS INPUT FELD NICHT LEER IST
    if (input.value === '') {
        // ANSONSTEN WIRD EINE STANDARD-NACHRICHT ANGEZEIGT
        recommendations.innerHTML = 'Start typing to see friend recommendations...'
    } else {
        getAllUsers()
    }
}

// WIRD AUSGEFÜHRT, WENN IN DAS INPUT FELD GESCHRIEBEN WIRD 
// HOLT ZUNÄCHST MIT AJAX ALLE NUTZER AUS DER DATENBANK
// UND MACHT DANN EINE DOM LISTE MIT ALLEN NUTZERN DIE AUF SUCHE ZUTREFFEN
function getAllUsers() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            users = JSON.parse(xmlhttp.responseText);
            // FILTERE NUR DIE NUTZER, IN DENEN DER STRING IM INPUT FELD VORKOMMT - IGNORIERE GROẞ-KLEINSCHREIBUNG
            const relevantUsers = users.filter(user => user.toLowerCase().includes(input.value.toLowerCase()))
                // ERSTELLE EINE LISTE MIT ALLEN NUTZERN, DIE AUCH ANGEKLICKT WERDEN KÖNNEN
            recommendations.innerHTML = ''
            for (user of relevantUsers) {
                li = document.createElement('li')
                li.innerHTML = user
                li.className = "list-group-item "
                li.style = 'cursor: pointer'
                li.addEventListener('click', autocompleteName)
                recommendations.appendChild(li)
            }
        }
    };
    xmlhttp.open("GET", `${chatServer}/chat/${chatCollectionId}/user`, true);
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', `Bearer ${chatToken}`);
    xmlhttp.send();
}

// VALIDIERUNGSFUNKTION, UM ZU VERHINDERN, DASS EIN FRIEND REQUEST AN EINEN NICHT EXISTIERENDEN NUTZER GESCHICKT WIRD
function validateName() {
    if (!users.includes(input.value)) {
        alert('This user does not exist!')
        return false
    }
}

// INPUT FELD FÜR FREUNDE WIRD MIT EVENTLISTENER VERBUNDEN
input.addEventListener(
    'input',
    getPossibleUsers,
    false
);