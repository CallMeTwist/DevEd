<?php

/**
 * This is my custom helper function
 * Laravel keeps resetting it's global helper file
 * So I opened a new file of my own, damn you Laravel!
 */


use App\Models\Settings;

if (! function_exists('get_settings')) {
    /**
     * @return mixed
     */
    function get_settings()
    {
        return optional(Settings::first());
    }
}

if (! function_exists('slug_reverse')) {
    /**
     * @param $string
     * @return string
     */
    function slug_reverse($string)
    {
        return title_case(str_replace('-', ' ', $string));
    }
}

if (! function_exists('me')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function me()
    {
        return auth()->user();
    }
}
