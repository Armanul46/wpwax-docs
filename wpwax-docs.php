<?php
/**
 * Plugin Name: wpWax Docs
 * Plugin URI: http://aazztech.com/plugins/directorist-map-view
 * Description: This is an add-on for Directorist Plugin. You can display business hour by this extension.
 * Version: 1.0
 * Author: AazzTech
 * Author URI: http://aazztech.com
 * License: GPLv2 or later
 * Text Domain: directorist-map-view
 * Domain Path: /languages
 */

// prevent direct access to the file
defined('ABSPATH') || die('No direct script access allowed!');

final class BD_Docs
{
    /** Singleton *************************************************************/

    /**
     * @var BD_Docs The one true BD_Docs
     * @since 1.0
     */
    private static $instance;
    /**
     * Main BD_Docs Instance.
     *
     * Insures that only one instance of BD_Docs exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @since 1.0
     * @static
     * @static_var array $instance
     * @uses BD_Docs::setup_constants() Setup the constants needed.
     * @uses BD_Docs::includes() Include the required files.
     * @uses BD_Docs::load_textdomain() load the language files.
     * @see  BD_Docs()
     * @return object|BD_Docs The one true BD_Docs
     */
    public static function instance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof BD_Docs)) {
            self::$instance = new BD_Docs;
            self::$instance->setup_constants();
            add_action('plugins_loaded', array(self::$instance, 'load_textdomain'));
            add_action('wp_enqueue_scripts', array(self::$instance, 'load_needed_scripts'));

            add_action('init', array(self::$instance, 'register_custom_post_type'));
            add_action('init', array(self::$instance, 'add_custom_taxonomy'));
            add_filter('the_content', array(self::$instance, 'the_content'), 20);
            add_shortcode('wpwax_docs',array(self::$instance, 'wpwax_docs'));
            self::$instance->includes();

        }
        return self::$instance;
    }


    public function the_content( $content ) {
        if (is_singular('wpwax_docs') && in_the_loop() && is_main_query()) {
            ob_start();
            include BDC_TEMPLATES_DIR . '/single-template.php';
            return ob_get_clean();
        }
        return $content;
    }


    public function wpwax_docs( $atts ) {
        $params = array(
            'type' => '',
        );
        $atts = shortcode_atts($params, $atts);

        $slug = !empty($atts['type']) ? $atts['type'] : '';

        $category = get_term_by('slug', $slug, 'wpwax_docs_category');
        if( !empty( $category ) ) {
            $child_cats = get_terms([
                'taxonomy' => 'wpwax_docs_category',
                'parent' => $category->term_taxonomy_id
            ]);
        }
        ob_start();
        include BDC_TEMPLATES_DIR . '/shortcode-template.php';
        return ob_get_clean();
    }


    public function register_custom_post_type()
    {

        $labels = array(
            'name' => _x('WpWax Docs', 'Plural Name of WpWax listing', 'wpwax-docs'),
            'singular_name' => _x('WpWax Docs', 'Singular Name of WpWax listing', 'wpwax-docs'),
            'menu_name' => __('WpWax Docs', 'wpwax-docs'),
            'name_admin_bar' => __('WpWax Docs', 'wpwax-docs'),
            'parent_item_colon' => __('Parent Docs listing:', 'wpwax-docs'),
            'all_items' => __('All Docs', 'wpwax-docs'),
            'add_new_item' => __('Add New Doc', 'wpwax-docs'),
            'add_new' => __('Add New Doc', 'wpwax-docs'),
            'new_item' => __('New Doc', 'wpwax-docs'),
            'edit_item' => __('Edit Doc', 'wpwax-docs'),
            'update_item' => __('Update Doc', 'wpwax-docs'),
            'view_item' => __('View Doc', 'wpwax-docs'),
            'search_items' => __('Search Doc', 'wpwax-docs'),
            'not_found' => __('No Docs found', 'wpwax-docs'),
            'not_found_in_trash' => __('Not Doc found in Trash', 'wpwax-docs'),
        );

        $args = array(
            'label' => __('WpWax Docs', 'wpwax-docs'),
            'description' => __('WpWax Docs', 'wpwax-docs'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'author'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_docs_category'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => current_user_can('edit_others_at_biz_dirs') ? true : false, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );
        $slug = 'wp_wax_dir';
        if (!empty($slug)) {
            $args['rewrite'] = array(
                'slug' => $slug,
                'with_front' => false,

            );
        }



        register_post_type('wpwax_docs', $args);

    }

    public function add_custom_taxonomy()
    {

        /*CATEGORY*/

        $labels = array(
            'name' => _x('WpWax categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('WpWax category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('WpWax Categories', 'wpwax-docs'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
        );

        // get the rewrite slug from the user settings, if exist use it.





        register_taxonomy('wpwax_docs_category', 'wpwax_docs', $args);

    }

    public function load_needed_scripts()
    {
        wp_enqueue_script('bdc-main-js', plugin_dir_url(__FILE__) . '/public/assets/js/main.js');
        wp_enqueue_style('bdc-main-css', plugin_dir_url(__FILE__) . '/public/assets/css/style.css');

    }
    private function __construct()
    {
        /*making it private prevents constructing the object*/
    }
    /**
     * Throw error on object clone.
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object therefore, we don't want the object to be cloned.
     *
     * @since 1.0
     * @access protected
     * @return void
     */
    public function __clone()
    {
        // Cloning instances of the class is forbidden.
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', BDC_TEXTDOMAIN), '1.0');
    }
    /**
     * Disable unserializing of the class.
     *
     * @since 1.0
     * @access protected
     * @return void
     */
    public function __wakeup()
    {
        // Unserializing instances of the class is forbidden.
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', BDC_TEXTDOMAIN), '1.0');
    }
    /**
     * It register the text domain to the WordPress
     */
    public function load_textdomain()
    {
        load_plugin_textdomain(BDC_TEXTDOMAIN, false, BDC_LANG_DIR);
    }

    /**
     * It Includes and requires necessary files.
     *
     * @access private
     * @since 1.0
     * @return void
     */
    private function includes()
    {
        //require_once BDC_INC_DIR . 'helper-functions.php';
    }
    /**
     * It  loads a template file from the Default template directory.
     * @param string $name Name of the file that should be loaded from the template directory.
     * @param array $args Additional arguments that should be passed to the template file for rendering dynamic  data.
     */
    public function load_template($name, $args = array())
    {
        global $post;
        include(BDC_TEMPLATES_DIR . $name . '.php');
    }

    /**
     * Setup plugin constants.
     *
     * @access private
     * @since 1.0
     * @return void
     */
    private function setup_constants()
    {
        // Plugin Folder Path.
        if ( ! defined( 'BDC_DIR' ) ) { define( 'BDC_DIR', plugin_dir_path( __FILE__ ) ); }
        // Plugin Folder URL.
        if ( ! defined( 'BDC_URL' ) ) { define( 'BDC_URL', plugin_dir_url( __FILE__ ) ); }
        // Plugin Root File.
        if ( ! defined( 'BDC_FILE' ) ) { define( 'BDC_FILE', __FILE__ ); }
        if ( ! defined( 'BDC_BASE' ) ) { define( 'BDC_BASE', plugin_basename( __FILE__ ) ); }
        // Plugin Text domain File.
        if ( ! defined( 'BDC_TEXTDOMAIN' ) ) { define( 'BDC_TEXTDOMAIN', 'directorist-map-view' ); }
        // Plugin Language File Path
        if ( !defined('BDC_LANG_DIR') ) { define('BDC_LANG_DIR', dirname(plugin_basename( __FILE__ ) ) . '/languages'); }
        // Plugin Template Path
        if ( !defined('BDC_TEMPLATES_DIR') ) { define('BDC_TEMPLATES_DIR', BDC_DIR.'templates/'); }
    }
}
/**
 * The main function for that returns BD_Docs
 *
 * The main function responsible for returning the one true BD_Docs
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 *
 * @since 1.0
 * @return object|BD_Docs The one true BD_Docs Instance.
 */
function BD_Docs()
{
    return BD_Docs::instance();
}
BD_Docs(); // get the plugin running



