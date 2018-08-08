<?php // menus and admin menu bar for the imgtec plugin


// =====> Remove Standard Admin Menu Items for Custom Post Types <=====
function remove_custom_menu_items( $menu_order ){

	global $menu;

	foreach ( $menu as $mkey => $m ) {
		$press_releases 	= array_search( 'edit.php?post_type=press_releases', $m );
		$our_events 		= array_search( 'edit.php?post_type=our_events', $m );
		$webinars 			= array_search( 'edit.php?post_type=webinars', $m );
		$presentations 		= array_search( 'edit.php?post_type=presentations', $m );
		$the_news 			= array_search( 'edit.php?post_type=the_news', $m );
		$cores 				= array_search( 'edit.php?post_type=cores', $m );
		$partners 			= array_search( 'edit.php?post_type=partners', $m );
		$platforms 			= array_search( 'edit.php?post_type=platforms', $m );
		$showcase 			= array_search( 'edit.php?post_type=showcase', $m );

		if( 
			$press_releases ||
			$our_events ||
			$webinars ||
			$presentations ||
			$the_news ||
			$cores ||
			$partners ||
			$platforms ||
			$showcase 
		){
			unset( $menu[$mkey] );
		}
	}
	return $menu_order;
}
add_filter( 'menu_order', 'remove_custom_menu_items' );

function toggle_imgtec_menu_order(){
	return true;
}
add_filter( 'custom_menu_order', 'toggle_imgtec_menu_order' );


// =====> Register Menu Page <=====( only user roles: admin, editor, contributor )
function register_imgtec_custom_menu_page() {

	if ( ! current_user_can( 'administrator', 'editor', 'contributor' ) ) return;

    add_menu_page(
        __( 'Custom Post Types', 'textdomain' ),
        'ImgTec Admin', 'manage_options',
        '_imgtec-required/admin.php', '',
        plugins_url( '_imgtec-required/images/imgtec-icon.png' ), 3
    );
}
add_action( 'admin_menu', 'register_imgtec_custom_menu_page' );

function custom_menu_page(){
    esc_html_e( 'Custom Admin Page', 'textdomain' );
}


// =====> Add Sub-Menu in WordPress Admin <=====
function add_sub_menu_custom_posts(){
	$imgtec_cpts = [
		'press_releases', 'our_events', 'webinars', 'presentations', 'the_news',
		'cores', 'partners', 'platforms',
		'showcase'
	];
	foreach ($imgtec_cpts as $cpt) {
		add_submenu_page( '_imgtec-required/admin.php',
			imgtec_cpt_listing_name( $cpt ), imgtec_cpt_listing_name( $cpt ),
			'edit_pages', 'edit.php?post_type='.$cpt
		);
	}
}
add_action('admin_menu', 'add_sub_menu_custom_posts');


// =====> Admin Bar Menu <=====
add_action('wp_before_admin_bar_render', 'admin_menu_bar_cpt_menu', 100);

function admin_menu_bar_cpt_menu(){

	global $wp_admin_bar;
	if( ! current_user_can( 'administrator', 'editor', 'contributor' ) ||
		! is_admin_bar_showing() ||
		! is_object( $wp_admin_bar ) ||
		! function_exists( 'is_admin_bar_showing' ) ||
		! is_admin_bar_showing() )
		: return;
	endif;

	$top_level 			=   'imgtec_admin_menu_bar';
	$downloads_section 	=   'downloads_section';
	$downloads 			= [ 'downloads', 'download-notes', 'license' ];
	$press 				= [ 'press_releases', 'our_events', 'webinars', 'presentations', 'the_news' ];
	$partners 			= [ 'partners' ];
	$technology 		= [ 'cores', 'platforms', 'showcase' ];

// MENU STARTS HERE!!!!!
	$wp_admin_bar->add_menu( // Top Level Menu Item
		array(
			'id' 		=> $top_level,
			'title' 	=> __( 'Imgtec Admin' ),
			'href' 		=> admin_url( '/admin.php?page=_imgtec-required/admin.php' )
		)
	);
	$wp_admin_bar->add_menu( // Global Taxonomies
		array(
			'id' 		=> 'global-taxonomies',
			'parent' 	=> $top_level,
			'title' 	=> __( 'Global Taxonomies' ),
			'href' 		=> admin_url( '/edit-tags.php?taxonomy=global_taxonomies' )
		)
	);

	// PRESS Section
	imgtec_menu_bar_sections( $top_level, 'press_section', $press );

	// TECHNOLOGY Section
	imgtec_menu_bar_sections( $top_level, 'technology_section', $technology );

	// PARTNERS Section
	imgtec_menu_bar_sections( $top_level, 'partners_section', $partners );

	// DOWNLOADS Section
	imgtec_menu_bar_sections( $top_level, $downloads_section, $downloads );
	// Downloads Pages (tied to downloads post type)
	imgtec_menu_bar_page_listing( $downloads_section, $downloads[0], 'download-requests-panel' );
	imgtec_menu_bar_page_listing( $downloads_section, $downloads[0], 'download-reports' );
	imgtec_menu_bar_page_listing( $downloads_section, $downloads[0], 'download-whitelist-page' );
}