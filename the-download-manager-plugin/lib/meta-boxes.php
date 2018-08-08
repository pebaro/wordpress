<?php
/**
 * Creating the meta box to display the download shortcode
 */
function download_post_shortcode_meta_box() {
	if(get_post_status() == 'publish'){
			add_meta_box(
			'download-post-shortcode',
			'Download Shortcode',
			'download_post_meta_box_shortcode',
			'downloads',
			'side',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'download_post_shortcode_meta_box' );

/**
 * Display the shortcode for the download in the meta box
 */
function download_post_meta_box_shortcode(){
?>
	<div id="download-shortcode">
		<p><strong>[download id="<?php echo get_the_ID(); ?>" button="false"]</strong></p>
	</div>
<?php
}

/**
 * Creating the meta box for download statisics
 */
function download_post_statistics_meta_box() {
	add_meta_box(
		'download-post-statistics',
		'Download Statistics',
		'download_post_statistics_meta_box_content',
		'downloads',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'download_post_statistics_meta_box' );

/**
 * Display the statistics within the meta box
 */
function download_post_statistics_meta_box_content(){
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

?>
	<div id="download-statistics">
		<p><strong>This Week:</strong> <?php echo $weekly_download; ?></p>
		<p><strong>Total:</strong> <?php echo get_post_meta( get_the_ID(), 'download_count', true ); ?></p>
		<a href="<?php echo admin_url('/edit.php?post_type=downloads&page=download-reports&download-id='.get_the_ID()); ?>" target="_blank">View Report</a>
	</div>
<?php
}
