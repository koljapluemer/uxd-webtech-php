<?php
require("start.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <p>
        <?php
        $user = new Model\User("Test");
        var_dump($user);
        echo "<hr>";
        //echo $user->toJson();
        $zeichenkette = json_encode($user);
        echo $zeichenkette . "<hr>";
        $obj = json_decode($zeichenkette);
        var_dump($obj);
        echo "<hr>";
        // $obj->getUsername(); geht nicht!
        // wie könnte man aus einem beliebigen Objekt eine korrekte User-Instanz erzeugen?
        // $user2 = new User($obj->username);
        $user2 = Model\User::fromJson($obj);
        var_dump($user2);
        echo "<hr>";
        $token = $service->login("Test123456", "12345678");
        if ($token !== false) {
            echo "Token: $token";
        } else {
            echo "Login failed...";
        }
        echo "<hr>";
        if ($service->exists("Test12345")) {
            echo "ja";
        } else {
            echo "nein";
        }
        echo "<hr>";
        $user3 = $service->loadUser("Test12345", $token);
        var_dump($user3);

        // Kann über mehrere Ansichten verteilt werden! (Zuweisung und Auslesen)
        $_SESSION["test"] = "Value";
        echo $_SESSION["test"];

        echo "<h1>Testing the Friend class</h1>";
        // Test the Friend class as well
        $friend = new Model\Friend("Hubert");
        $friend->setStatus("accepted");
        var_dump($friend);

        ?>
    </p>
</body>

</html>