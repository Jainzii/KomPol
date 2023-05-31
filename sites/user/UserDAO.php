<?php

interface UserDAO
{

    function addUser($user);
    function updateUser($user);
    function loadUserByEmail($email);
    function loadUserById($uuid);
    function getIdByRegistrationCode($registrationCode);

}