<?php get_header(); ?>
  <?php the_post(); ?>

  <article id="frontpage-page" <?php post_class(); ?> role="article">
    <header class="entry-header">
      <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    </header>

    <div id='main-image' class="background-img" style="background-image:url(http://i.imgur.com/Jg3Zjlb.jpg);"></div>

    <div class="entry-content">
      <?php the_content(); ?>
      <?php wp_link_pages(); ?>
    </div>
  </article>
  <hr>

  <?php get_template_part('template-parts/puffs')?>
  <hr>
<?php get_footer(); ?>
