<div class="wrap">
  
  <h1>Taxonomy Manager</h1>
  
  <?php settings_errors() ?>

  <ul class="nav nav-tabs">

    <li class="<?php echo !isset($_POST["edit_taxonomy"]) ? 'active' : ''  ?>">
      <a href="#tab-1">Your Taxonomies</a>
    </li>

    <li class="<?php echo isset($_POST["edit_taxonomy"]) ? 'active' : ''  ?>">
      <a href="#tab-2">
        <?php echo isset($_POST["edit_taxonomy"]) ? 'Edit' : 'Add' ?> Taxonomy
      </a>
    </li>
    
    <li>
      <a href="#tab-3">Export</a>
    </li>
  </ul>

  <div class="tab-content">
    <div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_taxonomy"]) ? 'active' : ''  ?>">

     <h3>Manage your Custom Taxononmies</h3>

     <?php
     
      $options = ( get_option('guisopo_plugin_tax') ) ?: array();

      echo '<table class="cpt-table"><tr><th>ID</th><th>Singular Name</th><th>Hierarchical</th><th class="text-center">Actions</th></tr>';
      
      foreach ($options as $option) {
        $hierarchical = isset($option['hierarchical']) ? "TRUE" : "FALSE";
        
        echo "<tr>
                <td>{$option['taxonomy']}</td>
                <td>{$option['singular_name']}</td>
                <td>{$hierarchical}</td>
                <td class=\"text-center\">";
        // EDIT button
        echo '<form method="post" action="" class="inline-block">'; 
        echo('<input  type="hidden" name="edit_taxonomy" value="' . $option['taxonomy'] . '">');
        submit_button( 'Edit', 'primary small', 'submit', false );
        echo "</form>";
        // DELETE button
        echo '<form method="post" action="options.php" class="inline-block">';
        settings_fields( 'guisopo_plugin_tax_settings' );
        submit_button( 'Delete', 'delete small', 'submit', false, array(
          'onclick' => 'return confirm(\'Are you sure you want to delete the ' .$option['taxonomy']. ' taxonomy?\nThe data associated with it will not be deleted.\'); '
        ));
        echo('<input  type="hidden"name="remove" value="' . $option['taxonomy'] . '">');
        
        echo "</form></td></tr>";
      }

      echo '</table>';
     ?>

    </div>

    <div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_taxonomy"]) ? 'active' : ''  ?>">

      <form action="options.php" method="post">
        <?php
          settings_fields( 'guisopo_plugin_tax_settings' );
          do_settings_sections( 'guisopo_taxonomy' );
          submit_button();
        ?>
      </form>

    </div>

    <div id="tab-3" class="tab-pane">
      <h3>Export your Taxonomies</h3>

    </div>

  </div>


</div>