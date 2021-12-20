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
define("CHAT_SERVER_ID", "8595c8a0-6660-4086-9b2b-96af1b0e50d0");
define("DEFAULT_TOKEN", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjM3MTYxNzg1fQ.SJ8AsLx1V5S7I_NzAE2JyOF4dc1743HcvN852TkZiDE");
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
?>