<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset');  ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <?php wp_head() ?>
</head>
<body <?php body_class(); ?>>

<!--container-->
   <div class="container">
  <header class="site-header">

  <h1><a href="<?php echo site_url(); ?>" ><?php bloginfo('name'); ?></a></h1> 
  <h3> <?php bloginfo('description'); ?></h3> 
  <?php get_search_form(); ?>
  <?php
  if(is_page('contact-us')){
?>
Contact with us to abc@gmail.com
  <?php 
}
  ?>
 
  <nav class="site_nav">
  <?php 
  
  $args = array(
    'theme_location' => 'primary'
  );
  
  wp_nav_menu($args) ?>
  </nav>
  </header>