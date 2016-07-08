<section>
  <h2>Tjänster</h2>
    <?php
      $postTypeObject = new WP_Query(['post_type' => 'service']);
      $count = 0;
    ?>
  <div class="puffs">
    <?php while($postTypeObject->have_posts() && $count++ < 3): $postTypeObject->the_post(); ?>
      <figure class="puff">
          <a href="<?php the_permalink() ?>"><h3> <?php the_title(); ?></h3></a>
          <div class="background-img"style="background-image:url(<?php echo get_post_meta( get_the_ID(), '_image', true ) ?>);"></div>
        <figcaption><?php the_excerpt() ?></figcaption>
      </figure>
    <?php endwhile; ?>
  </div>
</section>

