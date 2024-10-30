<?php

function kundennoteWidget( $atts ) {
  $options = get_option( 'kundennote_settings' );

  $w = shortcode_atts( array(
    'style' => '',
  ), $atts );

  $widgetCode = '<div id="kundennoteWidgetw' . esc_attr( $w[ 'style' ] ) . '"></div>';
  $widgetCode .= wp_get_script_tag(
    array(
      'src' => esc_url( getCurrentLang().'widget/v2/w' . esc_attr( $w[ 'style' ] ) . '/' . esc_attr( $options[ 'kundennote_text_field_id' ] ) . '.js' ),
      'async' => true,
      'type' => 'text/javascript',
    )
  );
  return $widgetCode;
}

add_shortcode( 'kundennote', 'kundennoteWidget' );

?>