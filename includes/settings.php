<?

define("VerificationKey", "country_via_ip_ipstack_key");

// create an option array
$arrOption = get_option(VerificationKey);
if (!(is_array($arrOption))) {
    $arrOption = array(
        "tab1" => array(),
        "tab2" => array(),
        "tab3" => array()
    );
    update_option(VerificationKey, $arrOption);
}

// admin menu
add_action('admin_menu', 'wp_currency_by_location_adminmenu');
function wp_currency_by_location_adminmenu() {
    add_options_page('WP Currency by Location', 'WP Currency by Location', 'manage_options', 'wp_currency_by_location_admin_menu', 'wp_currency_by_location_adminpage');
}
// admin page
function wp_currency_by_location_adminpage() {
    global $countryName;
    global $updated;
    $options = get_option(VerificationKey);
    // print_r($_POST); // for debugging
    echo '<br />';
    if(isset($_POST[VerificationKey]['tab1']['submitted']) && $_POST[VerificationKey]['tab1']['submitted'] == 1){
        $ipstack_api_key_0 = $_POST[VerificationKey]['tab1']['ipstack_api_key_0'];
        $ipdat = @json_decode(file_get_contents( "http://api.ipstack.com/1.1.1.1?access_key=" . $ipstack_api_key_0));
        if (strlen(trim($_POST[VerificationKey]['tab1']['ipstack_api_key_0'])) == 0) {
            $options['tab1']['invalid'] = True;
            $updated = 1;
            echo '<div class="error settings-error"><p>Options are not saved.</p></div>';
        } else if (!isset($ipdat->country_name)){
            $options['tab2']['invalid'] = True;
            $updated = 2;
            echo '<div class="error settings-error"><p>Options are not saved.</p></div>';
        }
        else {
            $countryName = $ipdat->country_name;
            $options = array_merge($options, $_POST[VerificationKey]);
            update_option(VerificationKey, $options);
            echo '<div class="updated"><p>Updates are saved.</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <?php screen_icon(); ?> <h2>Country via IP Address Settings API</h2>
        <form method="post" action="">  <?php // 'action=""' means to send the form post data to this page itself. ?>
            <input type="hidden" name="<?php echo VerificationKey; ?>[tab1][submitted]" value="1" />
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">ipstack API Access Key</th>
                    <td>
                        <input name="<?php echo VerificationKey; ?>[tab1][ipstack_api_key_0]" size="40" type="text" value="<?php echo $options['tab1']['ipstack_api_key_0']; ?>" />
                        <?php echo $updated === 1 ? '<br /><span style="color:red">* cannot be blank.</span>' :'' ?>
                        <?php echo $updated === 2 ? '<br /><span style="color:red">* Key entered is not valid.</span>' :'' ?>


                    </td>
                </tr>

                </tbody>
            </table>
            <span>*You will need to get an API Access Key from ipstack.com. You can sign up here: <a href="https://ipstack.com/" target="_blank"> ipstack</a></span>

            <?php submit_button(); ?>
        </form>
        Shortcode: [ipCountry]
    </div>
    <?php

}

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