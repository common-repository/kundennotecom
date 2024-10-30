<?php
add_action( 'admin_menu', 'kundennote_add_admin_menu' );
add_action( 'admin_init', 'kundennote_settings_init' );


function kundennote_add_admin_menu() {

  add_options_page( 'kundennote.com Bewertungssiegel', 'kundennote.com', 'manage_options', 'kundennote', 'kundennote_options_page' );

}


function kundennote_settings_init() {

  register_setting( 'pluginPage', 'kundennote_settings' );

  add_settings_section(
    'kundennote_pluginPage_section',
    __( 'Einstellungen', 'wordpress' ),
    '',
    'pluginPage'
  );

  add_settings_field(
    'kundennote_text_field_id',
    __( 'kundennote.com ID: ', 'wordpress' ),
    'kundennote_text_fields_render_id',
    'pluginPage',
    'kundennote_pluginPage_section'
  );

  add_settings_field(
    'kundennote_aiop_activate_id', // id
    __( '"All in One PRO"-Bewertungssiegel', 'wordpress' ), // title
    'kundennote_aiop_activate_id',
    'pluginPage', // page
    'kundennote_pluginPage_section' // section
  );


}

function kundennote_text_fields_render_id() {

  $options = get_option( 'kundennote_settings' );
  ?>
<input type='text' class='textfield' name='kundennote_settings[kundennote_text_field_id]' value='<?php echo esc_attr($options['kundennote_text_field_id']); ?>'>
<br />
<small>
<?php _e('Die kundennote.com ID finden Sie im kundennote.com <a href="https://kundennote.com/app/mywidgets/v2" target="_blank">Administrationsbereich</a> unter <i>Einstellungen &raquo; Widget einbinden</i>', 'wordpress' ); ?>
</small>
<?php

}


function kundennote_aiop_activate_id() {
  $options = get_option( 'kundennote_settings' );

  if ( isset( $options[ 'kundennote_aiop_activate_id' ] ) && $options[ 'kundennote_aiop_activate_id' ] === '1' ) {
    $checked = ' checked';
  } else {
    $checked = '';
  }


  ?>
<input type="checkbox" name="kundennote_settings[kundennote_aiop_activate_id]" id="kundennote_aiop_activate_id" value="1"<?php echo $checked; ?>>
<label for="kundennote_aiop_activate_id">
  <?php _e( 'Aktivieren Sie das "All in One PRO"-Bewertungssiegel', 'wordpress' );?>
</label>
<?php
}


function kundennote_options_page() {

  ?>
<div class="knOptionsWrap">
  <div class="header"><a href="https://kundennote.com/produkttour?ref=wpplugin" target="_blank"><img src="<?php echo esc_url( plugins_url( 'img/kn-logo.png', __FILE__ ) ); ?>" width="200" height="39"></a></div>
  <div class="content"> <a class="infobanner" href="https://kundennote.com/produkttour?ref=wpplugin" target="_blank">
    <?php _e( 'Sichern Sie sich den ersten Monat im PRO Paket kostenlos!<br><strong>Rabattcode "WORDPRESS"</strong>', 'wordpress' );?>
    </a>
    <h1>
      <?php _e( 'Bewertungssiegel von Bewertungsportal kundennote.com', 'wordpress' );?>
    </h1>
    <div class="col-wrap">
      <div class="col">
        <p>
          <?php _e( 'Hier konfigurieren Sie das kundennote.com Plugin zur Anzeige der Bewertungssiegel auf Ihrer Website. Um die Bewertungssiegel verwenden zu können, benötigen Sie einen Account auf <a href="https://kundennote.com/produkttour?ref=wpplugin" target="_blank">kundennote.com</a>. Hier stellen wir einen kostenlosen BASIC Account und einen funktionsreicheren PRO Account für Sie bereit.<br /><div class="noticebox"><strong>HINWEIS:</strong> Sie können pro Seite nur je einmal das gleiche Widget verwenden. Fügen Sie zweimal das selbe auf einer Seite ein, wie zB in der Sidebar und unten im Footer, wird dieses nur einmal angezeigt.</div>', 'wordpress' );?>
        </p>
      </div>
      <div class="col">
        <p>
        <div class="infobox">
          <?php _e( '<strong>Shortcodes:</strong><br>[kundennote style="1"] => Widget Style "Card 1"<br>[kundennote style="2"] => Widget Style "Card 2"<br>[kundennote style="3"] => Widget Style "Siegel"<br>[kundennote style="4"] => Widget Style "Text"<br>[kundennote style="5"] => Widget Style "Bewertungen"', 'wordpress' );?>
        </div>
        </p>
      </div>
    </div>
    <hr />
    <form action='options.php' method='post'>
      <?php
      settings_fields( 'pluginPage' );
      do_settings_sections( 'pluginPage' );
      submit_button();
      ?>
    </form>
  </div>
</div>
<div class="knCopyright">&copy; <?php echo date('Y'); ?> Bewertungsportal kundennote.com | Plugin Version v<?php echo KUNDENNOTE_VERSION; ?></div>
<?php

}


function kundennote_settings_link( $links ) {

  $settings_link = array( '<a href="options-general.php?page=kundennote">Einstellungen</a>', '<a href="https://kundennote.com/produkttour?ref=wpplugin" target="_blank">kostenlos registrieren</a>' );

  $links = array_merge( $links, $settings_link );

  return $links;
}
add_filter( "plugin_action_links_" . KUNDENNOTE_BASENAME, 'kundennote_settings_link' );


function wpdocs_enqueue_custom_admin_style() {
  wp_register_style( 'custom_wp_admin_css', plugins_url( 'css/admin.css', __FILE__ ), false, '1.0.0' );
  wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );


?>
