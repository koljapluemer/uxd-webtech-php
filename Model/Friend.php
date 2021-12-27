<?php 
    namespace Model;
    use JsonSerializable;

 class Friend implements JsonSerializable {
    public $username;
    public $status;

    public function __construct($username = "Empty Friend", $status = "unknown") {
        $this->username = $username;
        $this->status = $status;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }



    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public static function fromJson($obj) {
        $friend = new Friend();

        foreach ($obj as $key => $value) {
            $friend->{$key} = $value;
        }

        return $friend;
    }

    public function __toString() {
        error_log("friend: " . $this->username . " " . $this->status);
        return "Name: " . $this->username . "; Status: " . $this->status;
    }

 }
?>