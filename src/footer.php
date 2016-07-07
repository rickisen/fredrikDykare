      </main>
    </div> <!-- wrap-main end -->
      <footer id="colophon" class="site-footer">
        <?php if ( is_active_sidebar( 'footer-widget-area' ) ) { ?>
            <div class="widget-area">
              <?php dynamic_sidebar( 'footer-widget-area' ); ?>
            </div>
        <?php } ?>
      </footer>
    <?php wp_footer(); ?>
  </body>
</html>
