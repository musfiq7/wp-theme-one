
<footer class="site-footer">
<nav class="site_nav">
<?php 
  
  $args = array(
    'theme_location' => 'footer'
  );
  
  wp_nav_menu($args) ?>
  </nav>
<h4><?php bloginfo('name') ?>  &copy; <?php the_time('Y') ?></h4>

</footer>
</div> <!--container end -->
<?php wp_footer() ?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>