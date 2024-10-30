<?php

function kundennoteAioproToFooter() {
	$options = get_option( 'kundennote_settings' );
	if ( isset( $options[ 'kundennote_aiop_activate_id' ] ) && $options[ 'kundennote_aiop_activate_id' ] == 1 && !empty( $options[ 'kundennote_text_field_id' ] ) ) {
		echo '<div id="kundennoteWidgetw6"></div>';
		echo wp_get_script_tag(
			array(
				'src' => esc_url( getCurrentLang() . 'widget/v2/w6/' . esc_attr( $options[ 'kundennote_text_field_id' ] ) . '.js' ),
				'async' => true,
				'type' => 'text/javascript',
			)
		);
	}
}
add_action( 'wp_footer', 'kundennoteAioproToFooter' );

?>