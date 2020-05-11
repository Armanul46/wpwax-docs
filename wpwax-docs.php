<?php
/**
 * Plugin Name: wpWax Docs
 * Plugin URI:
 * Description: This is docs Plugin.
 * Version: 1.0
 * Author: wpWax
 * Author URI: http://aazztech.com
 * License: GPLv2 or later
 * Text Domain: wpWax-docs
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
     * CM_Custom_Field Object.
     *
     * @var object|WP_Wax_Custom_Post
     * @since 1.0
     */
    public $custom_post;
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
            self::$instance->includes();
            self::$instance->custom_post = new WP_Wax_Custom_Post;
            add_action('plugins_loaded', array(self::$instance, 'load_textdomain'));
            add_action('wp_enqueue_scripts', array(self::$instance, 'load_needed_scripts'));

            add_filter('the_content', array(self::$instance, 'the_content'), 20);
            add_shortcode('wpwax_docs',array(self::$instance, 'wpwax_docs'));
            add_shortcode( 'wpwax_search_result', array( self::$instance, 'wpwax_search_result') );
            add_filter('post_type_link', array(self::$instance, 'filter_post_type_link'), 10, 2);	
            add_action('save_post', array(self::$instance, 'default_taxonomy_term'), 100, 2 );


        }
        return self::$instance;
    }


    public function default_taxonomy_term( $post_id, $post ){
        if ( 'publish' === $post->post_status ) {
            $defaults = array();
            $taxonomies = get_object_taxonomies( $post->post_type );
            foreach ( (array) $taxonomies as $taxonomy ) {
                $terms = wp_get_post_terms( $post_id, $taxonomy );
                if ( empty($terms) && array_key_exists( $taxonomy, $defaults ) ) {
                    wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
                }
            }
        }
    }


    private function docs_type(){
          return array('wpwax_directorist','wpwax_extensions','wpwax_dlist','wpwax_direo','wpwax_directoria','wpwax_findbiz','wpwax_dservice','wpwax_drestaurant');
    }

    private function get_link($post_id, $term, $link){
        if ( $cats = get_the_terms($post_id, $term) ){
            $cat_slug = $cats[0]->slug;
            $link = str_replace('%'.$term.'%', $cat_slug, $link);
        }else{
            $link = $link;
        }
        return $link;
    }

   public function filter_post_type_link(  $link, $post ){
            if(!in_array($post->post_type, $this->docs_type())){
                return $link;
            }
            $post_id = $post->ID;
            foreach($this->docs_type() as $type){
                switch($type){
                    case 'wpwax_directorist':
                        $link = $this->get_link($post_id, 'wpwax_directorist_category', $link);
                    break;
                    case 'wpwax_extensions':
                        $link = $this->get_link($post_id, 'wpwax_extensions_category', $link);
                        break;
                    case 'wpwax_dlist':
                        $link = $this->get_link($post_id, 'wpwax_dlist_category', $link);
                    break;
                    case 'wpwax_direo':
                        $link = $this->get_link($post_id, 'wpwax_direo_category', $link);
                    break;
                    case 'wpwax_directoria':
                        $link = $this->get_link($post_id, 'wpwax_directoria_category', $link);
                    break;
                    case 'wpwax_findbiz':
                        $link = $this->get_link($post_id, 'wpwax_findbiz_category', $link);
                    break;
                    case 'wpwax_dservice':
                        $link = $this->get_link($post_id, 'wpwax_dservice_category', $link);
                    break;
                    case 'wpwax_drestaurant':
                        $link = $this->get_link($post_id, 'wpwax_drestaurant_category', $link);
                    break;
                }
            }
        return $link;
    }

    public function wpwax_search_result () {

        ob_start();
        include BDC_TEMPLATES_DIR . '/search-template.php';
        return ob_get_clean();

    }
    public function the_content( $content ) {
        if ( is_singular( array('wpwax_directorist','wpwax_dlist','wpwax_direo','wpwax_directoria','wpwax_findbiz','wpwax_dservice','wpwax_drestaurant','wpwax_extensions') ) && in_the_loop() && is_main_query()) {
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

        $type = !empty($atts['type']) ? $atts['type'] : '';
        if( !empty( $type ) && 'wpwax_directorist' == $type ) {
            $taxonomy = 'wpwax_directorist_category';
            $search_type = 'directorist';
        } elseif ( 'wpwax_dlist' == $type ) {
            $taxonomy = 'wpwax_dlist_category';
            $search_type = 'dlist';
        } elseif ( 'wpwax_extensions' == $type ) {
            $taxonomy = 'wpwax_extensions_category';
            $search_type = 'extensions';
        } elseif ( 'wpwax_direo' == $type ) {
            $taxonomy = 'wpwax_direo_category';
            $search_type = 'direo';
        } elseif ( 'wpwax_directoria' == $type ) {
            $taxonomy = 'wpwax_directoria_category';
            $search_type = 'directoria';
        } elseif ( 'wpwax_findbiz' == $type ) {
            $taxonomy = 'wpwax_findbiz_category';
            $search_type = 'findbiz';
        } elseif ( 'wpwax_dservice' == $type ) {
            $taxonomy = 'wpwax_dservice_category';
            $search_type = 'dservice';
        } elseif ( 'wpwax_drestaurant' == $type ) {
            $taxonomy = 'wpwax_drestaurant_category';
            $search_type = 'drestaurant';
        }
        //$category = get_term_by('slug', $slug, 'wpwax_docs_category');
        if( !empty( $taxonomy ) ) {
            $child_cats = get_terms([
                'taxonomy' =>  $taxonomy,
                'orderby' => 'date',
                'order' => 'ASC',
                //'parent' => $category->term_taxonomy_id
            ]);
        }
        ob_start();
        include BDC_TEMPLATES_DIR . '/shortcode-template.php';
        return ob_get_clean();
    }


    public function load_needed_scripts()
    {
        wp_enqueue_script('bdc-main-js', plugin_dir_url(__FILE__) . '/public/assets/js/main.js',array('jquery'));
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
        require_once BDC_DIR . '/inc/custom-post.php';
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

