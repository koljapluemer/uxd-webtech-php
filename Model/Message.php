<?php 
namespace Model;
use JsonSerializable;

class Message implements JsonSerializable {
    private $username;
    private $message;
    private $timestamp;

    public function __construct($username = null, $message = null, $timestamp = null) {
        $this->username = $username;
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public static function fromJson($obj) {
        $message = new Message();

        foreach ($obj as $key => $value) {
            // verwendet key als Zeichenkette
            // für den zugriff auf Attribute
            $message->{$key} = $value;
        }

        return $message;
    }
}