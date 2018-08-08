<?php
function add_icon_contact_info_public_relations() {
  ?>
    <style>
    *[id*="_contact_info_public_relations"] > div.widget-top > div.widget-title > h3:before {
      font-family: "dashicons";
      content: "\f466";
      float:right;
      margin:-2px 0 -10px 0;
      font-size: 150%;
      color: #750054;
    }
    </style>
  <?php
}
add_action('admin_head-widgets.php','add_icon_contact_info_public_relations');

class contact_info_public_relations extends WP_Widget {

  /**
   * Sets up the widgets name etc
   */
  public function __construct() {
    // widget actual processes
    parent::__construct( false, 'Contact Info Public Relations' );
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
    public function widget( $args, $instance ) {

      echo __('
        <div class="contact-widget">
          <h2><a href="/about/contact-us"><i class="fa fa-envelope pull-right" style="color:#b71a8b; font-size:1.1em;"></i></a>Contact</h2>

          <h3>Public Relations</h3>

          <p>If you have any enquiries regarding any of our news or press release items, please contact:</p>

          <h5 style="margin:20px 0px 4px !important;">United Kingdom</h5>
          <p><a href="mailto:david.harold@imgtec.com">david.harold@imgtec.com</a><br>
          Tel: +44 (0)1923 260511</p>
					<p><a href="mailto:jo.ashford@imgtec.com">jo.ashford@imgtec.com</a><br>
          Tel: +44 (0)1923 260511</p>
        </div>', 'text_domain'
      );
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

function register_contact_info_public_relations_widget() {
  register_widget( 'contact_info_public_relations' );
}

add_action( 'widgets_init', 'register_contact_info_public_relations_widget' );
