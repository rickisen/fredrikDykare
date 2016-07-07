<?php get_header(); ?>
      <?php the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
        <header class="entry-header">
          <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        </header>
        <footer class="entry-meta">
          <?php printf( __( 'Posted <time datetime="%1$s">%2$s</time> by %3$s. ', 'voidx' ), get_post_time('c'), get_the_date(), get_the_author() ); ?>
          <?php _e( 'Categories: ', 'voidx' ); the_category( ', ' ); echo '. '; ?>
        </footer>
        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages(); ?>
        </div>
      </article>
<?php get_footer(); ?>
