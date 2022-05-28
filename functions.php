<?php

function all_resources(){
 wp_enqueue_style('default_css', get_stylesheet_uri(), null, time(), 'all');
 wp_enqueue_style('main_css', get_template_directory_uri().'/css/main.css', null, time(), 'all');

}

add_action('wp_enqueue_scripts','all_resources');


function tagtitleset(){
    add_theme_support( 'title-tag' );
}

add_action('init', 'tagtitleset');


register_nav_menus(array(
    'primary' => __('Primary menu'),
    'footer' => __('Footer menu')
));

function set_feature_image(){
 
    add_theme_support( 'post-thumbnails' ); 
}

add_action('after_setup_theme' , 'set_feature_image');


function set_excerpt_length(){
    return 25;

}

add_filter('excerpt_length', 'set_excerpt_length');


function set_my_sidebar_widget(){
    register_sidebar(array(
        'name' => 'Sidebar',
        'id'   => 'sidebar1'
    ));
}


add_action('widgets_init', 'set_my_sidebar_widget');



// custom contact form


function create_contact_form(){
    $content ='';
    $content .='<h2>Write a message</h2>';
    $content .='<form method="post" action="http://localhost/theme1/thank-you">';

    $content .='<label for="sender_name">Name</label><br/>';
    $content .='<input type="text" name="sender_name" placeholder="Enter your name" class="form-control" /><br/>';

    $content .='<label for="sender_email">Email</label><br/>';
    $content .='<input type="email" name="sender_email" placeholder="Enter your email" class="form-control"/><br/>';
    
    $content .='<label for="sender_msg">Message</label><br/>';
    $content .='<textarea name="sender_msg" placeholder="Enter your email" class="form-control"></textarea><br/>';
    
    $content .='<input type="submit" name="submit_email" value="send message"  class="btn btn-primary"/><br/>';

    $content .='</form>';

    return $content;
}

add_shortcode('my_contact_form','create_contact_form');


function send_form_data(){
    if(isset($_POST['submit_email'])){
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>"; 

        $name = sanitize_text_field($_POST['sender_name']);
        $email = sanitize_text_field($_POST['sender_email']);
        $msg = sanitize_textarea_field($_POST['sender_msg']);

        
        $to = 'samin.rubel@gmail.com';
        $subject = 'samin.rubel@gmail.com';
        $message = ''.$name.'-'.$email.'-'.$msg;
        wp_mail($to, $subject, $message);

        $name=" ";
        $email=" ";
        $msg=" ";
    }
}



add_action('wp_head', 'send_form_data');
