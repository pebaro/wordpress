<?php
/**
 * Shortcode to output a simple download block for a file.
 * @param  [Array] $atts 	[Values from the shortcode]
 * @return [string]         [HTML block of to display]
 */
function show_the_download ($atts) {
	// Making sure we have an ID and it matches a download post type
	if( is_numeric($atts['id']) && in_array(get_post_type($atts['id']), array('downloads', 'downloads-arch')) ){

		$download_id = $atts['id'];

		$display_button = (isset($atts['button']) && $atts['button'] == 'false') ? false : true;

		$download_page = get_post_meta( $download_id, 'download_title', true );
		$info = preg_replace('/\s/', '-', $download_page);
		$info = strtolower($info);

		$content = '<div class="download-file">';

		if($display_button == true){
			$content .= '<h3>' . get_post_meta( $download_id, 'download_title', true ) . '</h3>';
		}
		if($display_button == true){
			$content .= show_download_link($download_id, $display_button).' '.show_more_info($download_id);
		} else {
			$content .= show_download_link($download_id, $display_button);
		}
		if($display_button == false && (get_post_meta($download_id, 'download_description', true) || get_post_meta($download_id, 'download_release_notes', true))){
			$content .= ' [<a href="'.site_url('/downloads/').$info.'">more info</a>]';
		}
		$content .= '</div>';

		return $content;
	}
}
add_shortcode("download", "show_the_download");



