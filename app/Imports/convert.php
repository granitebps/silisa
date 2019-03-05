<?php

function dms_to_dec($dms)
{
    $vars = preg_split("/[^\d\w]+/", $dms);
    $deg = (float)$vars[0];
    $min = (float)$vars[1];
    $sec = (float)$vars[2];
    return $deg + ((($min * 60) + ($sec)) / 3600);
}

// function dec_to_dms($dec)
// {
//     $vars = explode(".", $dec);
//     $deg = $vars[0];
//     $tempma = "0." . $vars[1];

//     $tempma = $tempma * 3600;
//     $min = floor($tempma / 60);
//     $sec = $tempma - ($min * 60);

//     return array("deg" => $deg, "min" => $min, "sec" => $sec);
// }

function fix_number($number)
{
    $fix = str_replace(',', '.', $number);
    return $fix;
}
