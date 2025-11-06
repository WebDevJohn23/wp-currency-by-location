<?php
require_once('functions.php');

define("VERIFICATIONKEY", "country_via_ip_ipstack_key");

// create an option array
$arrOption = get_option(VERIFICATIONKEY);
if (!(is_array($arrOption))) {
    $arrOption = array(
            "tab1" => array(),
            "tab2" => array(),
            "tab3" => array()
    );
    update_option(VERIFICATIONKEY, $arrOption);
}

// admin menu
add_action('admin_menu', 'wp_currency_by_location_adminmenu');
function wp_currency_by_location_adminmenu()
{
    add_options_page('WP Currency by Location', 'WP Currency by Location', 'manage_options', 'wp_currency_by_location_admin_menu', 'wp_currency_by_location_adminpage');
}

// admin page
function wp_currency_by_location_adminpage()
{
    global $countryName;
    global $updated;
    $options = get_option(VERIFICATIONKEY);
    // print_r($_POST); // for debugging
    echo '<br />';
    if (isset($_POST[VERIFICATIONKEY]['tab1']['submitted']) && $_POST[VERIFICATIONKEY]['tab1']['submitted'] == 1) {
        $ipstack_api_key_0 = $_POST[VERIFICATIONKEY]['tab1']['ipstack_api_key_0'];
        $ipdat = @json_decode(file_get_contents("http://api.ipstack.com/1.1.1.1?access_key=" . $ipstack_api_key_0));
        if (strlen(trim($_POST[VERIFICATIONKEY]['tab1']['ipstack_api_key_0'])) == 0) {
            $options['tab1']['invalid'] = true;
            $updated = 1;
            echo '<div class="error settings-error"><p>Options are not saved.</p></div>';
        } elseif (!isset($ipdat->country_name)) {
            $options['tab2']['invalid'] = true;
            $updated = 2;
            echo '<div class="error settings-error"><p>Options are not saved.</p></div>';
        } else {
            $countryName = $ipdat->country_name;
            $options = array_merge($options, $_POST[VERIFICATIONKEY]);
            update_option(VERIFICATIONKEY, $options);
            echo '<div class="updated"><p>Updates are saved.</p></div>';
        }
    }
    echo $vis_ip = getVisIPAddr() . "hello";
    $name = "Netherlands";
    echo $syb = getSymbol($name);
    ?>
    <div class="wrap">
        <h2>Country via IP Address Settings API</h2>
        <form method="post" action="">
            <input type="hidden" name="<?php echo VERIFICATIONKEY; ?>[tab1][submitted]" value="1"/>
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">ipstack API Access Key</th>
                    <td>
                        <label>
                            <input
                                    name="<?php echo VERIFICATIONKEY; ?>[tab1][ipstack_api_key_0]" size="40" type="text"
                                    value="<?php echo $options['tab1']['ipstack_api_key_0']; ?>"/>
                        </label>
                        <?php echo $updated === 1 ? '<br /><span style="color:red">* cannot be blank.</span>' : '' ?>
                        <?php echo $updated === 2 ? '<br /><span style="color:red">* Key entered is not valid.</span>' : '' ?>


                    </td>
                </tr>

                </tbody>
            </table>
            <span>*You will need to get an API Access Key from ipstack.com. You can sign up here: <a
                        href="https://ipstack.com/" target="_blank"> ipstack</a></span>

            <?php submit_button(); ?>
        </form>
        Shortcode: [ipCountry]
    </div>
<?php }
