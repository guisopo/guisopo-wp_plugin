<div class="wrap">
  <h1>Guisopo Plugin</h1>
  <?php settings_errors() ?>

  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1">Manage Settings</a></li>
    <li><a href="#tab2">Updates</a></li>
    <li><a href="#tab3">About</a></li>
  </ul>

  <div class="tab-content">

    <div id="1" class="tab-pane active">
      <form action="options.php" action="post">
        <?php
          settings_fields( 'guisopo_options_group' ); // setSettings->option_group
          do_settings_sections( 'guisopo_plugin' ); // setSections->page
          submit_button();
        ?>
      </form>
    </div>

    <div id="2" class="tab-pane">
      <h3>Updates</h3>
    </div>

    <div id="3" class="tab-pane">
      <h3>About</h3>
    </div>

  </div>

</div>