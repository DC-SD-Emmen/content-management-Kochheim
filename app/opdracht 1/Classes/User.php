<?php

class User{
    private $username;
    private $password;
}


function set_username($username) {
    $this->username = $username;
}
function get_username() {
    return $this->username;
}

function set_password($password) {
    $this->password = $password;
}
function get_password() {
    return $this->password;
}