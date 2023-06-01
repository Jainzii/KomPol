<?php

include "UserDAO.php";

class FileUserDAO implements UserDAO
{

    private $path;

    public function __construct ($path = "../") {
        $this->path = $path;
    }

    function addUser($user) {
        $json = file_get_contents($this->path . "user.json");
        $obj =  json_decode($json);
        $obj[] = $user;
        file_put_contents($this->path . "user.json", json_encode($obj));
    }

    function updateUser($updatedUser) {
        error_reporting(E_ERROR | E_PARSE);
        $json = file_get_contents($this->path . "user.json");
        $obj =  json_decode($json);
        $obj = isset($obj) ? $obj : [];
        foreach ($obj as $user) {
            $id = $user->uuid;
            $otherId = $updatedUser->uuid;
            if ($id === $otherId) {
                $user->email = $updatedUser->email;
                $user->password = $updatedUser->password;
                $user->firstName = $updatedUser->firstName;
                $user->lastName = $updatedUser->lastName;
                $user->avatar = $updatedUser->avatar;
                $user->party = $updatedUser->party;
            }
        }
        file_put_contents($this->path . "user.json", json_encode($obj));
    }

    function loadUserByEmail($email) {
        $json = file_get_contents($this->path . "user.json");
        $obj =  json_decode($json);
        $obj = isset($obj) ? $obj : [];
        foreach ($obj as $user) {
            if ($user->email == $email) {
                return $user;
            }
        }
        return null;
    }

    function loadUserById($uuid) {
        error_reporting(E_ERROR | E_PARSE);
        $json = file_get_contents($this->path . "user.json");
        $obj =  json_decode($json);
        $obj = isset($obj) ? $obj : [];
        foreach ($obj as $user) {
            if ($user->uuid == $uuid) {
                return $user;
            }
        }
        return null;
    }

    function getIdByRegistrationCode($registrationCode) {
        $json = file_get_contents($this->path . "user.json");
        $obj =  json_decode($json);
        $obj = isset($obj) ? $obj : [];
        foreach ($obj as $user) {
            if ($user->registrationCode == $registrationCode) {
                return $user->uuid;
            }
        }
        return null;
    }

}
?>
