<?php

use Illuminate\Support\Facades\Log;

if (!function_exists('hasAdmin')) {
    function hasAdmin()
    { 
        return auth_user_role()->permissions['is_admin'] ?? false;
    }
}