<?php

namespace App\Helpers;

class PasswordHelper
{
    public static function generateSecurePassword($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $charactersLength - 1)];
        }
        
        return $password;
    }
}
