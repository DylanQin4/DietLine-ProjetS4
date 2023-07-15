<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('formatFrenchDate')) {
    function formatFrenchDate($date) {
        $timestamp = strtotime($date);
        $formattedDate = date('d F Y', $timestamp);
        return $formattedDate;
    }
}
