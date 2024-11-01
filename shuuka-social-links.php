<?php

/*
Plugin Name: Shuuka social links
Description: Display your shuuka list on your own page. Use one nickname for all your network.
Version: 1.0.0
Author: shuuka.com
Author URI: https://shuuka.com
Text Domain: shuuka-social-links
Requires at least: 4.0.0
Tested up to:      5.3.2
Requires PHP:      5.4.45
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
*/
require_once "vendor/index.php";
global $shuuka_pluginUrl;
$shuuka_pluginUrl = plugin_dir_url(__FILE__);
$shuuka_pluginDir = plugin_dir_path(__FILE__);
ReduxFrameworkPlugin::instance();

/**
 * 
 * GET UPDATE
 * 
 */
// require 'plugin-update-checker/plugin-update-checker.php';
// $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
// 	'http://ideastudio.ch/plugin/details.json',
// 	__FILE__, //Full path to the main plugin file or functions.php.
// 	'shuuka-social-links'
// );
/**
 * 
 * GET USER INFO FROM SHUUKA
 * 
 */
function shuuka_before_user_page_render()
{
    global $shuuka_user_page_setting;
    $data_api = "https://api.shuuka.com/v1/user/data";
    $secretKey = $shuuka_user_page_setting['secret-key'];
    $url = $data_api . "?secreteKey=${secretKey}";
    $response = SHUUKA_REQUEST::post($url);
    if ($response->status_code !== 200) {
        throw new Exception(json_decode($response->body)->res);
    }
    return json_decode($response->body)->res;
}
/**
 * 
 * CREATE PAGE TO SHOW LIST
 * 
 */
function shuuka_create_page_template()
{
    $template = new SHUUKA_PAGE_TEMPLATE('Shuuka links Template', 'shuuka-social-links-template', SHUUKAGetPluginFilePath('shuuka-social-links', 'templates/shuuka-social-links-template.php'));
    $template->init();
}

/**
 * 
 * SET ADMIN SETTING VIEW
 * 
 */
function shuuka_generateAdminSetting()
{
    if (!class_exists('Redux')) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "shuuka_user_page_setting";
    $display_name = "Shuuka links";
    $text_domain = "shuuka-social-links";
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name' => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name' => $display_name,
        // Version that appears at the top of your panel
        'menu_type' => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu' => true,
        // Show the sections below the admin menu item or not
        'menu_title' => __($display_name, $text_domain),
        'page_title' => __($display_name, $text_domain),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key' => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography' => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar' => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon' => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority' => 50,
        // Choose an priority for the admin bar menu
        'global_variable' => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode' => false,
        // Show the time the page took to load, etc
        'update_notice' => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer' => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority' => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent' => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions' => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon' => plugin_dir_url(__FILE__).'/assets/menu-icon.svg',
        // Specify a custom URL to an icon
        'last_tab' => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon' => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug' => 'shuuka_options',
        // Page slug used to denote the panel
        'save_defaults' => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show' => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark' => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export' => false,
        // Shows the Import/Export panel when not used as a field.
        'hide_reset' => true,
        // CAREFUL -> These options are for advanced use only
        'transient_time' => 60 * MINUTE_IN_SECONDS,
        'output' => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database' => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn' => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
                'shadow' => true,
                'rounded' => false,
                'style' => '',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'click mouseleave',
                ),
            ),

        )
    );



    Redux::setArgs($opt_name, $args);

    /**
     * SET SECRETE KEY
     */
    $shuuka_secreteKey = Redux::getOption ($opt_name, 'secret-key');
    $secreteKey_desc = __('Please enter the secret key', $text_domain);
    if(!empty($shuuka_secreteKey)){
        $secreteKey_desc = '';
    }

    /**
     * SET SLUG
     */
    $shuuka_slug = Redux::getOption ($opt_name, 'slug-string');
    $slug_subtitle= (isset($shuuka_slug)) ? 'Your link: <a target="_blank" href="'.$_SERVER['HTTP_HOST'].'/'.$shuuka_slug.'">'.$_SERVER['HTTP_HOST'].'/'.$shuuka_slug.'</a>' : '';

    $slug_desc = __('Please enter the slug of the new page', $text_domain);
    if(!empty($shuuka_slug)){
        $slug_desc= '';
    }

    /**
     * SET GOOGLE ANALYTIC VAR
     */
    function isAnalytics($str){ return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', strval($str)); }
    global $shuuka_gl_analytic;
    $shuuka_gl_analytic = Redux::getOption ($opt_name, 'google-analytic-code');
    $gl_analytic_desc = __('Input value for Google Analytic UA Code', $text_domain);
    if(!empty($shuuka_gl_analytic)){
        $gl_analytic_desc= (isAnalytics($shuuka_gl_analytic)) ? '' : '<span style="color:#f00">Google UA code is not valid</span>';
    }

    /**
     * SET FB PIXEL VAR
     */
    global $shuuka_fb_pixel;
    $shuuka_fb_pixel = Redux::getOption ($opt_name, 'facebook-pixcel');
    $fb_pixel_desc = __('Input value for Facebook Pixel', $text_domain);
    if(!empty($shuuka_fb_pixel)){
        $fb_pixel_desc = '';
    }

    /**
    * ADD INPUT
    */
    Redux::setSection($opt_name, array(
        'id' => 'settings',
        'title' => __('Settings', $text_domain),
        'subtitle' => "das ist ein test",
        'icon' => 'el el-home',
        'fields' => array(
            array(
                'id' => 'secret-key',
                'type' => 'password',
                'title' => __('Secret Key', $text_domain),
                'subtitle' => 'You can find the api key in your shuuka profil <a target="_blank" href="https://www.shuuka.com/de/user/update/settings">here</a>.',
                'desc' => $secreteKey_desc,
            ),
            array(
                'id' => 'slug-string',
                'type' => 'text',
                'title' => __('Page Slug', $text_domain),
                'subtitle' => $slug_subtitle,
                'desc' => $slug_desc,
            ),
            array(
                'id' => 'google-analytic-code',
                'type' => 'text',
                'title' => __('Google Analytic Code', $text_domain),
                'desc' => $gl_analytic_desc,
            ),
            array(
                'id' => 'facebook-pixcel',
                'type' => 'text',
                'title' => __('Facebook-Pixel', $text_domain),
                'desc' => $fb_pixel_desc,
            )
        )
    ));
}

/**
 * GET SHUUKA PAGE SLUG
 */
function get_page_by_slug($page_slug)
{
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page;
    } else {
        return null;
    }
}
/**
 * GET SHUUKA CUSTUM PAGE
 */
function get_exists_custom_page()
{
    return get_posts(array(
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => 'shuuka-social-links-template',
        'hierarchical' => 0,
    ));
}

/**
 * ON FORM SAVE
 */
function on_form_save_data($data)
{
    $slugOption = $data['slug-string'];
    $page = get_page_by_slug($slugOption);
    if ($page) {
        $pageTemplate = get_post_meta($page->ID, '_wp_page_template', true);
        if ($pageTemplate == 'shuuka-social-links-template') {
            return;
        } else {
            update_post_meta($page->ID, '_wp_page_template', 'shuuka-social-links-template');
        }
    } else {
        $existedPages = get_exists_custom_page();
        foreach ($existedPages as $existedPage) {
            wp_delete_post($existedPage->ID, true);
        }
        $post_details = array(
            'post_title' => 'Shuuka links',
            'post_name' => $slugOption,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
            'meta_input' => array(
                '_wp_page_template' => 'shuuka-social-links-template'
            )
        );
        wp_insert_post($post_details);
    }
}

shuuka_create_page_template();
shuuka_generateAdminSetting();
add_action('redux/options/shuuka_user_page_setting/settings/change', 'on_form_save_data');

/**
 * 
 * Redirect to plugin setting when actived
 * 
 */
register_activation_hook(__FILE__, 'shuuka_plugin_activate');
add_action('admin_init', 'shuuka_plugin_redirect');
function shuuka_plugin_activate() {
    add_option('shuuka_plugin_do_activation_redirect', true);
}
function shuuka_plugin_redirect() {
    if (get_option('shuuka_plugin_do_activation_redirect', false)) {
        delete_option('shuuka_plugin_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("admin.php?page=shuuka_options&tab=1");
        }
    }
}

/**
 * 
 * ADD SETTING LINK
 * 
 */
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'shuuka_add_plugin_page_settings_link');
function shuuka_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'admin.php?page=shuuka_options&tab=1' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}

/**
 * 
 * SET HEADER
 * 
 */
function shuuka_add_style_to_page() { 
    wp_enqueue_style( 'shuuka-google-fonts', 'https://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700', false ); 
    wp_enqueue_style( 'shuuka-front-style', plugin_dir_url(__FILE__).'assets/front-style.css', 99 ); 
}
add_action( 'wp_enqueue_scripts', 'shuuka_add_style_to_page' );

/**
 * Remove all java scripts.
 */
function shuuka_remove_all_scripts() {
    global $wp_scripts;
    if ( is_page_template( 'shuuka-social-links-template' ) ) {
        $wp_scripts->queue = array();
    }
}
add_action( 'wp_print_scripts', 'shuuka_remove_all_scripts', 99 );

/**
 * Remove all style sheets.
 */
function shuuka_remove_all_styles() {
    global $wp_styles;
    if ( is_page_template( 'shuuka-social-links-template' ) ) {
        $wp_styles->queue = array('shuuka-google-fonts','shuuka-front-style');
    }
}
add_action( 'wp_print_styles', 'shuuka_remove_all_styles', 99 );

/**
 * remove unncessary header info
 */
function shuuka_remove_header_meta() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');
    remove_action( 'wp_head', '_wp_render_title_tag', 1 );
}
add_action('init', 'shuuka_remove_header_meta');