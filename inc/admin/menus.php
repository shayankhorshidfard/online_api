<style>
    .taga {
        padding: 10px;
        background-color: orange;
        color: white;
        font-size: 20px;
        border-radius: 5px;
        direction: rtl;
    }
</style>
<?php
//add action
add_action('admin_menu', 'wp_apis_register_menus');
//functions
function wp_apis_register_menus()
{
    add_menu_page(
        'پلاگین API',
        'اطلاعات',
        'manage_options',
        'wp_apis_admin',
        'wp_apis_main_menu_handler'


    );

    add_submenu_page(
        'wp_apis_admin',
        'تنظیمات',
        'تنظیمات',
        'manage_options',
        'wp_apis_general',
        'wp_apis_general_page'
    );
}

//end function wp_apis_register_menus
function wp_apis_main_menu_handler()
{
    global $wpdb;

    @$action = $_GET['action'];

    if ($action == "delete") {
        $item = intval($_GET['item']);
        if ($item > 0) {
            $wpdb->delete($wpdb->prefix . 'apinews', ['id' => $item]);
        }
    }
    if ($action == "add") {
        if (isset($_POST['saveData'])) {
            $wpdb->insert($wpdb->prefix . 'apinews', [
                'name_office' => $_POST['name_office'],
                'api_address' => $_POST['api_address'],
            ]);
        }
        include WP_APIS_TPL . 'admin/menus/add.php';
    } else {
        $samples = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}apinews");
        include WP_APIS_TPL . 'admin/menus/main.php';
    }


}

function wp_apis_general_page()
{
    if (isset($_POST['savesettings'])) {
        if (isset($_POST['is_plugin_active'])) {
            update_option('wp_apis_is_active', 1);
        } else {
            delete_option('wp_apis_is_active', 0);
        }

    }
    $current_plugin_status = get_option('wp_apis_is_option', 0);
    include WP_APIS_TPL . 'admin/menus/general.php';

}

function wp_apis_users_page()
{
    global $wpdb;
    if (isset($_GET['action']) && $_GET['action'] = 'edit')
    {
        $userID = intval($_GET['id']);
        if (isset($_POST['saveUserInfo'])) {
            $mobile = $_POST['name_office'];
            $wallet = $_POST['api_address'];

            if (!empty($mobile)) {
                update_user_meta($userID,'name_office',$mobile);
            }
            if(!empty($wallet))
            {
                update_user_meta($userID,'api_address',$wallet);
            }
        }


        $mobile = get_user_meta($userID, 'name_office', true);
        $wallet = get_user_meta($userID, 'api_address', true);
        include WP_APIS_TPL . 'admin/menus/users/edit.php';
        return;

    }

    if (isset($_GET['action']) && $_GET['action'] == 'removeMobileAndWallet')
    {
        $userID = intval($_GET['id']);
        delete_user_meta($userID,'name_office');
        delete_user_meta($userID,'api_address');
    }
    $users = $wpdb->get_results("SELECT id,name_office,api_address FROM {$wpdb->apinews}");
    include WP_APIS_TPL . 'admin/menus/users/users.php';
}