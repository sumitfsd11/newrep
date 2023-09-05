<?php

use App\Models\User;

if (! function_exists('auther')) {
    function auther(): User
    {
        return auth()->user();
    }
}
