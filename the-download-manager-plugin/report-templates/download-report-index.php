<div class="download-plugin download-report">
	<?php
		/**
		 * We need the $wpdb variable to query a few things
		 */
		global $wpdb;
	?>

	<h2>Downloads Overview</h2>

	<div class="row">
			<div class="col-md-5">
			<?php
				$all_downloads = get_all_downloads();
			?>
			<h3>All Downloads - All Time</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Total</th>
						<th>Download Title</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$alternate = true;
					foreach ( $all_downloads as $download ):
						?>
						<tr>
							<td><?php echo $download->total ?></td>
							<td><?php echo '<a href="'.admin_url('/edit.php?post_type=downloads&page=download-reports&download-id='.$download->download_id).'">'.get_the_title($download->download_id).'</a>'; ?></td>
						</tr>
						<?php
					endforeach;
				?>
				</tbody>
			</table>
		</div>
<!-- End of All downloads -->
		<div class="col-md-5">

<?php
				$top_week_downloads = get_top_downloads_week_view();
			?>
			<h3>Most Active Downloads - This Week</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Total</th>
						<th>Download Title</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($top_week_downloads){
						$alternate = true;
						foreach ( $top_week_downloads as $download ):
							?>
							<tr>
								<td><?php echo $download->total ?></td>
								<td><?php echo '<a href="'.admin_url('/edit.php?post_type=downloads&page=download-reports&download-id='.$download->download_id).'">'.get_the_title($download->download_id).'</a>'; ?></td>
							</tr>
							<?php
						endforeach;
					} else {
						?>
						<tr>
							<td colspan="2">No downloads this week</td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>

			<?php
				$top_downloads = get_top_downloads();
			?>
			<h3>Most Active Downloads - All Time</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Total</th>
						<th>Download Title</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$alternate = true;
					foreach ( $top_downloads as $download ):
						?>
						<tr>
							<td><?php echo $download->total ?></td>
							<td><?php echo '<a href="'.admin_url('/edit.php?post_type=downloads&page=download-reports&download-id='.$download->download_id).'">'.get_the_title($download->download_id).'</a>'; ?></td>
						</tr>
						<?php
					endforeach;
				?>
				</tbody>
			</table>


		<?php
			$top_week_users = get_top_downloaders_week_view();
		?>

			<h3>Most Active Users - This Week</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Username</th>
						<th>Downloads</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($top_week_users){
						foreach ($top_week_users as $user) {
							$this_user = get_user_by( 'id', $user->user_id );
							echo '<tr>';
							echo '<td>'.$user->user_id.'</td>';
							echo '<td><a href="'.admin_url('/edit.php?post_type=downloads&page=download-reports&user-id='.$user->user_id).'">'.$this_user->data->display_name.'</a></td>';
							echo '<td>'.$user->total.'</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="3">No downloads this week</td></tr>';
					}
					?>
				</tbody>
			</table>


		<?php
			$top_users = get_top_downloaders();
		?>

			<h3>Most Active Users - All Time</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Username</th>
						<th>Downloads</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($top_users as $user) {
							$this_user = get_user_by( 'id', $user->user_id );
							echo '<tr>';
							echo '<td>'.$user->user_id.'</td>';
							echo '<td><a href="'.admin_url('/edit.php?post_type=downloads&page=download-reports&user-id='.$user->user_id).'">'.$this_user->data->display_name.'</a></td>';
							echo '<td>'.$user->total.'</td>';
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
		</div>

	</div>
</div>