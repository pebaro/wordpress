<?php

function create_imgtec_taxonomies(){

	// // Release Types
	// $labels_release_types = array(
	// 	'name'              => _x( 'Release Types', 'taxonomy general name' ),
	// 	'singular_name'     => _x( 'Release Type', 'taxonomy singular name' ),
	// 	'search_items'      => __( 'Search Release Types' ),
	// 	'all_items'         => __( 'All Release Types' ),
	// 	'parent_item'       => __( 'Parent Release Type' ),
	// 	'parent_item_colon' => __( 'Parent Release Type:' ),
	// 	'edit_item'         => __( 'Edit Release Type' ),
	// 	'update_item'       => __( 'Update Release Types' ),
	// 	'add_new_item'      => __( 'Add New Release Type' ),
	// 	'new_item_name'     => __( 'New Release Type Name' ),
	// 	'menu_name'         => __( 'Release Type' )
	// );
	// $args_release_types = array(
	// 	'hierarchical'      => true,
	// 	'labels'            => $labels_release_types,
	// 	'show_ui'           => true,
	// 	'show_admin_column' => true,
	// 	'query_var'         => true,
	// 	'rewrite'           => array(
	// 		'slug' => 'release-type'
	// 	)
	// );
	// register_taxonomy(
	// 	'release_types', array(
	// 		'press_releases'
	// 	), $args_release_types
	// );

	// Global Taxonomies
	$labels_global_taxonomies = array(
		'name'              => _x( 'Global Taxonomies', 'taxonomy general name' ),
		'singular_name'     => _x( 'Global Taxonomies', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Taxonomies' ),
		'all_items'         => __( 'All Taxonomies' ),
		'parent_item'       => __( 'Parent Taxonomy' ),
		'parent_item_colon' => __( 'Parent Taxonomy:' ),
		'edit_item'         => __( 'Edit Taxonomy' ),
		'update_item'       => __( 'Update Taxonomy' ),
		'add_new_item'      => __( 'Add New Taxonomy' ),
		'new_item_name'     => __( 'New Taxonomy Name' ),
		'menu_name'         => __( 'Global Taxonomies' )
	);
	$args_global_taxonomies = array(
		'hierarchical'      => true,
		'labels'            => $labels_global_taxonomies,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'global-taxonomies'
		)
	);
	register_taxonomy(
		'global_taxonomies', array(
			'press_releases', 'the_news'
		), $args_global_taxonomies
	);

	// Events Technologies
	$labels_event_technologies = array(
		'name'              => _x( 'Event Technologies', 'taxonomy general name' ),
		'singular_name'     => _x( 'Event Technologies', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Event Technologies' ),
		'all_items'         => __( 'All Event Technologies' ),
		'parent_item'       => __( 'Parent Event Technology' ),
		'parent_item_colon' => __( 'Parent Event Technology:' ),
		'edit_item'         => __( 'Edit Event Technology' ),
		'update_item'       => __( 'Update Event Technology' ),
		'add_new_item'      => __( 'Add New Event Technology' ),
		'new_item_name'     => __( 'New Event Technology Name' ),
		'menu_name'         => __( 'Event Technologies' )
	);
	$args_event_technologies = array(
		'hierarchical'      => true,
		'labels'            => $labels_event_technologies,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/technology'
		)
	);
	register_taxonomy(
		'event_technologies', array(
			'our_events'
		), $args_event_technologies
	);

	// Events Markets
	$labels_event_markets = array(
		'name'              => _x( 'Event Markets', 'taxonomy general name' ),
		'singular_name'     => _x( 'Event Markets', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Event Markets' ),
		'all_items'         => __( 'All Event Markets' ),
		'parent_item'       => __( 'Parent Event Market' ),
		'parent_item_colon' => __( 'Parent Event Market:' ),
		'edit_item'         => __( 'Edit Event Market' ),
		'update_item'       => __( 'Update Event Market' ),
		'add_new_item'      => __( 'Add New Event Market' ),
		'new_item_name'     => __( 'New Event Market Name' ),
		'menu_name'         => __( 'Event Markets' )
	);
	$args_event_markets = array(
		'hierarchical'      => true,
		'labels'            => $labels_event_markets,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/market'
		)
	);
	register_taxonomy(
		'event_markets', array(
			'our_events'
		), $args_event_markets
	);

	// Events Categories
	$labels_event_categories = array(
		'name'              => _x( 'Event Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Event Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Event Categories' ),
		'all_items'         => __( 'All Event Categories' ),
		'parent_item'       => __( 'Parent Event Category' ),
		'parent_item_colon' => __( 'Parent Event Category:' ),
		'edit_item'         => __( 'Edit Event Category' ),
		'update_item'       => __( 'Update Event Category' ),
		'add_new_item'      => __( 'Add New Event Category' ),
		'new_item_name'     => __( 'New Event Category Name' ),
		'menu_name'         => __( 'Event Categories' )
	);
	$args_event_categories = array(
		'hierarchical'      => true,
		'labels'            => $labels_event_categories,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/category'
		)
	);
	register_taxonomy(
		'event_categories', array(
			'our_events'
		), $args_event_categories
	);

	// Webinar Technologies
	$labels_webinar_technologies = array(
		'name'              => _x( 'Webinar Technologies', 'taxonomy general name' ),
		'singular_name'     => _x( 'Webinar Technologies', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Webinar Technologies' ),
		'all_items'         => __( 'All Webinar Technologies' ),
		'parent_item'       => __( 'Parent Webinar Technology' ),
		'parent_item_colon' => __( 'Parent Webinar Technology:' ),
		'edit_item'         => __( 'Edit Webinar Technology' ),
		'update_item'       => __( 'Update Webinar Technology' ),
		'add_new_item'      => __( 'Add New Webinar Technology' ),
		'new_item_name'     => __( 'New Webinar Technology Name' ),
		'menu_name'         => __( 'Webinar Technologies' )
	);
	$args_webinar_technologies = array(
		'hierarchical'      => true,
		'labels'            => $labels_webinar_technologies,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/webinar/technology'
		)
	);
	register_taxonomy(
		'webinar_technologies', array(
			'webinars'
		), $args_webinar_technologies
	);

	// Webinar Markets
	$labels_webinar_markets = array(
		'name'              => _x( 'Webinar Markets', 'taxonomy general name' ),
		'singular_name'     => _x( 'Webinar Markets', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Webinar Markets' ),
		'all_items'         => __( 'All Webinar Markets' ),
		'parent_item'       => __( 'Parent Webinar Market' ),
		'parent_item_colon' => __( 'Parent Webinar Market:' ),
		'edit_item'         => __( 'Edit Webinar Market' ),
		'update_item'       => __( 'Update Webinar Market' ),
		'add_new_item'      => __( 'Add New Webinar Market' ),
		'new_item_name'     => __( 'New Webinar Market Name' ),
		'menu_name'         => __( 'Webinar Markets' )
	);
	$args_webinar_markets = array(
		'hierarchical'      => true,
		'labels'            => $labels_webinar_markets,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/webinar/market'
		)
	);
	register_taxonomy(
		'webinar_markets', array(
			'webinars'
		), $args_webinar_markets
	);

	// Webinar Categories
	$labels_webinar_categories = array(
		'name'              => _x( 'Webinar Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Webinar Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Webinar Categories' ),
		'all_items'         => __( 'All Webinar Categories' ),
		'parent_item'       => __( 'Parent Webinar Category' ),
		'parent_item_colon' => __( 'Parent Webinar Category:' ),
		'edit_item'         => __( 'Edit Webinar Category' ),
		'update_item'       => __( 'Update Webinar Category' ),
		'add_new_item'      => __( 'Add New Webinar Category' ),
		'new_item_name'     => __( 'New Webinar Category Name' ),
		'menu_name'         => __( 'Webinar Categories' )
	);
	$args_webinar_categories = array(
		'hierarchical'      => true,
		'labels'            => $labels_webinar_categories,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/webinar/category'
		)
	);
	register_taxonomy(
		'webinar_categories', array(
			'webinars'
		), $args_webinar_categories
	);

	// Presentation Technologies
	$labels_presentation_technologies = array(
		'name'              => _x( 'Presentation Technologies', 'taxonomy general name' ),
		'singular_name'     => _x( 'Presentation Technologies', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Presentation Technologies' ),
		'all_items'         => __( 'All Presentation Technologies' ),
		'parent_item'       => __( 'Parent Presentation Technology' ),
		'parent_item_colon' => __( 'Parent Presentation Technology:' ),
		'edit_item'         => __( 'Edit Presentation Technology' ),
		'update_item'       => __( 'Update Presentation Technology' ),
		'add_new_item'      => __( 'Add New Presentation Technology' ),
		'new_item_name'     => __( 'New Presentation Technology Name' ),
		'menu_name'         => __( 'Presentation Technologies' )
	);
	$args_presentation_technologies = array(
		'hierarchical'      => true,
		'labels'            => $labels_presentation_technologies,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/presentation/technology'
		)
	);
	register_taxonomy(
		'presentation_technologies', array(
			'presentations'
		), $args_presentation_technologies
	);

	// Presentation Markets
	$labels_presentation_markets = array(
		'name'              => _x( 'Presentation Markets', 'taxonomy general name' ),
		'singular_name'     => _x( 'Presentation Markets', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Presentation Markets' ),
		'all_items'         => __( 'All Presentation Markets' ),
		'parent_item'       => __( 'Parent Presentation Market' ),
		'parent_item_colon' => __( 'Parent Presentation Market:' ),
		'edit_item'         => __( 'Edit Presentation Market' ),
		'update_item'       => __( 'Update Presentation Market' ),
		'add_new_item'      => __( 'Add New Presentation Market' ),
		'new_item_name'     => __( 'New Presentation Market Name' ),
		'menu_name'         => __( 'Presentation Markets' )
	);
	$args_presentation_markets = array(
		'hierarchical'      => true,
		'labels'            => $labels_presentation_markets,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/presentation/market'
		)
	);
	register_taxonomy(
		'presentation_markets', array(
			'presentations'
		), $args_presentation_markets
	);

	// Presentation Categories
	$labels_presentation_categories = array(
		'name'              => _x( 'Presentation Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Presentation Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Presentation Categories' ),
		'all_items'         => __( 'All Presentation Categories' ),
		'parent_item'       => __( 'Parent Presentation Category' ),
		'parent_item_colon' => __( 'Parent Presentation Category:' ),
		'edit_item'         => __( 'Edit Presentation Category' ),
		'update_item'       => __( 'Update Presentation Category' ),
		'add_new_item'      => __( 'Add New Presentation Category' ),
		'new_item_name'     => __( 'New Presentation Category Name' ),
		'menu_name'         => __( 'Presentation Categories' )
	);
	$args_presentation_categories = array(
		'hierarchical'      => true,
		'labels'            => $labels_presentation_categories,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'events/presentation/category'
		)
	);
	register_taxonomy(
		'presentation_categories', array(
			'presentations'
		), $args_presentation_categories
	);

	// Event Type
	// $labels_event_type = array(
	// 	'name'              => _x( 'Event Type', 'taxonomy general name' ),
	// 	'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
	// 	'search_items'      => __( 'Search Event Type' ),
	// 	'all_items'         => __( 'All Event Type' ),
	// 	'parent_item'       => __( 'Parent Event Type' ),
	// 	'parent_item_colon' => __( 'Parent Event Type:' ),
	// 	'edit_item'         => __( 'Edit Event Type' ),
	// 	'update_item'       => __( 'Update Event Type' ),
	// 	'add_new_item'      => __( 'Add New Event Type' ),
	// 	'new_item_name'     => __( 'New Event Type Name' ),
	// 	'menu_name'         => __( 'Event Type' )
	// );
	// $args_event_type = array(
	// 	'hierarchical'      => true,
	// 	'labels'            => $labels_event_type,
	// 	'show_ui'           => true,
	// 	'show_admin_column' => true,
	// 	'query_var'         => true
	// );
	// register_taxonomy(
	// 	'event_type', array(
	// 		'our_events'
	// 	), $args_event_type
	// );

	// GPU Series
	$labels_gpu_series = array(
		'name'              => _x( 'GPU Series', 'taxonomy general name' ),
		'singular_name'     => _x( 'GPU Series', 'taxonomy singular name' ),
		'search_items'      => __( 'Search GPU Series' ),
		'all_items'         => __( 'All GPU Series' ),
		'parent_item'       => __( 'Parent Series' ),
		'parent_item_colon' => __( 'Parent Series:' ),
		'edit_item'         => __( 'Edit GPU Series' ),
		'update_item'       => __( 'Update GPU Series' ),
		'add_new_item'      => __( 'Add New GPU Series' ),
		'new_item_name'     => __( 'New GPU Series Name' ),
		'menu_name'         => __( 'GPU Series' )
	);
	$args_gpu_series = array(
		'hierarchical'      => true,
		'labels'            => $labels_gpu_series,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'gpu-series'
		)
	);
	register_taxonomy(
		'gpu_series', array(
			'cores'
		), $args_gpu_series
	);

	// PERFORMANCE TIERS
	$labels_performance_tiers = array(
		'name'              => _x( 'Performance Tiers', 'taxonomy general name' ),
		'singular_name'     => _x( 'Performance Tiers', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Performance Tiers' ),
		'all_items'         => __( 'All Performance Tiers' ),
		'parent_item'       => __( 'Parent Tier' ),
		'parent_item_colon' => __( 'Parent Tier:' ),
		'edit_item'         => __( 'Edit Performance Tier' ),
		'update_item'       => __( 'Update Performance Tier' ),
		'add_new_item'      => __( 'Add New Performance Tier' ),
		'new_item_name'     => __( 'New Performance Tier Name' ),
		'menu_name'         => __( 'Performance Tiers' )
	);
	$args_performance_tiers = array(
		'hierarchical'      => true,
		'labels'            => $labels_performance_tiers,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'performance-tier'
		)
	);
	register_taxonomy(
		'performance-tiers', array(
			'cores'
		), $args_performance_tiers
	);

	// ARCHITECTURE
	$labels_architecture = array(
		'name'              => _x( 'Architecture', 'taxonomy general name' ),
		'singular_name'     => _x( 'Architecture', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Architectures' ),
		'all_items'         => __( 'All Architectures' ),
		'parent_item'       => __( 'Parent Architecture' ),
		'parent_item_colon' => __( 'Parent Architecture:' ),
		'edit_item'         => __( 'Edit Architecture' ),
		'update_item'       => __( 'Update Architecture' ),
		'add_new_item'      => __( 'Add New Architecture' ),
		'new_item_name'     => __( 'New Architecture Name' ),
		'menu_name'         => __( 'Architectures' )
	);
	$args_architecture = array(
		'hierarchical'      => true,
		'labels'            => $labels_architecture,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'core-architecture'
		)
	);
	register_taxonomy(
		'core-architectures', array(
			'cores'
		), $args_architecture
	);

	// PRODUCT MARKETS
	$labels_product_markets = array(
		'name'              => _x( 'Product Markets', 'taxonomy general name' ),
		'singular_name'     => _x( 'Product Markets', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Product Markets' ),
		'all_items'         => __( 'All Product Markets' ),
		'parent_item'       => __( 'Parent Market' ),
		'parent_item_colon' => __( 'Parent Market:' ),
		'edit_item'         => __( 'Edit Product Market' ),
		'update_item'       => __( 'Update Product Market' ),
		'add_new_item'      => __( 'Add New Product Market' ),
		'new_item_name'     => __( 'New Product Market Name' ),
		'menu_name'         => __( 'Product Markets' )
	);
	$args_product_markets = array(
		'hierarchical'      => true,
		'labels'            => $labels_product_markets,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'product-market'
		)
	);
	register_taxonomy(
		'product-markets', array(
			'cores'
		), $args_product_markets
	);

	// PARTNERS (Partner Type)
	$labels_partner_type = array(
		'name'              => _x( 'Partner Type', 'taxonomy general name' ),
		'singular_name'     => _x( 'Partner Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Partner Type' ),
		'all_items'         => __( 'All Partner Type' ),
		'parent_item'       => __( 'Parent Partner Type' ),
		'parent_item_colon' => __( 'Parent Partner Type:' ),
		'edit_item'         => __( 'Edit Partner Type' ),
		'update_item'       => __( 'Update Partner Type' ),
		'add_new_item'      => __( 'Add New Partner Type' ),
		'new_item_name'     => __( 'New Partner Type Name' ),
		'menu_name'         => __( 'Partner Type' )
	);
	$args_partner_type = array(
		'hierarchical'      => true,
		'labels'            => $labels_partner_type,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		//'rewrite'           => array(  'slug'=> 'partners' )
	);
	register_taxonomy( 'partner-type', array( 'partners' ), $args_partner_type );

	// PARTNERS (Products)
	$labels_products = array(
		'name'              => _x( 'Products', 'taxonomy general name' ),
		'singular_name'     => _x( 'Products', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Products' ),
		'all_items'         => __( 'All Products' ),
		'parent_item'       => __( 'Parent Products' ),
		'parent_item_colon' => __( 'Parent Products:' ),
		'edit_item'         => __( 'Edit Products' ),
		'update_item'       => __( 'Update Products' ),
		'add_new_item'      => __( 'Add New Products' ),
		'new_item_name'     => __( 'New Products Name' ),
		'menu_name'         => __( 'Products' )
	);
	$args_products = array(
		'hierarchical'      => true,
		'labels'            => $labels_products,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);
	register_taxonomy( 'partner-products', array( 'partners'), $args_products );

	// PARTNERS (Markets)
	$labels_markets = array(
		'name'              => _x( 'Markets', 'taxonomy general name' ),
		'singular_name'     => _x( 'Markets', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Markets' ),
		'all_items'         => __( 'All Markets' ),
		'parent_item'       => __( 'Parent Markets' ),
		'parent_item_colon' => __( 'Parent Markets:' ),
		'edit_item'         => __( 'Edit Markets' ),
		'update_item'       => __( 'Update Markets' ),
		'add_new_item'      => __( 'Add New Markets' ),
		'new_item_name'     => __( 'New Markets Name' ),
		'menu_name'         => __( 'Markets' )
	);
	$args_markets = array(
		'hierarchical'      => true,
		'labels'            => $labels_markets,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);
	register_taxonomy( 'partner-markets', array( 'partners' ), $args_markets );

	// PARTNERS (Design Services)
	$labels_design_services = array(
		'name'              => _x( 'Design Services', 'taxonomy general name' ),
		'singular_name'     => _x( 'Design Services', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Design Services' ),
		'all_items'         => __( 'All Design Services' ),
		'parent_item'       => __( 'Parent Design Services' ),
		'parent_item_colon' => __( 'Parent Design Services:' ),
		'edit_item'         => __( 'Edit Design Services' ),
		'update_item'       => __( 'Update Design Services' ),
		'add_new_item'      => __( 'Add New Design Services' ),
		'new_item_name'     => __( 'New Design Services Name' ),
		'menu_name'         => __( 'Design Services' )
	);
	$args_design_services = array(
		'hierarchical'      => true,
		'labels'            => $labels_design_services,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);
	register_taxonomy( 'design-services', array( 'partners' ), $args_design_services );

	// PARTNERS (Geography)
	$labels_geography = array(
		'name'              => _x( 'Geography', 'taxonomy general name' ),
		'singular_name'     => _x( 'Geography', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Geography' ),
		'all_items'         => __( 'All Geography' ),
		'parent_item'       => __( 'Parent Geography' ),
		'parent_item_colon' => __( 'Parent Geography:' ),
		'edit_item'         => __( 'Edit Geography' ),
		'update_item'       => __( 'Update Geography' ),
		'add_new_item'      => __( 'Add New Geography' ),
		'new_item_name'     => __( 'New Geography Name' ),
		'menu_name'         => __( 'Geography' )
	);
	$args_geography = array(
		'hierarchical'      => true,
		'labels'            => $labels_geography,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);
	register_taxonomy( 'geography', array( 'partners' ), $args_geography );


	// PLATFORMS (Product Category)
	$labels_product_category = array(
		'name'              => _x( 'Product Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Product Category' ),
		'all_items'         => __( 'All Product Category' ),
		'parent_item'       => __( 'Parent Product Category' ),
		'parent_item_colon' => __( 'Parent Product Category:' ),
		'edit_item'         => __( 'Edit Product Category' ),
		'update_item'       => __( 'Update Product Category' ),
		'add_new_item'      => __( 'Add New Product Category' ),
		'new_item_name'     => __( 'New Product Category Name' ),
		'menu_name'         => __( 'Product Category' )
	);
	$args_product_category = array(
		'hierarchical'      => true,
		'labels'            => $labels_product_category,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(  'slug'=> 'platforms', 'with_front' => false )
	);
	register_taxonomy( 'product_category', array( 'platforms' ), $args_product_category );


	// PLATFORMS (Product Tags)
	$labels_product_tags = array(
		'name'              => _x( 'Product Tags', 'taxonomy general name' ),
		'singular_name'     => _x( 'Product Tags', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Product Tags' ),
		'all_items'         => __( 'All Product Tags' ),
		'parent_item'       => __( 'Parent Product Tags' ),
		'parent_item_colon' => __( 'Parent Product Tags:' ),
		'edit_item'         => __( 'Edit Product Tags' ),
		'update_item'       => __( 'Update Product Tags' ),
		'add_new_item'      => __( 'Add New Product Tags' ),
		'new_item_name'     => __( 'New Product Tags Name' ),
		'menu_name'         => __( 'Product Tags' )
	);
	$args_product_tags = array(
		'hierarchical'      => true,
		'labels'            => $labels_product_tags,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(  'slug'=> 'platforms', 'with_front' => false )
	);
	register_taxonomy( 'product_tags', array( 'platforms' ), $args_product_tags );


	// SHOWCASE (showcasing)
	$labels_showcasing = array(
		'name'              => _x( 'Showcasing', 'taxonomy general name' ),
		'singular_name'     => _x( 'Showcasing', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Showcasing' ),
		'all_items'         => __( 'All Showcasing' ),
		'parent_item'       => __( 'Parent Showcasing' ),
		'parent_item_colon' => __( 'Parent Showcasing:' ),
		'edit_item'         => __( 'Edit Showcasing' ),
		'update_item'       => __( 'Update Showcasing' ),
		'add_new_item'      => __( 'Add New Showcasing' ),
		'new_item_name'     => __( 'New Showcasing Name' ),
		'menu_name'         => __( 'Showcasing' )
	);
	$args_showcasing = array(
		'hierarchical'      => true,
		'labels'            => $labels_showcasing,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		//'rewrite'           => array(  'slug'=> 'boards' )
	);
	register_taxonomy( 'showcasing', array( 'showcase', 'powervr_developers' ), $args_showcasing );

}
add_action( 'init', 'create_imgtec_taxonomies', 0 );