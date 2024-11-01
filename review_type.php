<?php
/**
 * 
 * UnFiltered
 * Custom post type and inputs for reviews
 * 
**/
add_action('init', 'reviews');

function reviews() {
  $labels = array(
    'name' => _x('Reviews', 'post type general name'),
    'singular_name' => _x('Review', 'post type singular name'),
    'add_new' => _x('New Review', 'review'),
    'add_new_item' => __('Create New Review'),
    'edit_item' => __('Edit Review'),
    'new_item' => __('New Review'),
    'view_item' => __('View Review'),
    'search_items' => __('Search Review'),
    'not_found' =>  __('No reviews found'),
    'not_found_in_trash' => __('No reviews found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 7,
    'menu_icon' => plugins_url() . '/unfiltered-yelp-reviews/images/yelpmenu.png',
    'supports' => array('')
  ); 
register_post_type('reviews',$args);
} ?><?php add_filter('post_updated_messages', 'reviews_updated_messages');
function reviews_updated_messages( $messages ) {

  $messages['reviews'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Review updated. <a href="%s">View Review</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Review updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Review restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Review published. <a href="%s">View review</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Review saved.'),
    8 => sprintf( __('Review submitted. <a target="_blank" href="%s">Preview review</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Review scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview review</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Review draft updated. <a target="_blank" href="%s">Review</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

/*===================== Create Post Title Using Meta Data=================*/
   

function create_review_title_meta($review_meta_title){
     global $post;
    	
	if ($post->post_type == 'reviews') {
         $review_meta_title = $_POST['reviewername'];
     }
     return $review_meta_title;
}
add_filter('title_save_pre','create_review_title_meta');
    ?>

<?php function unf_reviews_metadata(){  
        
        $custom = get_post_custom($post->ID);
	$yelpcss = $custom["yelpcss"][0];  
        $reviewid = $custom["reviewid"][0];
        $reviewerid = $custom["reviewerid"][0]; 
	$reviewerpic = $custom["reviewerpic"][0];
        $reviewername = $custom['reviewername'][0];
        $reviewerfriends = $custom["reviewerfriends"][0]; 
        $reviewerreviews = $custom["reviewerreviews"][0];
        $reviewercity = $custom["reviewercity"][0];	
        $reviewdate = $custom["reviewdate"][0]; 
        $reviewstars = $custom["reviewstars"][0];
        $reviewcomment = $custom["reviewcomment"][0];

?>
<div class="reviews_metadata"> 
<table>
<tr>
<th scope="col"></th>
<th scope="col"></th>
</tr>
<tr>
  <tr><th scope="row"><label><td><?php _e("Review Date:"); ?></label></th>
<td><input name="reviewdate" value="<?php echo $reviewdate; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Review Stars:"); ?></label></th>
<td><input name="reviewstars" value="<?php echo $reviewstars; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Review Comment:"); ?></label></th>
<td><br><textarea name="reviewcomment"><?php echo $reviewcomment; ?></textarea><br><br>
 <tr><th scope="row"><label><td><?php _e("Reviewer URL:"); ?></label></th>
<td><input name="reviewerid" value="<?php echo $reviewerid; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Reviewer Pic URL:"); ?></label></th>
<td><input name="reviewerpic" value="<?php echo $reviewerpic; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Reviewer Name:"); ?></label></th>
<td><input name="reviewername" value="<?php echo $reviewername; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Reviewer Friends:"); ?></label></th>
<td><input name="reviewerfriends" value="<?php echo $reviewerfriends; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Reviewer Reviews:"); ?></label></th>
<td><input name="reviewerreviews" value="<?php echo $reviewerreviews; ?>" /></td></tr><br/>
 <tr><th scope="row"><label><td><?php _e("Reviewer City:"); ?></label></th>
<td><input name="reviewercity" value="<?php echo $reviewercity; ?>" /></td></tr><br/>
</tr>
</table>
</div> 
    
 
<?php  
}
    //save custom field data//
function save_meta_reviews($post_id){  
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	
	   	update_post_meta($post_id, "yelpcss", $_POST["yelpcss"]);
   		update_post_meta($post_id, "reviewid", $_POST["reviewid"]);
   		update_post_meta($post_id, "reviewdate", $_POST["reviewdate"]); 
   		update_post_meta($post_id, "reviewstars", $_POST["reviewstars"]);   
	   	update_post_meta($post_id, "reviewcomment", $_POST["reviewcomment"]);

	   	update_post_meta($post_id, "reviewerid", $_POST["reviewerid"]);  
	  	update_post_meta($post_id, "reviewerpic", $_POST["reviewerpic"]);   
	   	update_post_meta($post_id, "reviewername", $_POST["reviewername"]);
	   	update_post_meta($post_id, "reviewerfriends", $_POST["reviewerfriends"]); 
	   	update_post_meta($post_id, "reviewerreviews", $_POST["reviewerreviews"]);    
	   	update_post_meta($post_id, "reviewercity", $_POST["reviewercity"]);
	   	
	}  
	
	
add_action('save_post', 'save_meta_reviews'); 

function add_reviews_metadata(){  
        add_meta_box('reviews_metadata', __('Review Details', 'unf_reviews_metadata'), 'reviews_metadata', 'reviews');  
} 
    
add_action('admin_init', 'add_reviews_metadata'); 
//end custom post type section//
    

//testsgood    
// Creating the column layout when viewing list of Reviews in the backend
add_action("manage_posts_custom_column",  "reviews_custom_columns");
add_filter("manage_edit-reviews_columns", "reviews_edit_columns");
 
function reviews_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "reviewername" => "Reviewer Name",
    "reviewstars" => "Review Stars",
    "reviewcomment" => "Review Comment",
    
    
  );
 
  return $columns;
}

function reviews_custom_columns($column)
{
	global $post;
	$custom = get_post_custom($post->ID);
        $reviewid = $custom["reviewid"][0];
        $reviewerid = $custom["reviewerid"][0]; 
	$reviewerpic = $custom["reviewerpic"][0];
        $reviewername = $custom['reviewername'][0];
        $reviewerfriends = $custom["reviewerfriends"][0]; 
        $reviewerreviews = $custom["reviewerreviews"][0];
        $reviewercity = $custom["reviewercity"][0];	
        $reviewdate = $custom["reviewdate"][0]; 
        $reviewstars = $custom["reviewstars"][0];
        $reviewcomment = $custom["reviewcomment"][0];
	
	if ("ID" == $column) echo $post->ID; //displays title
	elseif ("reviewername" == $column) echo $custom['reviewername'][0] ; 
	elseif ("reviewstars" == $column) echo $custom['reviewstars'][0] ; 
	elseif ("reviewcomment" == $column) echo $custom['reviewcomment'][0] ; 
	
}


?>
