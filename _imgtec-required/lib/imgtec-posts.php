<?php
/*
 * Custom Post Types for imgtec.com
 */

function create_imgtec_post_types(){

	// Press Releases
	register_post_type( 'press_releases',

		array(
			'labels' 				=> array(
				'name'					=> 'Press Releases',
				'singular_name' 		=> 'Press Release',
				'add_new'				=> 'Add Release',
				'add_new_item'			=> 'Add New Release',
				'edit_item'				=> 'Edit Release',
				'new_item'				=> 'New Release',
				'all_items'				=> 'All Press Releases',
				'view_item'				=> 'View Release',
				'search_items'			=> 'Search Press Releases',
				'not_found'				=> 'No Press Releases found',
				'not_found_in_trash'	=> 'No Press Releases found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Press Releases',
				'publicly_queryable'	=> true,
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'news/press-release', 'with_front' => false
			),
			'supports'				=> array(
				'title', 'editor', 'author', 'excerpt'
			)
		)
	);

	// Events
	register_post_type( 'our_events',

		array(
			'labels' 				=> array(
				'name'					=> 'Events',
				'singular_name' 		=> 'Events',
				'add_new'				=> 'Add Event',
				'add_new_item'			=> 'Add New Event',
				'edit_item'				=> 'Edit Event',
				'new_item'				=> 'New Event',
				'all_items'				=> 'All Events',
				'view_item'				=> 'View Event',
				'search_items'			=> 'Search Events',
				'not_found'				=> 'No Events found',
				'not_found_in_trash'	=> 'No Events found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Events',
				'publicly_queryable'	=> true,
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'event', 'with_front' => false
			),
			'supports'				=> array(
				'revisions', 'title', 'editor', 'thumbnail', 'author'
			)
		)
	);

	// Webinars
	register_post_type( 'webinars',

		array(
			'labels' 				=> array(
				'name'					=> 'Webinars',
				'singular_name' 		=> 'Webinars',
				'add_new'				=> 'Add Webinar',
				'add_new_item'			=> 'Add New Webinar',
				'edit_item'				=> 'Edit Webinar',
				'new_item'				=> 'New Webinar',
				'all_items'				=> 'All Webinars',
				'view_item'				=> 'View Webinar',
				'search_items'			=> 'Search Webinars',
				'not_found'				=> 'No Webinars found',
				'not_found_in_trash'	=> 'No Webinars found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Webinars',
				'publicly_queryable'	=> true,
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'webinar', 'with_front' => false
			),
			'supports'				=> array(
				'revisions', 'title', 'editor', 'thumbnail', 'author'
			)
		)
	);

	// Presentations
	register_post_type( 'presentations',

		array(
			'labels' 				=> array(
				'name'					=> 'Presentations',
				'singular_name' 		=> 'Presentations',
				'add_new'				=> 'Add Presentation',
				'add_new_item'			=> 'Add New Presentation',
				'edit_item'				=> 'Edit Presentation',
				'new_item'				=> 'New Presentation',
				'all_items'				=> 'All Presentations',
				'view_item'				=> 'View Presentation',
				'search_items'			=> 'Search Presentations',
				'not_found'				=> 'No Presentations found',
				'not_found_in_trash'	=> 'No Presentations found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Presentations',
				'publicly_queryable'	=> true,
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'presentation', 'with_front' => false
			),
			'supports'				=> array(
				'revisions', 'title', 'editor', 'thumbnail', 'author'
			)
		)
	);

	// In The News
	register_post_type( 'the_news',

		array(
			'labels' 				=> array(
				'name'					=> 'In The News',
				'singular_name' 		=> 'In The News',
				'add_new'				=> 'Add In News Item',
				'add_new_item'			=> 'Add In New News Item',
				'edit_item'				=> 'Edit In News Item',
				'new_item'				=> 'New In News Item',
				'all_items'				=> 'All In News Items',
				'view_item'				=> 'View In News Item',
				'search_items'			=> 'Search In News Items',
				'not_found'				=> 'No In News Items found',
				'not_found_in_trash'	=> 'No In News Items found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'In The News',
				'publicly_queryable'	=> true,
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'news', 'with_front' => false
			),
			'supports'				=> array(
				'title', 'author'
			)
		)
	);

	// Cores
	register_post_type( 'cores',
		array(
			'labels' 				=> array(
				'name'					=> 'Cores',
				'singular_name' 		=> 'Cores',
				'add_new'				=> 'Add Core',
				'add_new_item'			=> 'Add Core Product',
				'edit_item'				=> 'Edit Core Item',
				'new_item'				=> 'New Core Item',
				'all_items'				=> 'All Cores',
				'view_item'				=> 'View Core',
				'search_items'			=> 'Search Cores',
				'not_found'				=> 'No Cores found',
				'not_found_in_trash'	=> 'No Cores found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Cores',
				'publicly_queryable'	=> true,
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'core', 'with_front' => false
			),
			'supports'				=> array(
				'title', 'author', 'thumbnail'
			)
		)
	);

	//PARTNERS
	register_post_type( 'partners',
		array(
			'labels' 				=> array(
				'name'					=> 'Partners',
				'singular_name'			=> 'Partners',
				'add_new'				=> 'Add New',
				'add_new_item'			=> 'Add New partner',
				'edit_item'				=> 'Edit partner',
				'new_item'				=> 'New partner',
				'all_items'				=> 'All partners',
				'view_item'				=> 'View Page',
				'search_items'			=> 'Search partners',
				'not_found'				=> 'No partners found',
				'not_found_in_trash'	=> 'No partners found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Partners'
			),
			'public' 				=> true,
			'menu_icon'				=> 'dashicons-groups',
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'imagination-partner', 'with_front' => false
			),
			'supports'				=> array(
				'title', 'editor', 'thumbnail', 'excerpt', 'author'
			)
		)
	);

	// PLATFORMS
	register_post_type( 'platforms',
		array(
			'labels' 				=> array(
				'name'					=> 'Platforms',
				'singular_name'			=> 'Platforms',
				'add_new'				=> 'Add New',
				'add_new_item'			=> 'Add New Platform',
				'edit_item'				=> 'Edit Platform',
				'new_item'				=> 'New Platform',
				'all_items'				=> 'All Platforms',
				'view_item'				=> 'View Page',
				'search_items'			=> 'Search Platforms',
				'not_found'				=> 'No Platforms found',
				'not_found_in_trash'	=> 'No Platforms found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Platforms'
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'platforms', 'with_front' => false
			),

			'supports'				=> array(
				'title', 'editor', 'thumbnail', 'author'
			)
		)
	);

	// SHOWCASE
	register_post_type( 'showcase',
		array(
			'labels' 				=> array(
				'name'					=> 'Showcase',
				'singular_name'			=> 'Showcase',
				'add_new'				=> 'Add New',
				'add_new_item'			=> 'Add New Showcase',
				'edit_item'				=> 'Edit Showcase',
				'new_item'				=> 'New Showcase',
				'all_items'				=> 'All Showcase',
				'view_item'				=> 'View Page',
				'search_items'			=> 'Search Showcase',
				'not_found'				=> 'No Showcase found',
				'not_found_in_trash'	=> 'No Showcase found in Trash',
				'parent_item_colon'		=> '',
				'menu_name'				=> 'Showcase'
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array(
				'slug' => 'showcase', 'with_front' => false
			),
			'supports'				=> array(
				'title', 'editor', 'thumbnail', 'author'
			)
		)
	);

}
add_action('init', 'create_imgtec_post_types');

