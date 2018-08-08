<?php
/**
 * Create a Download Options meta box to contain the download fields
 */
function download_post_meta_box() {
	add_meta_box(
		'download-post-meta',
		'Download Options',
		'download_post_meta_box_content',
		'downloads',
		'normal',
		'low'
	);
}
add_action( 'add_meta_boxes', 'download_post_meta_box' );

/**
 * The fields for inside the Download Options meta box
 * @param  [object] $post [the $post object]
 */
function download_post_meta_box_content( $post ){
	wp_nonce_field( 'download_plugin','download_post_meta_nonce' );
?>
	<div id="download-manager-form" class="download-file-form download-plugin">

		<?php
		// print_r(get_blog_details());

		// $blog_details = get_blog_details();
		// echo $blog_details->blogname;

		// print_r(get_current_screen());

		// $screen = get_current_screen();

		// echo 'post_type = '.$screen->id;

    	//var_dump($screen);

		$blogname = get_blog_option( $blog_id, 'blogname' );
		?>
		<input type="hidden" id="request-site"  name="request-site" value="<?php echo $blogname; ?>" required>
<div class="row">
<div class="col-md-7">
		<div class="form-group">
			<label for="download-title">Download Title <span class="required">*</span></label>
			<input type="text" id="download-title" class="form-control" name="download-title" value="<?php echo get_post_meta( $post->ID, 'download_title', true ); ?>" placeholder="Download Title" required>
		</div>
</div>
<div class="col-md-5">
		<div class="form-group">
			<label for="download-permalink">Download Permalink (shorten if possible) <span class="required">*</span></label>
			<input type="text" id="download-permalink" class="form-control" name="download-permalink" value="<?php echo get_post_meta( $post->ID, 'post_name', true ); ?>" placeholder="Permalink" required>
		</div>
</div>
</div>
<div class="row">
	<div class="col-md-10">
		<div class="form-group">
			<label for="download-link">Download Link <span class="required">*</span></label>
			<input type="text" id="download-link"  class="form-control" name="download-link" value="<?php echo get_post_meta( $post->ID, 'download_link', true ); ?>" placeholder="Download Link" required>
		</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
		<div class="form-group">
			<label for="download-size">Download Size <span class="required">*</span></label>
			<input type="text" id="download-size" class="form-control" name="download-size" value="<?php echo get_post_meta( $post->ID, 'download_size', true ); ?>" placeholder="File Size e.g 24 MB" required>
		</div>

</div>
  <div class="col-md-4">
		<div class="form-group">
			<?php
				// Listing out License Agreements from the license post type
				$download_agreements = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'license', 'orderby' => 'title', 'order' => 'ASC' ) );
				$current_agreement = get_post_meta( $post->ID, 'download_agreement_needed', true );
			?>
			<label for="download-agreement">Download Agreement</label>
			<select id="download-agreement" class="form-control" name="download-agreement-needed">
				<option value="">Select Download Agreement</option>
				<?php
				foreach ($download_agreements as $download_agreement) {
					$selected = ($download_agreement->ID == $current_agreement)? "selected" : "";
					echo '<option value="'.$download_agreement->ID.'" '.$selected.'>'.$download_agreement->post_title.'</option>';
				}
				?>
			</select>
		</div>
   </div>
	<div class="col-md-4">
		<div class="form-group">
			<?php
				// Listing out Download Notes from the Download Notes post type
				$download_release_notes = get_posts( array(
					'posts_per_page' => -1,
					'post_type' => 'download-notes',
					'orderby' => 'title',
					'order' => 'ASC' ) );
				$current_release_notes = get_post_meta( $post->ID, 'download_release_notes', true );
			?>
			<label for="download-release-notes">Release Notes</label>
			<select id="download-release-notes" class="form-control" name="download-release-notes">
				<option value="">Select Release Notes</option>
				<?php
				foreach ($download_release_notes as $release_notes) {
					$selected = ($release_notes->ID == $current_release_notes)? "selected" : "";
					echo '<option value="'.$release_notes->ID.'" '.$selected.'>'.$release_notes->post_title.'</option>';
				}
				?>
			</select>
		</div>
	</div>
</div>

		<div class="form-group">
				<label for="download-description">Download Description</label>
				<?php
				wp_editor(
					get_post_meta( $post->ID, 'download_description', true ),
					'download_description',
					array('textarea_name' => 'download-description')
				);
				?>
		</div>

		<h3>Access Options</h3>

		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkbox-toggle-key" name="download-login-required" <?php echo (get_post_meta( $post->ID, 'download_login_required', true ))? "checked" : ""; ?>>
				Only logged in users?
			</label>
		</div>

		<div class="checkbox-toggle">
			<hr>
			<label>User Roles Allowed</label>
			<div class="row checkbox-list">
				<?php
				// Display the possible user roles.
				$allowed_roles = get_post_meta( $post->ID, 'download_user_roles_allowed', true );

				foreach (get_editable_roles() as $role_name => $role_info) {
					$exclude = array('bbp_','admin','contributor','author','editor');
					$checked = (in_array($role_name, $allowed_roles) || !$allowed_roles)? "checked" : "";

					if (strposa($role_name, $exclude) === false ){
						?>
						<label class="col-md-3">
							<input type="checkbox" name="user-roles-allowed[]" value="<?php echo $role_name; ?>" <?php echo $checked; ?>>
							<?php echo ucfirst($role_name); ?>
						</label>
						<?php
					}
				}
				?>
			</div>
			<hr>
			<div class="checkbox">
				<?php
					$approval_needed = get_post_meta( $post->ID, 'needs_approval', true );
					$approval_email =  get_post_meta( $post->ID, 'approval_email', true );
				?>
				<label>
					<input type="checkbox" class="checkbox-toggle-key" name="needs-approval" <?php echo ($approval_needed)? "checked" : ""; ?>>
					Will this need approval? <small>(requests will be found in the&nbsp;<?php echo $blogname; ?>&nbsp;dashboard)</small>
				</label>
			</div>




			<div class="checkbox-toggle">
	<div class="row">
        <div class="col-md-12">
        	<label for="approval-email">Approval Emails <br><strong>IMPORTANT: Enter one email address per line</strong></label>
        </div>
        <div class="col-md-6">
				<textarea rows="3" type="" id="approval-email" class="form-control" name="approval-email" value="" placeholder="<?php echo get_bloginfo( 'admin_email' ); ?>" ><?php
				if(is_array($approval_email)){
						if ($approval_email != '') {
							foreach ($approval_email as $admin_emails) {
								echo $admin_emails."\r\n";
							}
						}
				};?></textarea>
		</div>
        <div class="col-md-6 checkbox" style="margin-top:0px;">
					<?php
						$describe_intended_use = get_post_meta( $post->ID, 'describe_intended_use', true );
					?>
					<label>
						<input type="checkbox" name="describe-intended-use" <?php echo ($describe_intended_use)? "checked" : ""; ?>>
						Will user need to describe their intended use for this download?
					</label>
				<div class="checkbox">
					<?php
						$iup_package = get_post_meta( $post->ID, 'iup_package', true );
					?>
					<label>
						<input type="checkbox" name="iup-package" <?php echo ($iup_package)? "checked" : ""; ?>>
						Is this description for an IUP download?
					</label>
                    </div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Validate the form in the meta box above on save_posts
 */
function download_post_meta_box_validation(){

    // Checking the nonce.
	if ( ! isset( $_POST['download_post_meta_nonce'] ) ) {
		return;
	}

	// Checking the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['download_post_meta_nonce'], 'download_plugin' ) ) {
		return;
	}

	// Check it's not an auto save.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'downloads' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $_POST['post_ID'] ) ) {
			return;
		}
	}

	// Base the title and permalink off the download info
	$_POST['post_title'] = esc_attr( $_POST['download-title'] );
	$_POST['post_name'] = sanitize_title( $_POST['download-permalink'] );

	// Update the post with new values ( We need to remove action in order to not loop )
	remove_action( 'save_post', 'download_post_meta_box_validation' );
	wp_update_post( $_POST );
	add_action( 'save_post', 'download_post_meta_box_validation' );

	// Get the ID we are storing to.
	$download_id = $_POST['post_ID'];

	// Storing the download links after being escaped.
	update_post_meta( $download_id, 'download_link', esc_url( $_POST['download-link']) );
	update_post_meta( $download_id, 'download_title', esc_attr($_POST['download-title']) );
	update_post_meta( $download_id, 'post_name', esc_attr( $_POST['download-permalink'] ) );
	update_post_meta( $download_id, 'slug', $_POST['post_name'] );
	update_post_meta( $download_id, 'download_icon', esc_attr($_POST['download-icon']) );
	update_post_meta( $download_id, 'download_size', esc_attr($_POST['download-size']) );
	update_post_meta( $download_id, 'download_agreement_needed', $_POST['download-agreement-needed'] );
	update_post_meta( $download_id, 'download_release_notes', $_POST['download-release-notes'] );
	update_post_meta( $download_id, 'download_description', esc_textarea($_POST['download-description']) );


	update_post_meta( $download_id, 'request_site', $_POST['request-site'] );



	// Check if we need approve a download.
	if($_POST['needs-approval'] == 'on' && $_POST['download-login-required'] == 'on'){
		update_post_meta( $download_id, 'needs_approval', true);

		// Turns textarea value into an array and validates it
		$approval_emails = explode("\r\n", esc_textarea($_POST['approval-email']));
		
		// Removes empty rows from array
		$approval_emails = array_filter($approval_emails);
		
		// Validates the emails
		$approval_emails = array_map('sanitize_email', $approval_emails);
		
		// Save our array of emails
		update_post_meta( $download_id, 'approval_email', $approval_emails );

		// old
		// update_post_meta( $download_id, 'approval_email', sanitize_email( $_POST['approval-email']) );
	} else {
		update_post_meta( $download_id, 'needs_approval', false);
	}

	// Check if we need to store user roles and what they are.
	if( $_POST['download-login-required'] == 'on' ){
		update_post_meta($download_id, 'download_login_required', true );
		update_post_meta($download_id, 'download_user_roles_allowed', $_POST['user-roles-allowed'] );
	} else {
		update_post_meta($download_id, 'download_login_required', false );
		update_post_meta($download_id, 'download_user_roles_allowed', '' );
	}



	// Check if a description of intended use is required
	if( $_POST['describe-intended-use'] == 'on' ){
		update_post_meta($download_id, 'describe_intended_use', true );
	} else {
		update_post_meta($download_id, 'describe_intended_use', false );
	}
	// Check if a description of intended use is for an IUP download
	if( $_POST['iup-package'] == 'on' ){
		update_post_meta($download_id, 'iup_package', true );
	} else {
		update_post_meta($download_id, 'iup_package', false );
	}




	// If we don't have a download count set it to 0
	if(!get_post_meta( $download_id, 'download_count', true)){ update_post_meta( $download_id, 'download_count', 0 ); }

}
add_action( 'save_post', 'download_post_meta_box_validation' );