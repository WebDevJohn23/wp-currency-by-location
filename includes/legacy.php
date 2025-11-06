<?php

/** ------------------------------
 * LEGACY BUTTON SHORTCODES
 * No longer used. API endpoint no longer working. Kept for reference only.
 * To reactivate: uncomment add_shortcode() lines.
 * ------------------------------ */

function getPriceTable()
{

    global $countryName;

    $countryName = getCountry();
    $symbol = getSymbol($countryName);
    if ($symbol === "USD") {
        $countryName = "United States of America";
    }

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
//add_shortcode('getPriceTable', 'getpriceTable');

function getPrice1()
{
    $arr = getPriceTable();
    return $arr['data']['oneMonth'];
}
//add_shortcode('getPrice1', 'getPrice1');

function getPrice2()
{
    $arr = getPriceTable();
    return $arr['data']['twoMonths'];
}
//add_shortcode('getPrice2', 'getPrice2');

function getPrice3()
{
    $arr = getPriceTable();
    return $arr['data']['threeMonths'];
}
//add_shortcode('getPrice3', 'getPrice3');

function getButton1()
{
    $countryName = getCountry();
    return '<a class="elementor-price-table__button elementor-button elementor-size-md" href="http://nourish.believenutrition.net/subscribeInfo/1%20Month%20Plan/' . $countryName . '">Sign-up</a>';
}
//add_shortcode('getButton1', 'getButton1');

function getButton2()
{
    $countryName = getCountry();
    return '<a class="elementor-price-table__button elementor-button elementor-size-md" href="http://nourish.believenutrition.net/subscribeInfo/2%20Month%20Plan/' . $countryName . '">Sign-up</a>';
}
//add_shortcode('getButton2', 'getButton2');

function getButton3()
{
    $countryName = getCountry();
    return '<a class="elementor-price-table__button elementor-button elementor-size-md" href="http://nourish.believenutrition.net/subscribeInfo/3%20Month%20Plan/' . $countryName . '">Sign-up</a>';
}
//add_shortcode('getButton3', 'getButton3');


/*
Class Elementor_Server_Var_Tag extends \Elementor\Core\DynamicTags\Tag {

    public function get_name() {
        return 'price-variable';
    }

    public function get_title() {
        return __( 'Price Variable', 'elementor-pro' );
    }

    public function get_group() {
        return 'request-variables';
    }

    public function get_categories() {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    protected function _register_controls() {

        $this->add_control(
            'Price',
            [
                'label' => __( 'Price', 'elementor-pro' ),
                'type' => 'text',
            ]
        );
    }


    public function render() {
        global $countryName;
        $fields = $this->get_settings( 'Price' );

        if($countryName === 'North America')
        {
            $symbol = 'USD $';
        $price2 = round($fields * 3.30,2);
    }
        else{
            $symbol = 'N/A';
        $price2 = 'N/A';
        }

        $value = "2233";
        $final = '<sup>' . $symbol . '</sup>' . $price2;

        echo wp_kses_post( $final );
    }
}

add_action( 'elementor/dynamic_tags/register_tags', function( $dynamic_tags ) {
    // In our Dynamic Tag we use a group named request-variables so we need
    // To register that group as well before the tag
    \Elementor\Plugin::$instance->dynamic_tags->register_group( 'request-variables', [
        'title' => 'Request Variables'
    ] );

    // Include the Dynamic tag class file
    include_once( 'path/to/dynamic/tag/class/file' );

    // Finally register the tag
    $dynamic_tags->register_tag( 'Elementor_Server_Var_Tag' );
} );
*/
