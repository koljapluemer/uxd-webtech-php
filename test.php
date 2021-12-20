<?php
require("start.php");

// HttpClient
// und ... BackendService
// Aufgabe: Erstellen Sie eine neue Klasse: BackendService in Utils, ergänzen Sie einen Konstruktor mit parametern für server und collectionId, sowie passende Attribute
// Hinweis: namespace Utils;
// Hinweis 2: kein JSON-Code (hier nicht nötig)
// ca. 5 Minuten
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
if($token !== false) {
    echo "Token: $token";
} else {
    echo "Login failed...";
}
echo "<hr>";
if($service->exists("Test12345")) {
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
?>
    </p>
</body>
</html>