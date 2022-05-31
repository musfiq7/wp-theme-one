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


//***************************************************//
//Custom post type - portfolio
//****************************************************//
function portfolio_custom_post_type(){
    $labels = array(
      'name' => 'Portfolio',
      'singular_name' => 'portfolio',
      'add_new' => 'Add Portfolio Item',
      'all_items' => 'Portfolio Items',
      'add_new_item' => 'Add new Portfolio Item',
      'edit_item' => 'Edit Portfolio Item',
      'new_item' => 'New Portfolio Item',
      'view_item' => 'View Portfolio Item',
      'search_item' => 'Search Portfolio',
      'not_found' => 'No Item Found',
      'not_found_in_trash' => 'No Item Found In Trash',
      'parent_item_colon' => 'Parent Item',
    );
    $args = array(
      'labels' => $labels,
      'rewrite' => true,
    
     
      // Removes support for the "Add New" function ( use 'do_not_allow' instead of false for multisite set ups )
      'map_meta_cap' => true, // Set to true for edit otion, Set to `false`, if users are not allowed to edit/delete existing posts
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      // 'show_in_menu'        => true,
      
      // 'show_in_nav_menus'   => true,
      // 'show_in_admin_bar'   => true,
      'menu_position'       => 9,
      // 'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'query_var'  => true,
      'capability_type'     => 'post',
      'show_in_rest' => true,
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'revisions',
        
      ),
      'taxonomies' => array('category', 'post_tag'),
    );
    
     register_post_type('portfolio', $args);
  }
  
  add_action('init', 'portfolio_custom_post_type' );


  //**********************************************************/
//custom meta box email field for custom post type portfolio 
//***********************************************************/

function add_email_meta_box( ){
    add_meta_box( 'email_meta_box_id', 'Email', 'email_callback', 'portfolio' );
    
  }
  
  
  
  //This callback function will print the HTML markup into the meta box
  function email_callback( $post ){
    
    // we should consider keeping things safe. We need to call the function wp_nonce_field
    wp_nonce_field('save_email_data', 'email_nonce' );
  
    $value = get_post_meta($post->ID, 'email_key', true);
    echo'<label for="email_field">Skill </label>';
    echo'<input type="text" id="email_field" name="email_field" value="'.esc_attr($value).'" size="25" />';
  
    
    
  }
  
  add_action( 'add_meta_boxes', 'add_email_meta_box' );
  
  function save_email_data($post_id){
   if (! isset($_POST['email_nonce'])){
     return;
   }
  
   if(! wp_verify_nonce($_POST['email_nonce'], 'save_email_data')){
     return;
   }
  
   if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
     return;
   }
  
   if(! current_user_can('edit_post', $post_id)){
     return;
   }
  
   if(! isset($_POST['email_field'])){
     return;
   }
  
   $my_data = sanitize_text_field($_POST['email_field']);
  
   update_post_meta($post_id,'email_key', $my_data);
   
  
  }
  
  add_action('save_post', 'save_email_data' );



//*********************************************/
//for making column in portfolio admin
//*********************************************/

//*********************************************/
//for making column in skill admin
//*********************************************/

add_filter('manage_portfolio_posts_columns', 'email_column_callback'); // here posttype should declare obvious = 'manage_yourposttype_posts_columns'
add_action('manage_portfolio_posts_custom_column', 'email_custom_column_callback',10,2); // here pretty much same only columns would be column and custom will be added as prefix before post

function email_column_callback($columns){
//  unset($columns['tags']);
  $newColumns = array();
  $newColumns['title'] = 'User Title';
  $newColumns['bio'] = 'Bio';
  $newColumns['email'] = 'Email';
  $newColumns['feature_img'] = 'Feature Image';
  return $newColumns;
}

function email_custom_column_callback($column, $post_id){

    // Set thumbnail size
add_image_size( 'portfolio-admin-featured-image', 100, 100, false );

  switch($column){
    case 'bio':
        echo get_the_excerpt();
  
    case 'email':
    $email = get_post_meta($post_id, 'email_key', true);
    echo $email;
        break;
    case 'feature_img':
        if( function_exists('the_post_thumbnail') )
          echo the_post_thumbnail( 'portfolio-admin-featured-image' );
        break;
    
  }
}