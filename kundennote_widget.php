<?php


class Kundennote_Widget extends WP_Widget {

  /**
   * Sets up the widgets name etc
   *
   */
  public function __construct() {
    $widget_ops = array(
      'classname' => 'Kundennote_Widget',
      'description' => 'Platzieren Sie Ihr kundennote.com Bewertungssiegel in Ihrer Website.',
    );
    parent::__construct( 'Kundennote_Widget', 'kundennote.com Widget', $widget_ops );
  }

  /**
   * Outputs the content of the widget
   * 
   * @param array $args
   * @param array $instance                    
   */
  public function widget( $args, $instance ) {
    // outputs the content of the widget
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );

    // before and after widget arguments are defined by themes
    echo $args[ 'before_widget' ];

    if ( !empty( $title ) )
      echo $args[ 'before_title' ] . esc_attr( $title ) . $args[ 'after_title' ];

    $options = get_option( 'kundennote_settings' );

    if ( $instance[ 'widgetalignment' ] == 'left' ) {
      $widgetalignment = 'margin:0 auto 0 0;text-align:left;';
    } else if ( $instance[ 'widgetalignment' ] == 'right' ) {
      $widgetalignment = 'margin:0 0 0 auto;text-align:right;';
    } else {
      $widgetalignment = 'margin:0 auto;text-align:center;';
    }

    echo '<style>.knWidgetContainer' . esc_attr( $instance[ 'widgetstyle' ] ) . ' .knWidget{' . esc_attr( $widgetalignment ) . '}.knWidgetContainer' . esc_attr( $instance[ 'widgetstyle' ] ) . ' a{' . esc_attr( $widgetalignment ) . '}</style>';

    echo '<div class="knWidgetContainer' . esc_attr( $instance[ 'widgetstyle' ] ) . '">';
    echo '<div id="kundennoteWidgetw' . esc_attr( $instance[ 'widgetstyle' ] ) . '"></div>';

    echo wp_get_script_tag(
      array(
        'src' => esc_url( getCurrentLang().'widget/v2/w' . esc_attr( $instance[ 'widgetstyle' ] ) . '/' . esc_attr( $options[ 'kundennote_text_field_id' ] ) . '.js' ),
        'async' => true,
        'type' => 'text/javascript',
      )
    );

    echo '</div>';
    echo $args[ 'after_widget' ];
  }


  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  public function form( $instance ) {
    // outputs the options form on admin
    echo _e( '<small>Dieses Widget zeigt eines der Bewertungssiegel auf Ihrer Website an.</small>', 'wordpress' );
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    } else {
      $title = __( 'Bewertungen', 'wordpress' );
    }

    if ( !isset( $instance[ 'widgetstyle' ] ) ) {
      $instance[ 'widgetstyle' ] = 1;
    }

    if ( !isset( $instance[ 'widgetalignment' ] ) ) {
      $instance[ 'widgetalignment' ] = 'none';
    }

    // Widget admin form
    ?>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
    <?php _e( 'Title:' ); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'widgetstyle' )); ?>">
    <?php _e( 'Style:' ); ?>
  </label>
  <select id="<?php echo esc_attr($this->get_field_id('widgetstyle')); ?>" name="<?php echo esc_attr($this->get_field_name('widgetstyle')); ?>" class="widefat" style="width:100%;">
    <option value="1" <?php selected( $instance['widgetstyle'], '1' ); ?>>
    <?php _e( 'Widget Style "Card 1"', 'wordpress' );?>
    </option>
    <option value="2" <?php selected( $instance['widgetstyle'], '2' ); ?>>
    <?php _e( 'Widget Style "Card 2"', 'wordpress' );?>
    </option>
    <option value="3" <?php selected( $instance['widgetstyle'], '3' ); ?>>
    <?php _e( 'Widget Style "Siegel"', 'wordpress' );?>
    </option>
    <option value="4" <?php selected( $instance['widgetstyle'], '4' ); ?>>
    <?php _e( 'Widget Style "Text"', 'wordpress' );?>
    </option>
    <option value="5" <?php selected( $instance['widgetstyle'], '5' ); ?>>
    <?php _e( 'Widget Style "Bewertungen"', 'wordpress' );?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'widgetalignment' )); ?>">
    <?php _e( 'Ausrichtung:' ); ?>
  </label>
  <select id="<?php echo esc_attr($this->get_field_id('widgetalignment')); ?>" name="<?php echo esc_attr($this->get_field_name('widgetalignment')); ?>" class="widefat" style="width:100%;">
    <option value="left" <?php selected( $instance['widgetalignment'], 'left' ); ?>>
    <?php _e( 'links', 'wordpress' );?>
    </option>
    <option value="none" <?php selected( $instance['widgetalignment'], 'none' ); ?>>
    <?php _e( 'zentriert', 'wordpress' );?>
    </option>
    <option value="right" <?php selected( $instance['widgetalignment'], 'right' ); ?>>
    <?php _e( 'rechts', 'wordpress' );?>
    </option>
  </select>
</p>
<?php
}

/**
 * Processing widget options on save
 *
 * @param array $new_instance The new options
 * @param array $old_instance The previous options
 */
public function update( $new_instance, $old_instance ) {
  // processes widget options to be saved
  $instance = array();
  $instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
  $instance[ 'widgetstyle' ] = ( !empty( $new_instance[ 'widgetstyle' ] ) ) ? strip_tags( $new_instance[ 'widgetstyle' ] ) : '';
  $instance[ 'widgetalignment' ] = ( !empty( $new_instance[ 'widgetalignment' ] ) ) ? strip_tags( $new_instance[ 'widgetalignment' ] ) : '';
  return $instance;
}
}


function register_kundennote_widget() {
  register_widget( 'Kundennote_Widget' );
}

add_action( 'widgets_init', 'register_kundennote_widget' );

?>
