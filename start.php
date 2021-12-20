<?php
session_start(); // Bezug Vorlesung, vgl. PHP Sessions!

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

// Define erstellt eine Konstante, die kann dann im folgenden einfach mit dem namen verwendet werden... z.B. CHAT_SERVER_URL (ohne $)
define("CHAT_SERVER_URL", "https://online-lectures-cs.thi.de/chat");
define("CHAT_SERVER_ID", "186411aa-a8c2-4f94-bb55-0562d085d5f0");
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
?>