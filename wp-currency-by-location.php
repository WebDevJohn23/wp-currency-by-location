<?php

/**
 * Plugin Name: WP Currency by Location
 * Plugin URI:  https://github.com/YOURUSER/wp-currency-by-location
 * Description: Detects user location via IP and applies automatic currency + pricing adjustments. Based on original "Country Code via IP Address" plugin (V2).
 * Version:     3.0.0
 * Author:      Johnathan Julig
 * Author URI:  https://yourwebsite.com
 * License:     GPL-2.0-or-later
 * Text Domain: wp-currency-by-location
 */

require_once('includes/functions.php');
require_once('includes/settings.php');

function wp_currency_by_location_settings_link($links)
{
    $settings_link = '<a href="options-general.php?page=wp_currency_by_location_admin_menu">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'wp_currency_by_location_settings_link');


$baseurl = home_url();

function getCountry()
{
    $name = "Netherlands";
    if (isset($_GET['country'])) {
        $country1 = $_GET['country'];
        return $country1;
    } else { /*
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
 */
        return $name;
        //echo $data = json_decode($ipdat);
    }
}
add_shortcode('ipCountry', 'getCountry');
