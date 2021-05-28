<?php
/*
Plugin Name: Dynamic Content Click Page Generator
Plugin URI: https://needtochange.com/
Description: Plugin to create dynamic content based on custom tables.
Version: 1.0
Author: Justin Boundy
Author URI: https://needtochange.com/
License: GPLv2 or later
Text Domain: none
*/

//todo these are example hooks. Nedd to add real ones
function tutsplus_movie_styles() {
    wp_enqueue_style( 'movies',  plugin_dir_url( __FILE__ ) . ‘/css/movies.css’ );                      
}
add_action( 'wp_enqueue_scripts', ‘tutsplus_movie_styles' );

function tutsplus_register_post_type() {
 
 // movies

 $labels = array( 

     'name' => __( 'Movies' , 'tutsplus' ),
     'singular_name' => __( 'Movie' , 'tutsplus' ),
     'add_new' => __( 'New Movie' , 'tutsplus' ),
     'add_new_item' => __( 'Add New Movie' , 'tutsplus' ),
     'edit_item' => __( 'Edit Movie' , 'tutsplus' ),
     'new_item' => __( 'New Movie' , 'tutsplus' ),
     'view_item' => __( 'View Movie' , 'tutsplus' ),
     'search_items' => __( 'Search Movies' , 'tutsplus' ),
     'not_found' =>  __( 'No Movies Found' , 'tutsplus' ),
     'not_found_in_trash' => __( 'No Movies found in Trash' , 'tutsplus' ),
 );

 $args = array(
     'labels' => $labels,
     'has_archive' => true,
     'public' => true,
     'hierarchical' => false,
     'supports' => array(
         'title', 
         'editor', 
         'excerpt', 
         'custom-fields', 
         'thumbnail',
         'page-attributes'
     ),
     'rewrite'   => array( 'slug' => 'movies' ),
     'show_in_rest' => true
 );
}

function tutsplus_register_taxonomy() {    
      
    // books
    $labels = array(
        'name' => __( 'Genres' , 'tutsplus' ),
        'singular_name' => __( 'Genre', 'tutsplus' ),
        'search_items' => __( 'Search Genres' , 'tutsplus' ),
        'all_items' => __( 'All Genres' , 'tutsplus' ),
        'edit_item' => __( 'Edit Genre' , 'tutsplus' ),
        'update_item' => __( 'Update Genres' , 'tutsplus' ),
        'add_new_item' => __( 'Add New Genre' , 'tutsplus' ),
        'new_item_name' => __( 'New Genre Name' , 'tutsplus' ),
        'menu_name' => __( 'Genres' , 'tutsplus' ),
    );
      
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'genres' ),
        'show_admin_column' => true,
        'show_in_rest' => true
  
    );
      
    register_taxonomy( 'tutsplus_genre', array( 'tutsplus_movie' ), $args);
      
}

add_action( 'init', 'tutsplus_register_post_type' );
add_action( 'init', 'tutsplus_register_taxonomy' );