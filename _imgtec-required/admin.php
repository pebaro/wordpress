<?php
/**
 * Instructions:
 * To include a new custom post type on the admin page for all custom post types/taxonomies
 * simply add the name of the post type to the appropriate array
 * i.e. if it is to go in the Press Section then add the post type name to the $press array #line 26
 *
 * (admin/editing buttons will be automatically generated on the page
 *  along with any buttons for any taxonomies that are applied to that post type)
 *    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --
 * To add a new Tab simply use standard bootstrap as seen below
 * then create an array for that tab and fill the array with the post type names.
 * For the tab content use the function imgtec_cpt_listings( $array_name );
 * pass in the name of the array as the function argument,
 * if there is no array then place the name of the post type inside an annonymous array
 * e.g. imgtec_cpt_listings( array( 'name-of-post-type' ) );
 *    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --
 * To add a link to a custom page that's tied to a custom post type,
 * use the function imgtec_post_type_page_listing( $class, $imgtec_post_type, $page );
 *    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --
 * See functions.php in the lib folder if you need further info on how the functions work.
 *    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --
 */

	// array arguments for the listings function:
	$press 		= [ 'press_releases', 'our_events', 'webinars', 'presentations', 'the_news' ];
	$partners 	= [ 'partners' ];
	$technology = [ 'cores', 'platforms', 'showcase' ];
	$downloads 	= [ 'downloads', 'download-notes', 'license' ]; 	// Download Manager Plugin

	// array for additional admin pages:
	$pages 		= [ 'download-requests-panel', 'download-reports', 'download-whitelist-page' ];
?>

<h3 style="color: #0073aa;">Custom Post Types, Custom Taxonomies and Downloads, as well as download administration functionality.</h3>

<div class="container col-lg-12 imgtec-cpts">
	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-pr"><h4>PR Section</h4></li>
		<li class="tab-link" data-tab="tab-technology"><h4>Technology Section</h4></li>
		<li class="tab-link" data-tab="tab-partners"><h4>Partners Section</h4></li>
		<li class="tab-link" data-tab="tab-downloads"><h4>Downloads Section</h4></li>
	</ul>
	<div id="tab-pr" class="tab-content current admin-tab-content">
		<?php imgtec_cpt_listings( $press ); ?><!-- Press Section -->
	</div>
	<div id="tab-technology" class="tab-content admin-tab-content">
		<?php imgtec_cpt_listings( $technology ); ?><!-- Technology Section -->
	</div>
	<div id="tab-partners" class="tab-content admin-tab-content">
		<?php imgtec_cpt_listings( $partners ); ?><!-- Partners Section -->
	</div>
	<div id="tab-downloads" class="tab-content admin-tab-content">
		<?php imgtec_cpt_listings( $downloads ); ?><!-- Downloads Section -->

		<h3 class="download-pages-heading">Other Associated Admin Pages</h3>
		<p class="download-buttons-para">
			<?php imgtec_post_type_page_listing( 'download-buttons', $downloads[ 0 ], $pages[ 0 ] ) ?>
			<span class="imgtec-page-link-seperator">|</span>
			<?php imgtec_post_type_page_listing( 'download-buttons', $downloads[ 0 ], $pages[ 1 ] ) ?>
			<span class="imgtec-page-link-seperator">|</span>
			<?php imgtec_post_type_page_listing( 'download-buttons', $downloads[ 0 ], $pages[ 2 ] ) ?>
		</p>
	</div>
</div>


