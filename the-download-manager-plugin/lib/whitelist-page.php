<div id="downloads-whitelist" class="download-plugin">
	<h2>Download Whitelist</h2>
	<?php
		// If we get an error back it failed to update
		if(isset($_GET['error']) && $_GET['error'] == true ){
			?>
			<div id="message" class="error below-h2"><p>There was an issue updating the whitelist.</p></div>
			<?php
		} 
	?>

	<div class="row">
		<div class="col-md-3">
			<form action="<?php echo get_site_url(); ?>/wp-admin/admin-post.php" method="POST">
				<?php wp_nonce_field( 'download-whitelist', 'dl-wl-nonce' ); ?>
				<input type="hidden" name="action" value="download_whitelist">
				<input type="hidden" name="redirect-to" value="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=downloads&page=download-whitelist-page">
				<textarea name="email-whitelist" rows="20" cols="50"><?php if($download_whitelist = get_option( 'download_whitelist' )){ echo implode( "\r\n", $download_whitelist ); } ?></textarea>
				<input type="submit" value="Save Whitelist">
			</form>
		</div>
		<div class="col-md-9">
			<h2>Download Whitelist Emails</h2>
			<p>Use this page to manage your download whitelist.</p>
			<p>This allows a user to skip terms / approval.</p>
			<p>
				This is expected as below.<br>
				<small>@example.com</small><br>
				<small>@example.co.uk</small><br>
				<small>@example.net</small><br>
				<small>@example.info</small><br>
				<small>@example.org</small>
			</p>
		</div>
	</div>
</div>