<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('check_verification')) {
    function check_verification()
    {
        $user = Auth::user();
        if ($user->is_verified == 0) {
            return redirect()->route('setup');
        }
    }
}
