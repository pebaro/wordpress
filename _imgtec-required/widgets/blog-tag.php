<?php
function add_icon_blog_tag_list() {
  ?>
    <style>
    *[id*="_blog_tag_list"] > div.widget-top > div.widget-title > h3:before {
      font-family: "dashicons";
      content: "\f323";
      float:right;
      margin:-2px 0 -10px 0;
      font-size: 150%;
      color: #750054;
    }
    </style>
  <?php
}
add_action('admin_head-widgets.php','add_icon_blog_tag_list');

class Blog_Tag_List extends WP_Widget {

  /**
   * Sets up the widgets name etc
   */
  public function __construct() {
    // widget actual processes
    parent::__construct( false, 'Blog Tag List' );
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
	public function widget( $args, $instance ) {

?>	
	<section class="blog-widget">
  <h3><?php _e('Search by Tag'); ?></h3>
  <p>Search using a choice of tags.</p>
	
	<?php 
		$tags = get_tags();
		echo '<form><select onChange="window.location.replace(this.options[this.selectedIndex].value)">';
		echo '<option value="">Select a Tag</option>';
		foreach ( $tags as $tag ) {
		$tag_link = get_tag_link( $tag->term_id );	
		echo '<option value='. $tag_link .'>'. $tag->name .' ('. $tag->count .')</option>';	
		}
		echo '</select></form>';

	?>
	</section>	
<?php
	}

  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  public function form( $instance ) {
    // outputs the options form on admin
  }

  /**
   * Processing widget options on save
   *
   * @param array $new_instance The new options
   * @param array $old_instance The previous options
   */
  public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved
  }
}

function register_blog_tag_list() {
  register_widget( 'blog_tag_list' );
}

add_action( 'widgets_init', 'register_blog_tag_list' );

//[blog_tag_list]
function blog_tag_list_func( $atts ){

	$tags = get_the_tags();
	$html = '<div class="post_tags">';
    foreach ( $tags as $tag ) {
       $tag_link = get_tag_link( $tag->term_id );

       $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug} post-tag'>";
       $html .= "{$tag->name}</a>";
    }
	$html .= '</div>';
	return $html;	
	
}
add_shortcode( 'blog_tag_list', 'blog_tag_list_func' );
