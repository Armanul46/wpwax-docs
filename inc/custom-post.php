<?php
// Prohibit direct script loading.
defined('ABSPATH') || die('No direct script access allowed!');

class WP_Wax_Custom_Post
{
    public function __construct()
    {
        add_action('init', array( $this, 'register_custom_post_type'));
        add_action('init', array( $this, 'add_custom_taxonomy'));
    }

    public function register_custom_post_type()
    {
        // directorist custom post type
        $labels = array(
            'name' => _x('Directorist Docs', 'Plural Name of Directorist Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Directorist Docs', 'Singular Name of Directorist Docs listing', 'wpwax-docs'),
            'menu_name' => __('Directorist Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Directorist Docs', 'wpwax-docs'),
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
            'label' => __('Directorist Docs Docs', 'wpwax-docs'),
            'description' => __('Directorist Docs Docs', 'wpwax-docs'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_directorist_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'directorist/%wpwax_directorist_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_directorist',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );

        // Extensions custom post type
        $extensions_labels = array(
            'name' => _x('Extensions Docs', 'Plural Name of Extensions Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Extensions Docs', 'Singular Name of Extensions Docs listing', 'wpwax-docs'),
            'menu_name' => __('Extensions Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Extensions Docs', 'wpwax-docs'),
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

        $extensions_args = array(
            'label' => __('Extensions Docs', 'wpwax-docs'),
            'description' => __('Extensions Docs', 'wpwax-docs'),
            'labels' => $extensions_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_extensions_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'extensions/%wpwax_extensions_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_extensions',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );

        // Dlist custom post type
        $dlist_labels = array(
            'name' => _x('Dlist Docs', 'Plural Name of Dlist Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Dlist Docs', 'Singular Name of Dlist Docs listing', 'wpwax-docs'),
            'menu_name' => __('Dlist Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Dlist Docs', 'wpwax-docs'),
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

        $dlist_args = array(
            'label' => __('Dlist Docs', 'wpwax-docs'),
            'description' => __('Dlist Docs', 'wpwax-docs'),
            'labels' => $dlist_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_dlist_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'dlist/%wpwax_dlist_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_dlist',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );


        // Direo custom post type
        $direo_labels = array(
            'name' => _x('Direo Docs', 'Plural Name of Direo Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Direo Docs', 'Singular Name of Direo Docs listing', 'wpwax-docs'),
            'menu_name' => __('Direo Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Direo Docs', 'wpwax-docs'),
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

        $direo_args = array(
            'label' => __('Direo Docs Docs', 'wpwax-docs'),
            'description' => __('Direo Docs Docs', 'wpwax-docs'),
            'labels' => $direo_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_direo_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'direo/%wpwax_direo_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_direo',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );


        // Directoria custom post type
        $directoria_labels = array(
            'name' => _x('Directoria Docs', 'Plural Name of Directoria Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Directoria Docs', 'Singular Name of Directoria Docs listing', 'wpwax-docs'),
            'menu_name' => __('Directoria Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Directoria Docs', 'wpwax-docs'),
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

        $directoria_args = array(
            'label' => __('Directoria Docs Docs', 'wpwax-docs'),
            'description' => __('Directoria Docs Docs', 'wpwax-docs'),
            'labels' => $directoria_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_directoria_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'directoria/%wpwax_directoria_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_directoria',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );

        // findbiz custom post type
        $findbiz_labels = array(
            'name' => _x('Findbiz Docs', 'Plural Name of Findbiz Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Findbiz Docs', 'Singular Name of Findbiz Docs listing', 'wpwax-docs'),
            'menu_name' => __('Findbiz Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Findbiz Docs', 'wpwax-docs'),
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

        $findbiz_args = array(
            'label' => __('Findbiz Docs Docs', 'wpwax-docs'),
            'description' => __('Findbiz Docs Docs', 'wpwax-docs'),
            'labels' => $findbiz_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_findbiz_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'findbiz/%wpwax_findbiz_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_findbiz',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );

        // Dservice custom post type
        $dservice_labels = array(
            'name' => _x('Dservice Docs', 'Plural Name of Dservice Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Dservice Docs', 'Singular Name of Dservice Docs listing', 'wpwax-docs'),
            'menu_name' => __('Dservice Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Dservice Docs', 'wpwax-docs'),
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

        $dservice_args = array(
            'label' => __('Dservice Docs Docs', 'wpwax-docs'),
            'description' => __('Dservice Docs Docs', 'wpwax-docs'),
            'labels' => $dservice_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_dservice_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'dservice/%wpwax_dservice_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_dservice',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );

        // Drestaurant custom post type
        $drestaurant_labels = array(
            'name' => _x('Drestaurant Docs', 'Plural Name of Drestaurant Docs listing', 'wpwax-docs'),
            'singular_name' => _x('Drestaurant Docs', 'Singular Name of Drestaurant Docs listing', 'wpwax-docs'),
            'menu_name' => __('Drestaurant Docs', 'wpwax-docs'),
            'name_admin_bar' => __('Drestaurant Docs', 'wpwax-docs'),
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

        $drestaurant_args = array(
            'label' => __('Drestaurant Docs Docs', 'wpwax-docs'),
            'description' => __('Drestaurant Docs Docs', 'wpwax-docs'),
            'labels' => $drestaurant_labels,
            'supports' => array('title', 'editor', 'author','page-attributes'),
            //'show_in_rest'         => true,
            'taxonomies' => array('wpwax_drestaurant_category'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true, // show the menu only to the admin
            'show_in_menu' => true,
            'menu_position' => 20,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => 'drestaurant/%wpwax_drestaurant_category%', 'with_front' => FALSE ),
            'capability_type' => 'post',
            'has_archive' => 'wpwax_drestaurant',
            'map_meta_cap' => true, // set this true, otherwise, even admin will not be able to edit this post. WordPress will map cap from edit_post to edit_at_biz_dir etc,

        );

        register_post_type('wpwax_directorist', $args);
        register_post_type('wpwax_extensions', $extensions_args);
        register_post_type('wpwax_dlist', $dlist_args);
        register_post_type('wpwax_direo', $direo_args);
        register_post_type('wpwax_directoria', $directoria_args);
        register_post_type('wpwax_findbiz', $findbiz_args);
        register_post_type('wpwax_dservice', $dservice_args);
        register_post_type('wpwax_drestaurant', $drestaurant_args);

    }

    public function add_custom_taxonomy()
    {


        // Directorist Category
        $labels = array(
            'name' => _x('Directorist Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Directorist Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Directorist Docs Categories', 'wpwax-docs'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'directorist_category', 'with_front' => false ),
        );

        // Extensions category
        $extensions_labels = array(
            'name' => _x('Extensions Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Extensions Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Dlist Docs Categories', 'wpwax-docs'),
        );

        $extensions_args = array(
            'hierarchical' => true,
            'labels' => $extensions_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'extensions_category', 'with_front' => false ),
        );

        // Dlist category
        $dlist_labels = array(
            'name' => _x('Dlist Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Dlist Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Dlist Docs Categories', 'wpwax-docs'),
        );

        $dlist_args = array(
            'hierarchical' => true,
            'labels' => $dlist_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'dlist_category', 'with_front' => false ),
        );

        // Direo category
        $direo_labels = array(
            'name' => _x('Direo Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Direo Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Direo Docs Categories', 'wpwax-docs'),
        );

        $direo_args = array(
            'hierarchical' => true,
            'labels' => $direo_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'direo_category', 'with_front' => false ),
        );

        // Directoria category
        $directoria_labels = array(
            'name' => _x('Directoria Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Directoria Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Directoria Docs Categories', 'wpwax-docs'),
        );

        $directoria_args = array(
            'hierarchical' => true,
            'labels' => $directoria_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'directoria_category', 'with_front' => false ),
        );

        // Findbiz category
        $findbiz_labels = array(
            'name' => _x('Findbiz Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Findbiz Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Findbiz Docs Categories', 'wpwax-docs'),
        );

        $findbiz_args = array(
            'hierarchical' => true,
            'labels' => $findbiz_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'findbiz_category', 'with_front' => false ),
        );

        // Dservice category
        $dservice_labels = array(
            'name' => _x('Dservice Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Dservice Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Dservice Docs Categories', 'wpwax-docs'),
        );

        $dservice_args = array(
            'hierarchical' => true,
            'labels' => $dservice_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'dservice_category', 'with_front' => false ),
        );

        // Drestaurant category
        $drestaurant_labels = array(
            'name' => _x('Drestaurant Docs categories', 'Category general name', 'wpwax-docs'),
            'singular_name' => _x('Drestaurant Docs category', 'Category singular name', 'wpwax-docs'),
            'search_items' => __('Search category', 'wpwax-docs'),
            'all_items' => __('All categories', 'wpwax-docs'),
            'parent_item' => __('Parent category', 'wpwax-docs'),
            'parent_item_colon' => __('Parent category:', 'wpwax-docs'),
            'edit_item' => __('Edit category', 'wpwax-docs'),
            'update_item' => __('Update category', 'wpwax-docs'),
            'add_new_item' => __('Add New category', 'wpwax-docs'),
            'new_item_name' => __('New category Name', 'wpwax-docs'),
            'menu_name' => __('Drestaurant Docs Categories', 'wpwax-docs'),
        );

        $drestaurant_args = array(
            'hierarchical' => true,
            'labels' => $drestaurant_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'rewrite' => array( 'slug' => 'drestaurant_category', 'with_front' => false ),
        );

        register_taxonomy('wpwax_directorist_category', 'wpwax_directorist', $args);
        register_taxonomy('wpwax_extensions_category', 'wpwax_extensions', $extensions_args);
        register_taxonomy('wpwax_dlist_category', 'wpwax_dlist', $dlist_args);
        register_taxonomy('wpwax_direo_category', 'wpwax_direo', $direo_args);
        register_taxonomy('wpwax_directoria_category', 'wpwax_directoria', $directoria_args);
        register_taxonomy('wpwax_findbiz_category', 'wpwax_findbiz', $findbiz_args);
        register_taxonomy('wpwax_dservice_category', 'wpwax_dservice', $dservice_args);
        register_taxonomy('wpwax_drestaurant_category', 'wpwax_drestaurant', $drestaurant_args);

    }
}
