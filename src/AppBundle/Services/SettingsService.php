<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/23/2018
 * Time: 11:46 AM
 */

namespace AppBundle\Services;


class SettingsService
{
    public function setValue($paramName, $value) {
        echo 'Setting of param '.$paramName. ' ' . $value;
    }

    public function getValue($paramName, $defaultValue = null) {
        return $this->generateRandomString(10);
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}