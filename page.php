<?php

get_header();



if(have_posts()){
  while(have_posts()){
      the_post();
      ?>
       <article class="post">
       <h1><?php the_title(); ?></a></h1>
       <p><?php the_content(); ?></p>
       </article>
      <?php
  }
}else{
    echo '<p> no post to show</p>';
}

get_footer();



?>