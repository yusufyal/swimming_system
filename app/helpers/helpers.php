<?php
if (!function_exists('active_class')) {
    function active_class($routeNames)
    {
        return request()->routeIs($routeNames) ? 'active' : '';
    }
}
