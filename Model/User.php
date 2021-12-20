<?php
namespace Model;
use JsonSerializable;

class User implements JsonSerializable {
    private $username;
    // ggf. weitere Attribute, z.B. description, layout optionen...

    public function __construct($username = null) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public static function fromJson($obj) {
        $user = new User();

        foreach ($obj as $key => $value) {
            // verwendet key als Zeichenkette
            // für den zugriff auf Attribute
            $user->{$key} = $value;
        }

        return $user;
    }

    // public function toJson() { manuell, nicht nötig...!
    //     return "{\"username\": \"$this->username\"}";
    // }
}
?>