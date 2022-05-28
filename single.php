<?php

get_header();

if(have_posts()){
  while(have_posts()){
      the_post();
      ?>
       <h1><?php the_title(); ?></h1>
       <p>
        <?php the_post_thumbnail('banner-image') ; ?>
        </p>
       <p><?php the_content(); ?></p>
      <?php
  }
}else{
    echo '<p> no post to show</p>';
}

get_footer();



?>