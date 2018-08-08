<?php
	/**
	 * Check the request is for a download report
	 */
	if(isset($_GET['download-id']) && get_post_type($_GET['download-id']) == 'downloads'){
		$download_id = $_GET['download-id'];

		// Generate the detailed list of downloads
		global $wpdb;
		$db_table 			= $wpdb->prefix . 'download_tracking';
		$customPagHTML     	= "";
		$query             	= 'SELECT * FROM '.$db_table.' WHERE download_id ='. $download_id .'';
		$total_query    	= "SELECT COUNT(1) FROM (${query}) AS combined_table";
		$total            	= $wpdb->get_var( $total_query );

		if ($_GET['view-all'] === "yes") {
		$items_per_page 	= 1000000000;
		}else{
		$items_per_page 	= 100;
		}

		$page             	= isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		$offset         	= ( $page * $items_per_page ) - $items_per_page;
		$result         	= $wpdb->get_results( $query . " ORDER BY timestamp DESC LIMIT ${offset}, ${items_per_page} " );
		$totalPage         	= ceil($total / $items_per_page);

		// Pagination
		if($totalPage > 1){
			$actual_link = '//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$customPagHTML     =  '(Page '.$page.' of '.$totalPage.') <span class="pagination_links">'.paginate_links( array(
				'base' 			=> add_query_arg( 'cpage', '%#%' ),
				'format' 		=> '',
				'end_size'      => 3,
				'mid_size'      => 3,
				'prev_text' 	=> __('&laquo; Prev'),
				'next_text' 	=> __('Next &raquo;'),
				'show_all'  	=> false,
				'total' 		=> $totalPage,
				'current' 		=> $page
			)).'</span><a href="'.$actual_link.'&view-all=yes" class="btn-view-all">View all results</a>';
		}else{
		$pagination_link = str_replace("&view-all=yes", "", $_SERVER['QUERY_STRING']);
		$customPagHTML     =  '<a href="edit.php?'.$pagination_link.'" class="btn-view-all">Paginate Results</a>';
		}

		// Generate the download counts
		$weekly_download_count = get_download_count($download_id, 'week', false);
		$monthly_download_count = get_download_count($download_id, 'month', false);
		$total_download_count = get_download_count($download_id);

		$DateQuery = 'week';
		$dd_count = get_download_count_by_date($download_id,$DateQuery);
?>
<div class="download-plugin download-report">
		<h1>Download stats for - <?php echo get_the_title( $download_id); ?></h1>
		<hr>
		<table class="table table-hover">
			<tr>
				<th>Daily count over past <?php echo $DateQuery; ?></th>
				<th>Weekly Downloads</th>
				<th>Monthly Downloads</th>
				<th>All Downloads</th>
			</tr>
			<tr>
				<td><?php
				// 	var_dump($dd_count);
					foreach ( $dd_count as $d_count ){
						//$DLDate = date("d-m-Y", strtotime($dd_count->DLDate));
					 	echo $d_count->DLDay.' '.$dd_count->DLDate.' - '. $d_count->DLCount.' downloads<br>';
				 	}

				 ?>
				</td>
				<td><?php echo $weekly_download_count; ?></td>
				<td><?php echo $monthly_download_count; ?></td>
				<td><?php echo $total_download_count; ?></td>
			</tr>
		</table>
<?php } else { ?>
			<h3>An issue occured, This ID didn't validate as a download post.</h3>
<?php } ?>
</div>


<h3>Users who have downloaded <?php echo get_the_title( $download_id ); ?></h3>
<div class="rep-pagination"><?php echo $customPagHTML; ?></div>

	<table class="table table-hover table-condensed">
		<tr>
			<th>Date</th>
			<th>User Name</th>
			<th>Email</th>
			<th>University</th>
			<th>Country</th>
			<th>Role</th>
			<th>IP of user</th>
		</tr>
<?php
	foreach ( $result as $results )   {
			// Get further user info

			if(isset($results->user_id)){
				$user_id = $results->user_id;
				$user_info = get_userdata($user_id);
				$display_name = $user_info->data->display_name;
				$display_email = $user_info->user_email;

				if(isset($user_info->roles) && is_array($user_info->roles)){
				$display_role = current($user_info->roles);
				}
			}else{
				$user_id = '';
				$display_name = 'Not logged in or account deleted';
				$display_email = '';
				$display_role = '';
			}
			// Get IUP Data
			if(function_exists('university_data_retriever')){
				$iup_user_info = university_data_retriever($results->user_id);
			}?>
			<tr>
				<td width="10%"><?php echo $results->timestamp;?></td>
				<td width="12%">
				<?php if(isset($results->user_id)){ ?>
				<a href="user-edit.php?user_id=<?php echo $user_id; ?>">
				<?php echo $display_name; ?></a>
				<?php }else{

					echo $display_name;

					}?>
				</td>
				<td width="18%"><a href="user-edit.php?user_id=<?php echo $user_id; ?>"><?php echo $display_email; ?></a></td>
				<td width="20%"><?php if($iup_user_info['iup_country']) { echo $iup_user_info['iup_university_name']; } ?></td>
				<td width="15%"><?php if($iup_user_info['iup_country']) { echo $iup_user_info['iup_country']; } ?></td>
				<td width="10%"><?php echo $display_role; ?></td>
				<td width="10%"><a href="http://www.infosniper.net/index.php?ip_address=<?php echo $results->ip_address;?>&map_source=1&overview_map=1&lang=1&map_type=1&zoom_level=7" target="_blank"><?php echo $results->ip_address;?></a></td>
			</tr>
			<?php
	}
	?>
</table>
<div class="rep-pagination"><?php echo $customPagHTML; ?></div>