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
    foreach ($users[0] as $user) {
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
// generate random password
$password = "";
for ($i = 0; $i < 10; $i++) {
    $password .= chr(rand(97, 122));
}
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
} else {
    echo "Loading user $username failed...";
}

?>