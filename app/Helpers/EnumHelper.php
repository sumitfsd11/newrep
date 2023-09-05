<?php

namespace App\Helpers;

use App\Models\User;

class EnumHelper
{
    /** Values */
    public static function v(array $e): array
    {
        return array_column($e, 'value');
    }

    /** Keys */
    public static function k(array $e): array
    {
        return array_column($e, 'name');
    }

    /** Keys => Values */
    public static function kv(array $e): array
    {
        return array_column($e, 'value', 'name');
    }

    /** Values => Keys */
    public static function vk(array $e): array
    {
        return array_column($e, 'name', 'value');
    }
}

if (! function_exists('auther')) {
    function auther(): User
    {
        return auth()->user();
    }
}

if (! function_exists('urlSafeHashMake')) {
    /**
     * Generate a hashed string that is URL save
     *
     * @param  string  $string The string to hash
     * @return string         Hashed string
     */
    function urlSafeHashMake($string)
    {
        return strtr(base64_encode($string), '+/=', '-_,');
    }
}

if (! function_exists('urlSafeHashDecode')) {
    /**
     * Decode a URL safe hash string
     *
     * @param  string  $string The string to decipher
     * @return string         The deciphered string
     */
    function urlSafeHashDecode($string)
    {
        return base64_decode(strtr($string, '-_,', '+/='));
    }
}
