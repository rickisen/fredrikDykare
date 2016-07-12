<figure class="puff">
    <a href="<?php the_permalink() ?>"><h3> <?php the_title(); ?></h3></a>
    <div class="background-img" style="background-image:url(<?php echo get_post_meta( get_the_ID(), '_image', true ) ?>);"></div>
  <figcaption><?php the_excerpt() ?></figcaption>
</figure>

