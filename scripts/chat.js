chat = document.getElementById('chat-wrapper')
msgSend = document.getElementById('msg-send')
msgInput = document.getElementById('msg-input')


// repeatedly loaded every second, gets all messages, puts them in the DOM
function loadChat() {
    console.log('loading chat...')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);

            // clear out chat window
            chat.innerHTML = ''

            previousName = ''
            for (message of data) {
                // build each chat message
                msg = document.createElement('div')
                msg.className = 'message list-item bg-light p-3 border mb-2'
                if (message.from != partner) {
                    msg.className += ' ms-5'
                } else {
                    msg.className += ' me-5'
                }
                info = document.createElement('div')
                n = document.createElement('span')
                t = document.createElement('span')
                t.className = 'time text-muted'
                t.innerHTML = new Date(message.time).toLocaleTimeString("en-US")
                info.appendChild(t)
                msg.appendChild(info)
                c = document.createElement('content')
                c.className = 'content'
                c.innerHTML = message.msg

                msg.appendChild(c)

                chat.appendChild(msg)
                previousName = message.from
            }

            // chat is height limited with scrolling enabled, this scrolls down to the newest message
            chat.scrollTo(0, chat.scrollHeight)
        }
    };
    xmlhttp.open("GET", `${chatServer}/${chatCollectionId}/message/${partner}`, true);
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', `Bearer ${chatToken}`);
    xmlhttp.send();
}


// boilerplate repeated execution
window.setInterval(function() {
    loadChat()
}, 1000);