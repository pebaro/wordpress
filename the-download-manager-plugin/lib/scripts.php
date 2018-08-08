<?php
/**
 * Load styles and scripts for the front-end
 */
function download_load_frontend_scripts()
{
    wp_enqueue_style(
        'the-download-manager-frontend-style',
        plugins_url('the-download-manager-plugin/assets/public/css/download.css')
    );

    wp_enqueue_script(
        'the-download-manager-frontend-script',
        plugins_url('the-download-manager-plugin/assets/public/js/download.js')
    );
}
add_action('wp_enqueue_scripts', 'download_load_frontend_scripts');

/**
 * Load styles and scripts for the back-end
 */
function download_load_admin_scripts( $hook )
{


    // Global object containing current admin page

    $screen = get_current_screen();

    global $typenow, $post;

    if ( ( $hook == 'post-new.php' || $hook == 'post.php' && 'downloads' === $post->post_type ) || 'downloads' === $typenow || 'downloads' === $screen->id ) {

        /**
         * Add Bootstrap main styles
         */
        wp_enqueue_style(
            'download-manager-bootstrap-styles',
            plugins_url('the-download-manager-plugin/assets/admin/css/bootstrap.css')
        );

        /**
         * Add Bootstrap theme styles
         */
        wp_enqueue_style(
            'download-manager-bootstrap-theme-styles',
            plugins_url('the-download-manager-plugin/assets/admin/css/bootstrap-theme.css')
        );

        /**
         * Add the plugins custom styles
         */
        wp_enqueue_style(
            'download-manager-app-styles',
            plugins_url('the-download-manager-plugin/assets/admin/css/app.css')
        );

        /**
         * Add Bootstrap JavaScript
         */
        wp_enqueue_script(
            'download-manager-boostrap-js',
            plugins_url('the-download-manager-plugin/assets/admin/js/bootstrap.min.js')
        );

        /**
         * Add plugin specific JavaScript file
         */
        wp_enqueue_script(
            'download-manager-script',
            plugins_url('the-download-manager-plugin/assets/admin/js/main.js'), 'jquery'
        );
    }
}

add_action( 'admin_enqueue_scripts', 'download_load_admin_scripts', 50 );