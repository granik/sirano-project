<?php

namespace App\Shared\Application\Port;


interface UserPasswordEncoderInterface
{
    public function encodePassword($password);
    
    public function isPasswordValid($user, $password);
}