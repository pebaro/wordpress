<?php
// replace names or parts of names
function imgtec_admin_string_formatting( $heading ){
	$heading = str_replace( '_', ' ', $heading );
	$heading = str_replace( '-', ' ', $heading );

	return $heading;
}
// name of the post type post editing via function imgtec_admin_string_formatting()
function imgtec_cpt_listing_name( $heading ){
	if( strpos( $heading, 'download-notes' ) !== false )
		$heading = str_replace( 'download', 'release', $heading );
	if( strpos( $heading, 'license' ) !== false )
		$heading = str_replace( 'license', 'license agreements', $heading );
	if( strpos( $heading, 'the_news' ) !== false )
		$heading = str_replace( 'the', 'in the', $heading );
	if( strpos( $heading, 'requests-panel' ) !== false )
		$heading = str_replace( 'requests-panel', 'requests', $heading );
	if( strpos( $heading, 'download-whitelist-page' ) !== false )
		$heading = str_replace( 'download-whitelist-page', 'email whitelist', $heading );
	if ( strpos( $heading, 'gpu_series') !== false )
		$heading = str_replace( 'gpu_series', 'GPU Series', $heading );

	return ucwords( imgtec_admin_string_formatting( $heading ) );

}
// generate the admin/edit buttons for the post type
function imgtec_cpt_listing_buttons( $post_type ){
	$buttons  =
		'<a href="edit.php?post_type='.$post_type.'">View All</a>' .
		'<a href="edit.php?post_status=publish&amp;post_type='.$post_type.'">View Published</a>' .
		'<a href="edit.php?post_status=draft&amp;post_type='.$post_type.'">View Drafts</a>' .
		'<a href="post-new.php?post_type='.$post_type.'">Add New</a>';

	return $buttons;
}
// get the taxonomies for the post type and output them as buttons
function imgtec_cpt_listing_taxonomies( $type ){
	$taxonomies = get_object_taxonomies( $type );

	if( $taxonomies ){
		foreach ( $taxonomies as $taxonomy ) {
			echo
				'<a href="edit-tags.php?taxonomy='.$taxonomy
				.'&amp;post_type='.$type.'">Edit '
				.imgtec_cpt_listing_name( $taxonomy ).'</a>';
		}
	} else {
		echo '<h5 class="none-applied"><span class="red">None applied</span> to &nbsp;
			  <i class="fa fa-angle-double-right" aria-hidden="true"></i> &nbsp;<strong>' .
			  imgtec_cpt_listing_name( $type ) . '</strong> post type</h5>';
	}
}


// generate the listings for each of the post types
function imgtec_cpt_listings( $types ){
	foreach ( $types as $type ) {
		echo '<div class="imgtec-cpt-listing"><span class="imgtec-options">';
		echo '<h3>'.imgtec_cpt_listing_name( $type ).'</h3>';
		echo imgtec_cpt_listing_buttons( $type );
		echo '</span><span class="imgtec-taxonomies">';
		echo '<h4 style="margin: 25px 0 8px !important;"><strong>Taxonomies:</strong></h4>';
		echo imgtec_cpt_listing_taxonomies( $type );
		echo '</span></div>';
	}
}
// link to pages attached to a post type
function imgtec_post_type_page_listing( $class, $imgtec_post_type, $page ){
	$link = '<a href="' . admin_url( '/edit.php?post_type='.$imgtec_post_type.'&page='.$page ).'"
			 class="' . $class . '" >' .
			 imgtec_cpt_listing_name( $page ) . '</a>';

	echo $link;
}


/* --------------------------------
 * Functions for the Admin Menu Bar
 */
// Create the sub-menu items in the menu from the taxonomies applied to that post type
function imgtec_menu_bar_taxonomies( $imgtec_post_type ){
	global $wp_admin_bar;

	$sub_menu_items = get_object_taxonomies( $imgtec_post_type );

	if ( $sub_menu_items ) {
		foreach ( $sub_menu_items as $sub_menu_item ) {

			$wp_admin_bar_item = $wp_admin_bar->add_menu(
				array(
					'id' 		=> $sub_menu_item,
					'parent' 	=> $imgtec_post_type,
					'title' 	=> __( imgtec_cpt_listing_name( $sub_menu_item ) ),
					'href' 		=> admin_url( '/edit-tags.php?taxonomy='.$sub_menu_item )
				)
			);
		}
	}
}
// Create the post type menu links
function imgtec_menu_bar_post_types( $section, $imgtec_post_types ){
	global $wp_admin_bar;

	foreach ( $imgtec_post_types as $imgtec_post_type ) {

		$wp_admin_bar->add_menu(
			array(
				'id' 		=> $imgtec_post_type,
				'parent' 	=> $section,
				'title' 	=> __( imgtec_cpt_listing_name( $imgtec_post_type ) ),
				'href' 		=> admin_url( '/edit.php?post_type='.$imgtec_post_type )
			)
		);
		imgtec_menu_bar_taxonomies( $imgtec_post_type );
	}
}
// Create the section titles, linking to the main admin page
function imgtec_menu_bar_sections( $parent, $section, $imgtec_post_types ){
	global $wp_admin_bar;

	$wp_admin_bar->add_menu(
		array(
			'id' 		=> $section,
			'parent' 	=> $parent,
			'title' 	=> __( imgtec_cpt_listing_name( $section ) ),
			'href' 		=> admin_url( '/admin.php?page=_imgtec-required/admin.php' )
		)
	);
	imgtec_menu_bar_post_types( $section, $imgtec_post_types );
}
// single admin page listing
function imgtec_menu_bar_page_listing( $section, $imgtec_post_type, $page ){
	global $wp_admin_bar;

	$wp_admin_bar->add_menu(
		array(
			'id' 		=> $page,
			'parent' 	=> $section,
			'title' 	=> __( imgtec_cpt_listing_name( $page ) ),
			'href' 		=> admin_url( '/edit.php?post_type='.$imgtec_post_type.'&page='.$page )
		)
	);
}
