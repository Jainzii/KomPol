<?php

class User {
    private $uuid;
    private $firstName;
    private $lastName;
    private $registrationCode;
    private $email;
    private $password;
    private $avatar;
    private $party;

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}

?>