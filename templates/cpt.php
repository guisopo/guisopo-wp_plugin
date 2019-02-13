<div class="wrap">
  
  <h1>Custom Post Types Manager</h1>
  
  <?php settings_errors() ?>
  
  <form action="options.php" method="post">
    <?php
      settings_fields( 'guisopo_plugin_cpt_settings' );
      do_settings_sections( 'guisopo_cpt' );
      submit_button();
    ?>
  </form>

</div>