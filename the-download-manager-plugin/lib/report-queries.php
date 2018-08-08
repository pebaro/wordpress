<?php

/**
 * Top downloaders of all time
 */
function get_top_downloaders(){
	global $wpdb;

	$result = $wpdb->get_results(
		"SELECT user_id, COUNT(user_id) AS total
		FROM (
			SELECT download_id, user_id
			FROM ".$wpdb->prefix."download_tracking
			WHERE user_id != ''
			GROUP BY download_id, user_id
		) AS download
		GROUP BY user_id
		ORDER BY total
		DESC LIMIT 10;"
	);

	return $result;
}

/**
 * Top downloaders this week
 */
function get_top_downloaders_week_view(){
	global $wpdb;

	$result = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT user_id, COUNT(user_id) AS total FROM (
				SELECT download_id, user_id
				FROM ".$wpdb->prefix."download_tracking
				WHERE user_id != ''
				AND timestamp >= '%s'
				GROUP BY download_id, user_id
			) AS download GROUP BY user_id ORDER BY total DESC LIMIT 10;",
			date('Y-m-d H:i:s', strtotime('-1 week'))
		)
	);

	return $result;
}

/**
 * Most popular downloads in the last week
 */
function get_top_downloads(){
	global $wpdb;

	$result = $wpdb->get_results(
		"SELECT download_id, COUNT(download_id) as total
		FROM ".$wpdb->prefix."download_tracking
		GROUP BY download_id
		ORDER BY total DESC
		LIMIT 10"
	);

	return $result;
}

/**
 * All downloads
 */
function get_all_downloads(){
	global $wpdb;

	$result = $wpdb->get_results(
		"SELECT download_id, COUNT(download_id) as total
		FROM ".$wpdb->prefix."download_tracking
		GROUP BY download_id
		ORDER BY total DESC"
	);

	return $result;
}

/**
 * Most popular downloads in the last week
 */
function get_top_downloads_week_view(){
	global $wpdb;

	$result = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT download_id, COUNT(download_id) as total
			FROM ".$wpdb->prefix."download_tracking
			WHERE timestamp >= %s
			GROUP BY download_id
			ORDER BY total DESC
			LIMIT 10",
			date('Y-m-d H:i:s', strtotime('-1 week'))
		)
	);

	return $result;
}


/**
 * Most popular downloads in the last week
 */
function get_download_count_by_date($download_id, $DateQuery){
	global $wpdb;
	$result = $wpdb->get_results(
		'SELECT DAYNAME(DATE(timestamp)) as DLDay, timestamp as DLDate, count(download_id) as DLCount
		FROM '.$wpdb->prefix.'download_tracking AS t1
		WHERE download_id = '.$download_id.' AND DATE(timestamp ) > DATE_SUB( CURDATE() , INTERVAL 1 '.$DateQuery.' )
		group by DAYOFWEEK(DATE(timestamp))
		ORDER BY timestamp DESC'
	);
	return $result;
}




/**
 * Get the download count for a specific download
 * @param  [int]  $download_id  [The download ID]
 * @param  boolean $time        [description]
 * @return [int]                [Total downloads]
 */
function get_download_count( $download_id, $time = false){
	global $wpdb;

	if(!$time){
		$result = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(download_id)
				FROM ".$wpdb->prefix."download_tracking
				WHERE download_id = %s",
				$download_id
			)
		);
	} else {
		$result = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(download_id)
				FROM ".$wpdb->prefix."download_tracking
				WHERE download_id = %s
				AND timestamp >= %s",
				$download_id, date('Y-m-d H:i:s', strtotime('-1 '.$time))
			)
		);
	}

	return $result;
}

/**
 * Get the user download logs
 * @param  [int] $user_id [the user ID]
 * @return [array]        [The users download logs]
 */
function get_user_logs($user_id){
	global $wpdb;

	$result = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT download_id, timestamp, ip_address
			FROM ".$wpdb->prefix."download_tracking
			WHERE user_id = %s
			ORDER BY ABS(timestamp) DESC",
			$user_id
		)
	);

	return $result;
}