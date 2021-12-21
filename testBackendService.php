<?php
require("start.php");
use Utils\BackendService;
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
echo "<h1>Good morning</h1>";
echo "<p>This tests every method of BackendendService.php, in order of occurence in the code</p>";


// SHOW ALL USERS
echo "<hr>";
echo "<h2>Show all users</h2>";

$users = $service->getAllUsers();
// loop users
echo "<ul style='max-height:100px;max-width:250px;overflow-y:auto;background:lightgray'>";
    foreach ($users as $user) {
    echo "<li>";

        echo $user;
    }
    echo "</li>";
echo "</ul>";

// REGISTER

echo "<hr>";
echo "<h2>Register</h2>";
// random string
$username = "Testuser-" . rand(0, 10000);
$password = "hunter2";
echo "Attempting to register user $username with password $password <br>";
// call register function from backendService
$user_token = $service->register($username, $password);
if ($user_token !== false) {
    echo "Token: $user_token <br> User $username registered successfully";
} else {
    echo "Registration failed...";
}


// LOGIN

echo "<hr>";
echo "<h2>Login</h2>";
echo "Attempting to login user $username with password $password <br> (same one we just created) <br> <br>";
// call login function from backendService
$user_token = $service->login($username, $password);
if ($user_token !== false) {
    echo "Token: $user_token <br> User $username logged in successfully";
} else {
    echo "Login failed...";
}

// USER EXISTS

echo "<hr>";
echo "<h2>User exists</h2>";
echo "Checking if user $username exists <br><br>";
// call exists function from backendService
$exists = $service->exists($username);
if ($exists) {
    echo "User $username exists";
} else {
    echo "User $username does not exist";
}
echo "<br><em> the above should succeed, the following should fail: </em><br>";
$silly_username = "Hans Dieter Gerald " . rand(0, 10000);
$exists = $service->exists($silly_username);
if ($exists) {
    echo "User $silly_username exists";
} else {
    echo "User $silly_username does not exist";
}


// LOAD USER

echo "<hr>";
echo "<h2>Load user</h2>";
echo "Attempting to load user $username <br>";
// call loadUser function from backendService
$user = $service->loadUser($username, $user_token);
if ($user !== false) {
    echo "User $username loaded successfully <br>";
    echo "User: " . $user;
} else {
    echo "Loading user $username failed...";
}


// SAVE USER

echo "<hr>";
echo "<h2>Save user</h2>";
echo "Attempting to save user $username <br>";
// get a random dinosaur name
$dinosaurs = ["Pterodactyl", "Iguanodon", "Brontosaurus", "Gallimimus", "Ankylosaurus", "Stegosaurus"];
$dinosaur = $dinosaurs[rand(0, count($dinosaurs) - 1)];
$user->setFavoriteDinosaur($dinosaur);

$user = $service->saveUser($user, $user_token);
if ($user !== false) {
    echo "User $username saved successfully, his favorite dinosaur is now $dinosaur <br>";
} else {
    echo "Saving user $username failed...";
}


// LOAD FRIENDS

echo "<hr>";
echo "<h2>Load friends</h2>";
echo "Attempting to load friends of user $username <br>";
$friends = $service->loadFriends($user_token);
if ($friends !== false) {
    echo "Friends of user $username loaded successfully: <br>";
    // // loop friends array and echo 
    // foreach ($friends as $friend) {
    //     echo $friend . "<br>";
    // }
    var_dump($friends);
} else {
    echo "Loading friends of user $username failed...";
}

// FRIEND REQUEST

echo "<hr>";
echo "<h2>Friend request</h2>";
// get random user from users array
$random_user = $users[0];
echo "<b>Attempting to send friend request to user $random_user from $username</b><br>";
// generate a friend object from random user with status accepted
$friend = new Model\Friend($random_user, "accepted");
$request_succeeded = $service->friendRequest($friend, $user_token);
if ($request_succeeded) {
    echo "Friend request sent successfully to user $random_user <br>";
} else {
    echo "Friend request failed...";
}

echo "<em>$username's friend list now looks like: <br></em>";

$friends = $service->loadFriends($user_token);
var_dump($friends);
echo "<br>";
echo "<br>";

// get random user from users array
$random_user = $users[1];
echo "<b>Attempting to send friend request to user $random_user from $username</b><br>";
// generate a friend object from random user with status accepted
$friend = new Model\Friend($random_user); 
$request_succeeded = $service->friendRequest($friend, $user_token);
if ($request_succeeded) {
    echo "Friend request sent successfully to user $random_user <br>";
} else {
    echo "Friend request failed...";
}

echo "<em>$username's friend list now looks like: <br></em>";
$friends = $service->loadFriends($user_token);
var_dump($friends);


// FRIEND ACCEPT

echo "<hr>";
echo "<h2>Friend accept/dismiss</h2>";

echo "annoying to test, because you would have to login the other user";


// FRIEND REMOVE
echo "<hr>";
echo "<h2>Friend remove</h2>";
// get first user from friends array
$friend = $random_user;
$friend_object = new Model\Friend($friend);
echo "<br>Attempting to remove friend $friend from $username <br>";
$remove_succeeded = $service->friendRemove($friend_object, $user_token);
if ($remove_succeeded) {
    echo "Friend $friend removed successfully from $username <br>";
} else {
    echo "Friend remove failed...";
}
echo "<em>$username's friend list now looks like: <br></em>";
$friends = $service->loadFriends($user_token);
var_dump($friends);

echo "<br> <b>API call succeeds but does not actually delete friend. cool.</b>";

// GET UNREAD MESSAGES

echo "<hr>";
echo "<h2>Get unread messages</h2>";
echo "Attempting to get unread messages <br>";
$messages = $service->getUnreadMessages($user_token);
if ($messages !== false) {
    var_dump($messages);
} else {
    echo "Getting unread messages failed...";

}


?>
