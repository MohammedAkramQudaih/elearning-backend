<?php

if (!function_exists('jsonToArray')) {
    function jsonToArray($data)
    {
        if (is_array($data)) {
            return $data;
        }
        
        if (is_string($data)) {
            $decoded = json_decode($data, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        return [];
    }
}