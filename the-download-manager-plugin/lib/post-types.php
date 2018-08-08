<?php
/**
 * Creating the downloads post type
 */
function create_downloads_post_types() {
	register_post_type( 'downloads',
		array(
			'labels' 				=> array(
				'name'					=> 'Downloads',
				'singular_name'			=> 'Download',
				'add_new'				=> 'Add New Download',
				'add_new_item'			=> 'Add New Download',
				'edit_item'				=> 'Edit Download',
				'new_item'				=> 'New Download',
				'all_items'				=> 'All Downloads',
				'view_item'				=> 'View Download',
				'search_items'			=> 'Search Downloads',
				'not_found'				=> 'No Downloads found',
				'not_found_in_trash'	=> 'No Downloads found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Downloads'
			),
			'public' 				=> true,
			'has_archive'			=> true,
			'publicly_queryable'	=> true,
			'menu_position' 		=> 20,
			'supports'				=> array( 'thumbnail' ),
			'menu_icon'				=> 'dashicons-download',
			'rewrite' 				=> array( 'slug' => 'downloads', 'with_front' => false )
		)
	);

	register_post_type( 'download-notes',
		array(
			'labels' 				=> array(
				'name'					=> 'Release Notes',
				'singular_name'			=> 'Release Note',
				'add_new'				=> 'Add New Release Note',
				'add_new_item'			=> 'Add New Release Note',
				'edit_item'				=> 'Edit Release Note',
				'new_item'				=> 'New Release Note',
				'all_items'				=> 'All Release Notes',
				'view_item'				=> 'View Release Note',
				'search_items'			=> 'Search Release Notes',
				'not_found'				=> 'No Release Notes found',
				'not_found_in_trash'	=> 'No Release Notes found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Release Notes'
			),
			'public' 				=> true,
			'has_archive'			=> true,
			'publicly_queryable'	=> true,
			'exclude_from_search'	=> true,
			'show_in_menu'			=> false,
			'show_in_admin_bar'		=> false,
			'menu_position' 		=> 21,
			'supports'				=> array( 'title', 'editor' ),
			'menu_icon'				=> 'dashicons-download',
			'rewrite' 				=> array(  'slug' => 'download-notes', 'with_front' => false )
		)
	);

	register_post_type( 'license',
		array(
			'labels' 				=> array(
			'name'					=> 'license',
			'singular_name'			=> 'license',
			'add_new'				=> 'Add New license agreemenent',
			'add_new_item'			=> 'Add New license agreemenent',
			'edit_item'				=> 'Edit license agreemenent',
			'new_item'				=> 'New license agreemenent',
			'all_items'				=> 'All licenses',
			'view_item'				=> 'View license',
			'search_items'			=> 'Search license',
			'not_found'				=> 'No license found',
			'not_found_in_trash'	=> 'No license found in Trash',
			'parent_item_colon'	=> '',
			'menu_name'				=> 'License Agreemenents'
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'publicly_queryable'	=> true,
			'exclude_from_search'	=> true,
			'show_in_menu'			=> false,
			'show_in_admin_bar'		=> false,
			'menu_position' 		=> 20,
			'supports'				=> array( 'title', 'editor' ),
			'rewrite' 				=> array( 'slug' => 'license', 'with_front' => false )
		)
	);
}
add_action( 'init', 'create_downloads_post_types' );

/**
 * Add in some of the submenus we need
 */
function add_download_submenus(){
	add_submenu_page( 'edit.php?post_type=downloads', 'Release Notes', 'Release Notes', 'edit_pages', 'edit.php?post_type=download-notes' );
	add_submenu_page( 'edit.php?post_type=downloads', 'License Agreemenents', 'Licenses', 'edit_pages', 'edit.php?post_type=license' );
}
add_action('admin_menu', 'add_download_submenus');

/**
 * Creating custom taxonomies for the downloads
 */
function create_downloads_taxonomies() {
	// Custom Download Categories Taxonomie
	$labels = array(
		'name'              => _x( 'Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Categories' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category' ),
		'menu_name'         => __( 'Categories' )
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	);

	register_taxonomy( 'download-categories', array( 'downloads' ), $args );

	// Custom Download Tags Taxonomie
	$labels = array(
		'name'              => _x( 'Tag', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Tags' ),
		'all_items'         => __( 'All Tags' ),
		'parent_item'       => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tags' ),
		'edit_item'         => __( 'Edit Tag' ),
		'update_item'       => __( 'Update Tag' ),
		'add_new_item'      => __( 'Add New Tag' ),
		'new_item_name'     => __( 'New Tag' ),
		'menu_name'         => __( 'Tags' )
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	);

	// downloads-arch needs adding to the array once it's live.
	register_taxonomy( 'download-tags', array( 'downloads' ), $args );

	// Custom taxonomy for intended use description type
	$labels = array(
		'name'              => _x( 'Intended Use', 'taxonomy general name' ),
		'singular_name'     => _x( 'Intended Use', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Intended Uses' ),
		'all_items'         => __( 'All Intended Uses' ),
		'parent_item'       => __( 'Parent Intended Use' ),
		'parent_item_colon' => __( 'Parent Intended Uses' ),
		'edit_item'         => __( 'Edit Intended Use' ),
		'update_item'       => __( 'Update Intended Use' ),
		'add_new_item'      => __( 'Add New Intended Use' ),
		'new_item_name'     => __( 'New Intended Use' ),
		'menu_name'         => __( 'Intended Use' )
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	);

	// register_taxonomy( 'intended-use', array( 'downloads' ), $args );
}
add_action( 'init', 'create_downloads_taxonomies', 0 );

/* removed argument 2 ($post_id) from function extend_downloads_columns below
did this because it was causing the admin page to fall down
the second arg wasn't being used so instead of returning something that doesn't appear to be needed I've removed it. This argument is in the function that follows */
function extend_downloads_columns( $column ) {
	$column['download_shortcode'] = 'Download Shortcode';
	$column['download_count'] = 'Download Count';
	return $column;
}
add_filter('manage_downloads_posts_columns', 'extend_downloads_columns');

function downloads_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'download_shortcode' :
			echo '<p><strong>[download id="' . $post_id . '" button="false"]</strong></p>';
			break;
		case 'download_count' :
		global $wpdb;
			// Query the total downloads based on ID and greater than las weeks timestamp of now.
		$weekly_download = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(download_id)
			FROM ".$wpdb->prefix."download_tracking
			WHERE download_id = %s
			AND timestamp >= %s",
			get_the_ID(), date('Y-m-d H:i:s', strtotime('-1 week'))
		)
		);
			echo '<p><a href="edit.php?post_type=downloads&page=download-reports&download-id='.$post_id.'"><strong>This Week:</strong>'. $weekly_download .'</br>';
			echo '<strong>Total:</strong>'. get_post_meta( get_the_ID(), 'download_count', true ).'</a></p>';
			break;
	}
}
add_action( 'manage_downloads_posts_custom_column' , 'downloads_columns_content', 10, 2 );