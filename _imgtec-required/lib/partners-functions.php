<?php
// ================================================
// =====> Add Subscribers to Author Dropdown <=====
//
function add_subscribers_as_authors($output) {

	global $post;

    if($post->post_type == 'partners') {

        //=> Global $post is available here, hence you can check for the post type here
        $users = get_users('role=subscriber&number=100');

        $output = "<select id=\"post_author_override\" name=\"post_author_override\" class=\"\">";

        //=> Leave the admin in the list
        $output .= "<option value=\"1\">Admin</option>";
        foreach ($users as $user) {
            $sel = ($post->post_author == $user->ID) ? "selected='selected'" : '';
            $output .= '<option value="' . $user->ID . '"' . $sel . '>' . $user->user_login . '</option>';
        }
        $output .= "</select>";

        return $output;
    }
}
//add_filter('wp_dropdown_users', 'add_subscribers_as_authors');


// ====================================
// =====> Add Custom Post Status <=====
//
function reject_status(){

	register_post_status( 'reject', array(
		'label'                     => _x( 'reject', 'partners' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'reject <span class="count">(%s)</span>', 'reject <span class="count">(%s)</span>' ),
	) );
}
//add_action( 'init', 'reject_status' );


// ==============================
// =====> Add Post Status' <=====
//
function append_post_status_list(){

  	global $post;

  	$complete 	= '';
  	$label 		= '';

  	if($post->post_type == 'partners'){
		if($post->post_status == 'reject'){
			$complete 	= ' selected=\"selected\"';
			$label 		= '<span id=\"post-status-display\">Reject</span>';
		}
		echo '
		<script>
		jQuery(document).ready(function($){
			$("select#post_status").append("<option value=\"reject\" '.$complete.'>Reject</option>");
			$(".misc-pub-section label").append("'.$label.'");
		});
		</script>
		';
  	}
}
//add_action('admin_footer-post.php', 'append_post_status_list');


// ==========================================================
// =====> SEND EMAIL WHEN POST = REJECTED || PUBLISHED <=====
//
function success_notification( $post ) {

	//=> Only call on partners posts
	$slug = 'partners';

   if ( $slug != $_POST['post_type'] ) {
      return;
   }

   //=> Some params to send
   $post_title 	= get_the_title( $post->ID );
	$post_url 		= get_permalink( $post->ID );
	$author_id 		= $post->post_author;
	$author_name	= get_the_author_meta('user_nicename', $author_id);
	$author_email 	= get_the_author_meta('user_email', $author_id);

   notify_success( $post_title, $post_url, $author_email, $author_name );
}
//add_action( 'pending_to_publish', 'success_notification' );
//add_action( 'reject_to_publish', 'success_notification' );


// ======================================
// =====> Manage Unpublished Posts <=====
//
function post_unpublished( $new_status, $old_status, $post ) {

	//=> Only call on partners posts
	$slug = 'partners';

   if ( $slug != 'partners' ) {
      return;
   }

   if ( $new_status == 'reject') {

   	//=> Some params to send
   	$post_title 	= get_the_title( $post->ID );
   	$author_id 		= $post->post_author;
	$author_name	= get_the_author_meta('user_nicename', $author_id);
	$author_email 	= get_the_author_meta('user_email', $author_id);

   	notify_fail( $post_title, $author_email, $author_name );

   }
}
//add_action( 'transition_post_status', 'post_unpublished', 10, 3 );


// =========================================
// =====> Adding Columns To The Admin <=====
//
function partners_edit_columns( $columns ) {
   $columns = array(
		'cb'       				=> '<input type="radio" />',
		'title'    				=> __( 'Company Name' ),
		'author'   				=> __( 'Company Admin' ),
		'partner-type'			=> __( 'Partner Type' ),
		'products'				=> __( 'Products' ),
		'markets'   			=> __( 'Markets' ),
		'design-services' 		=> __( 'Design Services' ),
		'geography'   			=> __( 'Geography' ),
		'date'     				=> __( 'Date' ),
		'updated'  				=> __( 'Updated' )
   );
   return $columns;
}
add_filter( 'manage_edit-partners_columns', 'partners_edit_columns' ) ;

// ============================
// =====> Manage Columns <=====
//
function partners_manage_columns( $column, $post_id ) {

   global $post;

   switch( $column ) {

		# The author and admin of the company #
		case 'author':
			$author = get_the_author();
			echo $author;
		break;

		# The date the post was updated #
		case 'updated':
			the_modified_date();
		break;

		# The Partner Types #
		case 'partner-type':
			$terms = get_the_terms( $post_id, 'partner-type' );
			 	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			     echo "<ul>";
			     	foreach ( $terms as $term ) {
			       	echo "<li>" . $term->name . "</li>";
			     }
			   echo "</ul>";
			}
		break;

		# The Products #
		case 'products':
			$terms = get_the_terms( $post_id, 'products' );
			 	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			     echo "<ul>";
			     	foreach ( $terms as $term ) {
			       	echo "<li>" . $term->name . "</li>";
			     }
			   echo "</ul>";
			}
		break;

		# The Design Services #
		case 'design-services':
			$terms = get_the_terms( $post_id, 'design-services' );
			 	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			     echo "<ul>";
			     	foreach ( $terms as $term ) {
			       	echo "<li>" . $term->name . "</li>";
			     }
			   echo "</ul>";
			}
		break;

		# The Geography #
		case 'geography':
			$terms = get_the_terms( $post_id, 'geography' );
			 	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			     echo "<ul>";
			     	foreach ( $terms as $term ) {
			       	echo "<li>" . $term->name . "</li>";
			     }
			   echo "</ul>";
			}
		break;

		# The Markets #
		case 'markets':
			$terms = get_the_terms( $post_id, 'markets' );
			 	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			     echo "<ul>";
			     	foreach ( $terms as $term ) {
			       	echo "<li>" . $term->name . "</li>";
			     }
			   echo "</ul>";
			}
		break;
	}
}
add_action( 'manage_partners_posts_custom_column', 'partners_manage_columns', 10, 2 );