<?php

get_header();
?>

<div class="wrapper">
<div class="main">
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
       <article class="post">
       <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
       <p><?php the_time('g:i a j F Y'); ?> | <a href="<?php echo get_author_posts_url(get_the_author_meta('id')) ?>"> <?php the_author(); ?></a> |
        <?php
        $categories = get_the_category();
        $separator = ',';
        $output = '';

        if ($categories) {

            foreach ($categories as $category) {
                $output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;
            }

            echo $output;
        }

        ?> 
        </p>
        <p>
        <?php the_post_thumbnail('thumbnail'); ?>
        </p>
        <p>
        <!---  ACF custom field plugin using for custom image field   -->
        <?php 
        $image = get_field('add_image');
        if (!empty($image)) : ?>
       <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" style="width:400px;" />
      <?php endif; ?>
        
        </p>
       <p><?php echo get_the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>">Read more -> </a>
       </p>
       </article>
      <?php

    }
} else {
    echo '<p> no post to show</p>';
}
?>
</div>
<div class="sidebar">
<?php dynamic_sidebar('sidebar1') ?>
</div>


</div>


<?php
get_footer();



?>