<?php

get_header();



if(have_posts()){
  while(have_posts()){
      the_post();
      ?>
       <article class="post">
       <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
       <p><?php the_time(' g:i a j F Y '); ?> | By <a href="<?php echo get_author_posts_url(get_the_author_meta('id'));  ?>"><?php the_author(); ?> </a>|
       <?php 
       
       $categories = get_the_category();
       $separator = ',';
       $output = '';

       if($categories){

        foreach ($categories as $category) {
           
             $output .='<a href="'.get_category_link($category->term_id).'" >'. $category ->cat_name .'</a>' .$separator;  

            
        }

        echo trim($output, $separator);
       }
       
       ?></p>
       <p><?php the_content(); ?></p>
       </article>
      <?php
  }
}else{
    echo '<p> no post to show</p>';
}

get_footer();



?>