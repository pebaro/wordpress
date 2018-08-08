<?php
/**
 * The ID of the current post
 * @var [int]
 */
$post_id = get_the_ID();

/**
 * Load in our extra meta as well as the normal content
 */
?>
<div class="download-content">
	<div class="media">
		<div class="media-left"><?php
			if(has_post_thumbnail()){

				the_post_thumbnail( 'thumbnail', array('class' => "alignleft download-featured") );

			} else {

				echo '<img src="'. plugins_url( 'the-download-manager-plugin/assets/public/images/logo.svg' ) .'" 
				class="thumbnail alignleft download-featured">';

			} ?>
		</div>
		<div class="media-body">
			<p><?php 
				if($download_description = get_post_meta( $post_id, 'download_description', true )) {

					echo '<span class="download-description"><strong>Download Description:</strong></span>' 
						. wpautop( $download_description ) . '<br>';

				}
				if($release_notes = get_post_meta( $post_id, 'download_release_notes', true )) { ?>

					<div class="release-notes">
						<?php 
							show_the_download_link(get_the_ID(), true); 
							echo ' &nbsp; ' . release_notes_btn(get_the_ID(), true); 
						?>
					</div><?php 

				} else { 

					show_the_download_link(get_the_ID(), true);

				} ?>
			</p>
		</div>
	</div>
</div>

