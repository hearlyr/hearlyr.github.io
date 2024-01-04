<?php

namespace App\Validation;

use App\Models\AdminModel;

class valid
{
    function pw_verif(string $str, string &$error = null): bool
    {
        $admM = new AdminModel();
        if (empty($str)) {
            return true;
        }
        $usern = session()->get('username');
        $adm = $admM->getData($usern);
        $pwuser = $adm['password'];
        if (password_verify($str, $pwuser)) {
            return true;
        } else {
            return false;
        }
    }
}
