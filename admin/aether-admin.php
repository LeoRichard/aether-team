<?php
/**

||-> Custom Post Type: Aether Team
Author: Richard Leo

*/

function post_type_aether_team() {
	$supports = array(
		'title', // post title
		'editor', // post content
		'author', // post author
		'thumbnail', // featured images
		'excerpt', // post excerpt
		'custom-fields', // custom fields
		'revisions', // post revisions
	);
	$labels = array(
		'name' => _x('Team Members', 'plural'),
		'singular_name' => _x('Team Member', 'singular'),
		'menu_name' => _x('Team', 'admin menu'),
		'name_admin_bar' => _x('Team', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New Team Member'),
		'new_item' => __('New Team Member'),
		'edit_item' => __('Edit Team Member'),
		'view_item' => __('View Team Member'),
		'all_items' => __('All Team Members'),
		'search_items' => __('Search Team Members'),
		'not_found' => __('No team member found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'aether-team'),
		'has_archive' => false,
		'hierarchical' => false,
	);

	register_post_type('aether-team', $args);
}

// Taxonomy
function taxonomy_aether_team() {

	//set some options for our new custom taxonomy
	$args = array(
	  'label' => __( 'Team Categories' ),
	  'hierarchical' => true,
	  'capabilities' => array(
	      'assign_terms' => 'edit_posts',
	      'edit_terms' => 'administrator'
	  )
	);

	// create the custom taxonomy and attach it to a custom post type
	register_taxonomy( 'aether-team-category', 'aether-team', $args);
}

// Init
add_action( 'init', 'post_type_aether_team' );
add_action( 'init', 'taxonomy_aether_team' );

// Scripts
function aether_team_scripts(){
	wp_register_script( 'slickjs', plugins_url( '../assets/js/slick.min.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_register_script( 'aether_team_mainjs', plugins_url( '../assets/js/aether-team-main.js', __FILE__ ), array( 'jquery' ), '2.0', true );
	wp_enqueue_script( 'slickjs' );
	wp_enqueue_script( 'aether_team_mainjs' );
 	
 	wp_enqueue_style( 'aether_team_css', plugins_url( '../assets/css/styles.css', __FILE__ ), '', '2.0' );
	wp_enqueue_style( 'slickcss', plugins_url( '../assets/css/slick.css', __FILE__ ), '', '1.0' );
}
add_action( 'wp_enqueue_scripts', 'aether_team_scripts' );