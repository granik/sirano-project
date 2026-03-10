<?php

namespace App\Modules\Identity\Repository;


class UserDto
{
    public $login;
    public $password;
    public $isAdmin;
    public $customerId;
    public $activationCode;
    public $addedFrom;
    public $isActive = false;
}