<?php
namespace Utils;
use Model\User;
use Model\Message;

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
            $users[] = $response;
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
            HttpClient::put($url, $data, $token);
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function loadFriends($username, $token) {
        try {
            $data = HttpClient::get("$this->server/$this->collectionId/user/$username/friends", $token);
            $friends = array();
            foreach ($data as $friend) {
                $friends[] = User::fromJson($friend);
            }
            return $friends;
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendRequest($username, $friend, $token) {
        try {
            $url = "$this->server/$this->collectionId/user/$username/friends/$friend";
            HttpClient::post($url, array(), $token);
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendAccept($username, $friend, $token) {
        try {
            $url = "$this->server/$this->collectionId/user/$username/friends/$friend/accept";
            HttpClient::post($url, array(), $token);
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendDismiss($username, $friend, $token) {
        try {
            $url = "$this->server/$this->collectionId/user/$username/friends/$friend/decline";
            HttpClient::post($url, array(), $token);
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function friendRemove($username, $friend, $token) {
        try {
            $url = "$this->server/$this->collectionId/user/$username/friends/$friend";
            HttpClient::delete($url, $token);
        } catch(\Exception $e) {
            error_log("Authentification failed: $e");
            return false;
        }
    }

    public function getUnreadMessages($username, $token) {
        try {
            $data = HttpClient::get("$this->server/$this->collectionId/user/$username/messages", $token);
            $messages = array();
            foreach ($data as $message) {
                $messages[] = Message::fromJson($message);
            }
            return $messages;
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