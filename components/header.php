<header class="container-fluid bg-light navbar fixed-top">
    <p>

    User: 
    <?php
    require('start.php');

    if (isset($_SESSION['username'])) {
        echo $_SESSION['username'];
        // show last 10 characters of user token
        echo " (..." . substr($_SESSION['user_token'], -10) . ")";
    } else {
        echo "Not logged in";
    }
    ?>
    </p>
    <div class="link-list">
        <a href="chat.php">Chat</a>
        <a href="friends.php">Friends</a>
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
        <a href="register.php">Register</a>

    </div>
</header>