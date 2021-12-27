<?php
namespace Utils;
use Model\User;
use Model\Message;
use Model\Friend;

class BackendService {
    private $server;
    private $collectionId;

    public function __construct($server, $collectionId) {
        $this->server = $server;
        $this->collectionId = $collectionId;
    }

    public function getAllUsers() {
        $url = "$this->server/$this->collectionId/user";
        $response = HttpClient::get($url, DEFAULT_TOKEN);
        $users = array();
        foreach ($response as $user) {
            $users[] = $user;
        }
        return $users;
    }

    public function register($username, $password) {
        try {
            // Utils Prefix nicht notwendig
            $url = "$this->server/$this->collectionId/register";
            // Fleißaufgabe, LoginData als Klasse in Model beschreiben, in Anlehnung an User, zweit Attribute, die JSON-Serialisierung usw.
            $data = array("username" => $username, "password" => $password);
            $result = HttpClient::post($url, $data);
            // Wichtig: Verzichten Sie auf "echo"-Anweisungen im BackendService!
            // Tipp: Fehler mit error_log();
            return $result->token;
        } catch(\Exception $e) {
            // error_log landet im XAMPP logs/php-error-log
            error_log("Authentification failed: $e");
            return false;
        }
    }
    public function login($username, $password) {
        try {
            $url = "$this->server/$this->collectionId/login";
            $data = array("username" => $username, "password" => $password);
            $result = HttpClient::post($url, $data);
            return $result->token;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }
    public function exists($username) {
        try {
            HttpClient::get("$this->server/$this->collectionId/user/$username");
            return true;
        } catch(\Exception $e) {
            // immer aufgerufen, wenn kein HTTP-Status 200 oder 204
            error_log("Authentification failed: $e");
            return false;
        }
    }
    public function loadUser($username, $token) {
        try {
            $data = HttpClient::get("$this->server/$this->collectionId/user/$username", $token);
            $user = User::fromJson($data);
            return $user;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    // CUSTOM IMPLEMENTATIONS, NOT TESTED YET
    public function saveUser(User $user, $token) {
        try {
            $url = "$this->server/$this->collectionId/user/" . $user->getUsername();
            $data = $user->jsonSerialize();

            $response = HttpClient::post($url, $data, $token);
            $user = User::fromJson($response);
            return $user;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
        }
    }

    public function loadFriends($token) {
        try {
            $data = HttpClient::get("$this->server/$this->collectionId/friend", $token);
            $friends = array();
            error_log("DEBUG loadFriends: " . print_r($data, true));
            foreach ($data as $friend) {
                $friends[] = Friend::fromJson($friend);
            }
            return $friends;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendRequest(Friend $friend, $token) {
        try {
            $data = HttpClient::post("$this->server/$this->collectionId/friend", array("username" => $friend->getUsername()), $token);
            return true;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendAccept(Friend $friend, $token) {
        try {
            $url = "$this->server/$this->collectionId/friend/" . $friend->getUsername();
            HttpClient::put($url, array("status" => $friend->getStatus()), $token);
            return true;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendDismiss(Friend $friend, $token) {
        try {
            $url = "$this->server/$this->collectionId/friend/" . $friend->getUsername();
            HttpClient::put($url, array("status" => $friend->getStatus()), $token);
            return true;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }


    public function friendRemove(Friend $friend, $token) {
        try {
            // get username from friend object
            $friend_name = $friend->getUsername();
            $url = "$this->server/$this->collectionId/friend/$friend_name";
            error_log("<br><br>LOG: Attempting to remove friend: $friend_name with url: $url<br><br>");
            HttpClient::delete($url, $token);
            return true;
        } catch(\Exception $e) {
            error_log("<br><br>Friend Remove/Authentification failed: $e<br><br>");
            return false;
        }
    }

    public function getUnreadMessages($token) {
        try {
            $data = HttpClient::get("$this->server/$this->collectionId/unread", $token);
            return $data;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function test() {
        try {
            return HttpClient::get($this->base . '/test.json');
        } catch(\Exception $e) {
            error_log($e);
        }
        return false;
    }
}