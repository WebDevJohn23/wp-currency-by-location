<?php

//// Get symbol to pass to react API along with country name
function getSymbol($country) {
    static $m = [
        'austria'=>'EUR','belgium'=>'EUR','france'=>'EUR','germany'=>'EUR','greece'=>'EUR',
        'ireland'=>'EUR','italy'=>'EUR','netherlands'=>'EUR','portugal'=>'EUR','spain'=>'EUR',
        'bahrain'=>'BHD','egypt'=>'EGP','kuwait'=>'KWD','oman'=>'OMR','qatar'=>'QAR',
        'saudi arabia'=>'SAR','united arab emirates'=>'AED','switzerland'=>'CHF','turkey'=>'TRY',
        'united kingdom'=>'GBP','united states'=>'USD'
    ];
    return $m[strtolower($country)] ?? 'USD';
}

//Get IP address
function getVisIpAddr() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


add_shortcode('getPriceTable', 'getpriceTable');

function getPrice1(){
    $arr = getPriceTable();
    $oneMonth = $arr['data']['oneMonth'];
    return $oneMonth;
}

add_shortcode('getPrice1', 'getPrice1');

function getPrice2(){
    $arr = getPriceTable();
    $twoMonths = $arr['data']['twoMonths'];
    return $twoMonths;
}

add_shortcode('getPrice2', 'getPrice2');

function getPrice3(){
    $arr = getPriceTable();
    $threeMonths = $arr['data']['threeMonths'];
    return $threeMonths;
}

add_shortcode('getPrice3', 'getPrice3');

function getSymbol1(){
    $countryName = getCountry();
    $symbol = getSymbol($countryName);
    return $symbol;
}

add_shortcode('getSymbol1', 'getSymbol1');

function getButton1(){
    $countryName = getCountry();
    return '<a class="elementor-price-table__button elementor-button elementor-size-md" href="http://nourish.believenutrition.net/subscribeInfo/1%20Month%20Plan/' . $countryName . '">Sign-up</a>';
}

add_shortcode('getButton1', 'getButton1');

function getButton2(){
    $countryName = getCountry();
    return '<a class="elementor-price-table__button elementor-button elementor-size-md" href="http://nourish.believenutrition.net/subscribeInfo/2%20Month%20Plan/' . $countryName . '">Sign-up</a>';
}

add_shortcode('getButton2', 'getButton2');

function getButton3(){
    $countryName = getCountry();
    return '<a class="elementor-price-table__button elementor-button elementor-size-md" href="http://nourish.believenutrition.net/subscribeInfo/3%20Month%20Plan/' . $countryName . '">Sign-up</a>';
}

add_shortcode('getButton3', 'getButton3');

