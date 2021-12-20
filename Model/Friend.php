<?php 
    namespace Model;
    use JsonSerializable;

 class Friend implements JsonSerializable {
    private $username;
    private $status;

    public function __construct($username = null) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getStatus() {
        return $this->status;
    }

    // set status 
    public function setStatus($status) {
        $this->status = $status;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public static function fromJson($obj) {
        $friend = new Friend();

        foreach ($obj as $key => $value) {
            // verwendet key als Zeichenkette
            // für den zugriff auf Attribute
            $friend->{$key} = $value;
        }

        return $friend;
    }

 }
?>