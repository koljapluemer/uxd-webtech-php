<?php
namespace Model;
use JsonSerializable;

class User implements JsonSerializable {

    private $username;
    private $password;
    private $favoriteDinosaur;


    public function __construct($username = null, $password = null, $favoriteDinosaur = "T-Rex?") {
        $this->username = $username;
        $this->password = $password;
        $this->favoriteDinosaur = $favoriteDinosaur;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFavoriteDinosaur() {
        return $this->favoriteDinosaur;
    }

    public function setFavoriteDinosaur($favoriteDinosaur) {
        $this->favoriteDinosaur = $favoriteDinosaur;
    }
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public static function fromJson($obj) {
        $user = new User();

        foreach ($obj as $key => $value) {
            $user->{$key} = $value;
        }
        return $user;
    }

    public function __toString() {
        return "This is " . $this->username . " and his favorite dinosaur is " . $this->favoriteDinosaur;
    }
}
?>