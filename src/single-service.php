<?php get_header(); ?>
      <?php the_post() ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
            <header class="entry-header">
              <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            </header>
            <div class="entry-content">
              <div id='main-image' class="background-img" style="background-image:url(<?php echo get_post_meta( get_the_ID(), '_image', true ) ?>);"></div>
              <?php the_content(); ?>
            </div>
          </article>
          <hr>
          <?php get_template_part('template-parts/puffs')?>
      <?php voidx_post_navigation(); ?>
<?php get_footer(); ?>
