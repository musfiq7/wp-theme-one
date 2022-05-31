<?php
function add_email_meta_box( ){
    // add_meta_box( 'skill_meta_box_this_id', 'Skill', 'skill_callback', 'skill','side' );
    add_meta_box('email_meta_id', 'Email', 'email_callback', 'portfolio');
    
  }
  
  
  
  //This callback function will print the HTML markup into the meta box
  function email_callback( $post ){
    
    // we should consider keeping things safe. We need to call the function wp_nonce_field
    wp_nonce_field('email_nonce_id', 'email_nonce' );
  
    $value = get_post_meta($post->ID, 'email_key', true);
    echo'<label for="skill_field">Email </label>';
    echo'<input type="text" id="email_field" name="email_field" value="'.esc_attr($value).'" size="25" />';
  
    
    
  }
  
  add_action( 'add_meta_boxes', 'add_email_meta_box' );
  
  function save_email_data($post_id){
   if (! isset($_POST['email_nonce'])){
     return;
   }
  
   if(!wp_verify_nonce($_POST['email_nonce'], 'save_email_data')){
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
