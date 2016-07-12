<section>
  <h2>Tjänster</h2>
    <?php
      $postTypeObject = new WP_Query(['post_type' => 'service']);
      $count = 0;
    ?>
  <div class="puffs">
    <?php while($postTypeObject->have_posts() && $count++ < 3): $postTypeObject->the_post(); ?>
      <?php get_template_part('template-parts/puff'); ?>
    <?php endwhile; ?>
  </div>
</section>

