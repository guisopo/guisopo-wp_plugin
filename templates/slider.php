<?php
  // Video 50
  $args = array(
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'meta_query' => array(
      array(
        'key' => '_guisopo_testimonial_key',
        'value' => 's:8:"approved";i:1;s:8:"featured";i:1;',
        'compare' => 'LIKE'
      )
    ) 
  );

  $query = new WP_Query($args);

  if($query->have_posts()) :

    $i = 1;

    echo '<div class="guisopo-slider--wrapper">
            <div class="guisopo-slider--container">
              <div class="guisopo-slider--view">
                <ul>';

    while($query->have_posts()) : $query->the_post();

      // $data = get_post_meta(get_the_ID(), '_guisopo_testimonial_key', true);
      // $name = $data['name'];
      // Same as:
      $name = get_post_meta(get_the_ID(), '_guisopo_testimonial_key', true)['name'] ?? '';

      echo '<li class="guisopo-slider--view__slides' . ( $i === 1 ? ' is-active': '' ) . '">
              <p class="testimonial-quote">"' . get_the_content() . '"</p>
              <p class="testimonial-author">' . $name . '</p>
            </li>';

      $i++;

    endwhile;

    echo '      </ul>
              </div>
              <div class="guisopo-slider--arrows">
                <span class="arrow guisopo-slider--arrows__left">&#x3c</span>
                <span class="arrow guisopo-slider--arrows__right">&#x3e</span>
              </div
            </div>
          </div>';

  endif;

  wp_reset_postdata();