<?php
/* Plugin Name: CMS 2 Labb 1 Widget
   Author: Alexander Maktabi
   Version: 1.1
   Description: A plugin that adds a youtube widget.
*/
 class Cms2Widget extends WP_Widget {
  public function __construct()
  {
    parent::__construct(
			'Cms2Widget',
			esc_html__( 'Youtube Widget', 'text_domain' ),
			array( 'description' => esc_html__( 'Displays a youtube video', 'text_domain' ), )
		);
    add_action( 'widgets_init', array($this, 'register_youtube_widget') );
  }

  public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if(!empty($instance['url'])) {
		    $url = $instance['url'];
        $autoplay =  $instance['autoplay'] ? 1 : 0;
        $controls =  $instance['controlls']  ? 1 : 0;
        // If user gets the url by clicking on share button
        if (preg_match("/http/", $url) && !preg_match("/watch?/", $url)) {
            $url = explode("/",$url,4);
            $url = $url[3];
        // If user copy the url from the url bar in the browser
        } elseif(preg_match("/watch?/", $url)) {
          $url_components = parse_url($url);
          parse_str($url_components['query'], $params);
          $url = $params['v'];
        }
        echo '<iframe width="500" height="300" src="https://www.youtube.com/embed/'.$url.'?controls='.$controls.'&autoplay='.$autoplay.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    } else {
      return;
    }
		echo $args['after_widget'];
	}

  public function form( $instance ) {
		$url = ! empty( $instance['url'] ) ? $instance['url'] : esc_html__( 'Ange youtube video ID eller url', 'text_domain' );
		?>

		<p>
    <!-- URL input -->
		<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_attr_e( 'Video ID/URL:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
    <!-- Settings -->
    <br><br>
    <label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"><?php esc_attr_e( 'Spela automatiskt', 'text_domain' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'autoplay' ) ); ?>"  type="checkbox" <?php checked( $instance['autoplay'], 'on' ); ?>>
    <br><br>
    <label for="<?php echo esc_attr( $this->get_field_id( 'controlls' ) ); ?>"><?php esc_attr_e( 'Visa kontroller', 'text_domain' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'controlls' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'controlls' ) ); ?>" type="checkbox" <?php checked( $instance['controlls'], 'on' ); ?>>
    </p>
		<?php
	}

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    // Update url
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? sanitize_text_field( $new_instance['url'] ) : '';
    // Update checkboxes
  	$instance['autoplay'] =   $new_instance['autoplay'];
		$instance['controlls'] =  $new_instance['controlls'];

		return $instance;
	}

  function register_youtube_widget() {
    register_widget( 'Cms2Widget' );
  }
}

new Cms2Widget();
