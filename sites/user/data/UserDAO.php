<?php

namespace sites\user\data;

interface UserDAO
{

    function registerUserWithCode($user);
    function registerUserWithoutCode($user);
    function updateUser($user);
    function loadUserByEmail($email);
    function loadUserById($uuid);
    function getUserByRegistrationCode($registrationCode);

}