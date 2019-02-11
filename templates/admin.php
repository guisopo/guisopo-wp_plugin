<div class="wrap">
  <h1>Guisopo Plugin</h1>
  <?php settings_errors() ?>
  <!-- Everytime we want to update our CF we need to point to this  -->
  <!-- WP built in php page -->

  <form action="options.php" action="post">
    <?php
      settings_fields( 'guisopo_options_group' ); // setSettings->option_group
      do_settings_sections( 'guisopo_plugin' ); // setSections->page
      submit_button();
    ?>
  </form>
</div>