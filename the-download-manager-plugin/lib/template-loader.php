<?php
/**
 * Loading custom download template for archives
 * @param  [string] $archive_template [template to load]
 * @return [string]                   [new template to load]
 */
function load_custom_downloads_archive_template( $archive_template ) {
    if ( is_post_type_archive ( 'downloads' ) ) {
        $archive_template = DOWNLOAD_BASE_DIRECTORY . '/download-templates/download-list.php';
    }
    return $archive_template;
}
add_filter( 'archive_template', 'load_custom_downloads_archive_template' );

/**
 * Loading custom download template for terms
 * @param  [string] $taxonomy_template [the term template to load]
 * @return [string]                    [the new tempalte to load]
 */
function load_custom_downloads_taxonomy_template($taxonomy_template) {
     global $post;
     if ($post->post_type == 'downloads') {
          $taxonomy_template = DOWNLOAD_BASE_DIRECTORY . '/download-templates/download-list.php';
     }
     return $taxonomy_template;
}
add_filter( "taxonomy_template", "load_custom_downloads_taxonomy_template" ) ;

/**
 * Hooking into the_content for theme intergration
 * @param  [string] $content [The posts WYSIWYG content]
 * @return [string]          [The new page content]
 */
function show_download_meta ($content){
	// Post ID
	$post_id = get_the_ID();

	// If it's a generic post type send it back with the default
	if ( get_post_type( $post_id ) != 'downloads' ) {
        return $content;
	}

	// If we are looking at a single download get our custom template part.
	if (is_single() || is_category('download-categories') || is_tag('download-tags') ) {
		// We need to remove the action to prevent loops.
		remove_action('the_content', 'show_download_meta');
		ob_start(); // begin collecting output
		include( DOWNLOAD_BASE_DIRECTORY . '/download-templates/download-view.php' );
		$content = ob_get_clean(); // retrieve output, stop buffering
		add_action('the_content', 'show_download_meta');
	}

	return $content;
}
add_action('the_content', 'show_download_meta');
add_action('get_the_content', 'show_download_meta');

/**
 * Outputs the content for the license
 */
function add_download_terms_agreement( $content ) {
    $post_type = get_post_type();
    // Make this into a modal
    if($post_type === 'license') {
        $agreement_form  = '<form class="form-horizontal" role="form" action="" method="POST">';
        $agreement_form .= wp_nonce_field('agreement_nonce', 'agreement_nonce_field');
        $agreement_form .= '<input type="hidden" name="submitted" id="submitted" value="true">';
        $agreement_form .= '<div class="form-group">';
        $agreement_form .= '<button class="btn btn-primary pull-right" id="submit-request" type="submit">I agree to the above license</button>';
        $agreement_form .= '</div>';
        $agreement_form .= '</form>';
        $content = $content . $agreement_form;
    }

    return $content;
}
add_filter( 'the_content', 'add_download_terms_agreement' );

/**
 * Echo out a Numeric Pagination
 * @param  [string]  $pages [number of pages]
 * @param  [integer] $range [range of pages to show]
 */
function downloads_archive_pagination($pages = '', $range = 4){
    $showitems = ($range * 2)+1;

    global $paged;
    global $wp_query;

    if(empty($paged)) $paged = 1;

    if($pages == ''){
        $pages = $wp_query->max_num_pages;
        if(!$pages){
            $pages = 1;
        }
    }

    if(1 != $pages){
        echo "<nav>\n";
        echo "<ul class=\"pagination pagination-sm\">\n";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>\n";
        if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>\n";
        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<li class=\"active\"><span class=\"page-numbers\">".$i."</span></li>\n" : "<li><a href='".get_pagenum_link($i)."' class=\"page-numbers\">".$i."</a></li>\n";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\" class=\"next page-numbers\">Next &rsaquo;</a></li>\n";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' class=\"next page-numbers\">Last &raquo;</a></li>\n";
        echo "</ul>\n";
        echo "</nav>\n";
    }
}
