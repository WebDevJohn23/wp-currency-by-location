<?php
require_once ('functions.php');
/*
Plugin Name: Country Code via IP Address - V2
Description: Plugin to get the country code based off users IP address.
Version: 2.0
Author: Johnathan Julig
License: GPLv2 or later
Text Domain: countryIPaddress
*/


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function my_plugin_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=country_ip_admin_menu">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'my_plugin_settings_link' );


require_once('settings.php');

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
  $baseurl = home_url();

  function getCountry()
  {
      $name = "United States";
      if (isset($_GET['country'])) {
          $country1 = $_GET['country'];
          return $country1;

      } else {
          // Store the IP address
          $vis_ip = getVisIPAddr();
         // $vis_ip = '51111.3.0.0'; // test
         // $vis_ip = '168.187.0.0'; // Kuwait
         // $vis_ip = '2.50.33.162'; // Dubai
          $country_by_ip_settings_options = get_option('country_via_ip_ipstack_key'); // Array of All Options
          $ipstack_api_key_0 = $country_by_ip_settings_options['tab1']['ipstack_api_key_0']; // IPStack API Key

          // Use JSON encoded string and converts it into a PHP variable
          $ipdat = @json_decode(file_get_contents("http://api.ipstack.com/" . $vis_ip . "?access_key=" . $ipstack_api_key_0));
          if (!isset($ipdat->success) === false) {
              echo "<p style='color:red'>[*Plugin not configured yet. Access Key not detected]. </p>";
          } else if (!isset($ipdat->country_name)) {
              //echo "<p style='color:red'>Country Not Detected</p>";
          }
          else {
             $name = $ipdat->country_name;
          }
          if($name === "United States" || $name === "null" || is_null($name))
          {
              $name = "United States of America";
          }
          return $name;
          //echo $data = json_decode($ipdat);
      }

  }
add_shortcode('ipCountry', 'getCountry');

function getPriceTable(){

    global $countryName;

    $countryName = getCountry();
    $symbol = getSymbol($countryName);
    if( $symbol === "USD")
    {$countryName = "United States of America"; }

    $url = 'https://nourish.believenutrition.net/api/countries/getCountry';
    $data = array("country" => $countryName, "currency" => $symbol);

    $postdata = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);

    $arr = json_decode($result, true);
    if ($arr['success'] === false) { /* Handle error */
         $countryName = "United States of America";
        $symbol = "USD";

        $url = 'https://nourish.believenutrition.net/api/countries/getCountry';
        $data = array("country" => $countryName, "currency" => $symbol);

        $postdata = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        $arr = json_decode($result, true);
       $oneMonth = $arr['data']['oneMonth'];
        $twoMonths = $arr['data']['twoMonths'];
        $threeMonths = $arr['data']['threeMonths'];
        //return $oneMonth . " " . $twoMonths . " " . $threeMonths;
 return $arr;

    } else {

        return $arr;

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

