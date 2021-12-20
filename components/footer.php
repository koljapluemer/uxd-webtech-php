<footer class="container-fluid bg-light navbar fixed-bottom">
<p>

    <h4>User:</h4>
        <?php
            require('start.php');

        if (isset($_SESSION['username'])) {
            echo $_SESSION['username'];
            // show last 10 characters of user token
            echo " (...".substr($_SESSION['user_token'], -10).")";
        } else {
            echo "Not logged in";
        }
        ?>
    </p>

    <div>
        <h4>Newest Users:</h4>
        <div>
            <?php

            // get a list of users
            $users = $service->getAllUsers();
            // get last three users
            $users = array_slice($users, -3);
            // print them
            foreach ($users as $user) {
                echo "<p>User: " . $user . "</p>";
            }

            ?>
        </div>
    </div>
</footer>