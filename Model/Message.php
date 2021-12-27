<?php 
namespace Model;
use JsonSerializable;

class Message implements JsonSerializable {
    private $to;
    private $message;
    public $timestamp;
    public $msg;

    public function __construct($to=null, $message = null, $timestamp = null) {
        $this->to = $to;
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    public function getTo() {
        return $this->to;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function getMsg() {
        return $this->msg;
    }

    #[\ReturnTypeWillChange]
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

    public function __toString() {
        return "To: " . $this->to . "; Message: " . $this->message . "; Timestamp: " . $this->timestamp;
    }
}