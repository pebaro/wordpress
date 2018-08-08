<?php
    # get meta data for the events
    $event_start        = get_post_meta( $post->ID, 'event_start', true );
    $event_end          = get_post_meta( $post->ID, 'event_end', true );
    $event_year         = get_post_meta( $post->ID, 'event_end', true );
    $webinar_start      = get_post_meta( $post->ID, 'webinpresentation_ar_start', true );
    $webinar_end        = get_post_meta( $post->ID, 'webinar_end', true );
    $webinar_year       = get_post_meta( $post->ID, 'webinar_end', true );
    $timezone           = get_post_meta( $post->ID, 'timezone', true );
    $event_type         = get_post_meta( $post->ID, 'event_type', true );
    $speaker            = get_post_meta( $post->ID, 'speaker', true );
    $speaker_day        = get_post_meta( $post->ID, 'speaker_time', true );
    $speaker_year       = get_post_meta( $post->ID, 'speaker_time', true );
    $duration           = get_post_meta( $post->ID, 'speaker_duration', true );
    $featured           = get_post_meta( $post->ID, 'featured_event', true );

    $ex_or_conf         = get_post_meta( $post->ID, 'ex_or_conf', true );

    # for condition checks
    $today              = date( 'Ymd' );
    $check_event_start  = date( 'Ymd', strtotime( $event_start ) );
    $check_event_end    = date( 'Ymd', strtotime( $event_end ) );
    $check_speak_start  = date( 'Ymd', strtotime( $speaker_day ) );
    $check_web_start    = date( 'Ymd', strtotime( $webinar_start ) );
    $check_web_end      = date( 'Ymd', strtotime( $webinar_end ) );

    # for echo
    $start_date         = date( 'd F', strtotime( $event_start ) );
    $start_date         = substr( $start_date, 0, 6 );
    $end_date 	        = date( 'd F', strtotime( $event_end ) );
    $end_date 	        = substr( $end_date, 0, 6 );
    $event_year         = date( 'Y', strtotime( $event_year ) );
    $event_year         = substr( $event_year, 0, 6 );
    $event_date         = $start_date . ' ' . $event_year;
    $event_dates        = $start_date . ' - ' . $end_date . ' ' . $event_year;
    $event_dates        = '<small>starts:</small> ' $start_date . '<br><small>ends:</small> ' . $end_date . ' ' . $event_year;

    $speaker_time       = date( 'H:i', strtotime( $speaker_day ) );
    $speaker_date       = date( 'd-m-Y', strtotime( $speaker_day ) );
    $speaker_date       = date( 'd F', strtotime( $speaker_day ) );
    $speaker_date       = substr( $speaker_date, 0, 6 );
    $speaker_year       = date( 'Y', strtotime( $speaker_year ) );
    $speaker_year       = substr( $speaker_year, 0, 6 );
    $speaker_appears    = $speaker_date . ' ' . $speaker_year;

    $webinar_date       = date( 'd F', strtotime( $webinar_start ) );
    $webinar_date       = substr( $webinar_date, 0, 6 );
    $webinar_year       = date( 'Y', strtotime( $webinar_year ) );
    $webinar_year       = substr( $webinar_year, 0, 6 );
    $webinar_streamed   = $webinar_date . ' ' . $webinar_year;