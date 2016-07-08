<section class="excerpt">
  <h2><a href="<?php the_permalink() ?>"> <?php the_title(); ?></a></h2>
  <p>
    <?php the_excerpt(); ?>
  </p>
  <footer>
    <p> <?php the_author_posts_link(); echo "  " ; the_time("Y-M-D H:i"); echo '<br>'.get_post_type();?></p>
  </footer>
</section>
