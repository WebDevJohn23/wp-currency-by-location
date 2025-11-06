<?php

//// Get symbol to pass to react API along with country name
function getSymbol($country)
{
    static $m = [
        'austria' => 'EUR','belgium' => 'EUR','france' => 'EUR','germany' => 'EUR','greece' => 'EUR',
        'ireland' => 'EUR','italy' => 'EUR','netherlands' => 'EUR','portugal' => 'EUR','spain' => 'EUR',
        'bahrain' => 'BHD','egypt' => 'EGP','kuwait' => 'KWD','oman' => 'OMR','qatar' => 'QAR',
        'saudi arabia' => 'SAR','united arab emirates' => 'AED','switzerland' => 'CHF','turkey' => 'TRY',
        'united kingdom' => 'GBP','united states' => 'USD'
    ];
    return $m[strtolower($country)] ?? 'USD';
}

//Get IP address
function getVisIpAddr()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
/*
function getSymbol1()
{
    $countryName = 'Netherlands';
    return getSymbol($countryName);
}
//add_shortcode('getSymbol1', 'getSymbol1');
*/