<?php

get_header();

$portfolioContent = new WP_Query(array(
    'post_per_page' => 2,
    'post_type' => 'portfolio'
));

if($portfolioContent->have_posts()){
  while($portfolioContent->have_posts()){
    $portfolioContent->the_post();
      ?>
       <article class="post">
       <p><?php the_post_thumbnail(array( 120, 120 ) , 'profile pic') ?></p>
       <h3><?php the_title(); ?></a></h3>
       <p><?php the_content(); ?></p> 
       <p>My Contact email: <span><?php echo get_post_meta( get_the_ID(), 'email_key', true); ?></span> </p>
   note: here email is custom meta box data , for desplaying it needed meta_key as in custom meta box creation in functions.php
   

       </article>
      <?php
  }
}else{
    echo '<p> no post to show</p>';
}

get_footer();



?>