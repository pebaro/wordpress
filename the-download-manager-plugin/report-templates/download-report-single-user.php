<div class="download-plugin download-report">
<?php
	/**
	 * We need these values for the rest of the page
	 */
	global $wpdb;
	$user_id = $_GET['user-id'];
	
	/**
	 * Get the users data in order to output the display name
	 * @var [object]
	 */
	$the_user = get_user_by( 'id', $user_id );
?>
	
	<h2><?php echo $the_user->data->display_name; ?> download logs</h2>
	<hr>

	<?php
		$user_logs = get_user_logs($user_id);
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Download</th>
				<th>Timestamp</th>
				<th>IP Address</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($user_logs as $entry){
				echo '<tr>';
				echo '<td>'.get_the_title($entry->download_id).' ('.$entry->download_id.')</td>';
				echo '<td>'.$entry->timestamp.'</td>';
				echo '<td>'.$entry->ip_address.'</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
</div>