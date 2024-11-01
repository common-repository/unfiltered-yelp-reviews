<?php
/*
Plugin Name: UnFiltered
Plugin URI: http://workbold.com/wordpress-plugins/unfiltered.html
Description: This plugin helps draw attention and interaction to your filtered reviews on yelp, which could possibly get them out of the filter. It also works for regular reviews. You can display them almost exactly as they display on yelp with working links back to yelp to verify the source. You will have to manually parse the html output of the reviews to get all the necessary info, but until yelp figures out a how to make a better api without comprimising it's systems credibility, this is probably your best option for displaying reviews on your site. This saves a ton of time compared to manually editing each reviews html. USE AT YOUR OWN RISK! NOT OFFICIALLY ALLOWED OR SUPPORTED BY YELP!
Note: Activate the widget in the dashboard. May require debugging depending on theme.
Version: v1.0
Author: Nolan Dempster
Author URI: http://www.workbold.com
License: GPLv2
*/
?>
<?php require_once('review_type.php') ?>    

<?php
	
        global $post; 
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
        $reviewcomment = $custom["reviewcomment"][0];?>


<?php
//Creates Widget
class YelpReview extends WP_Widget {
//set the name and tell WP it's a widget
	function YelpReview() {
		// Instantiate the parent object
		parent::WP_Widget( false, 'Yelp Reviews' );
	}


	function widget( $args, $instance ) { ?>
<?php
//Add Additional Stylesheet & JS to Template Generated Pages and Posts
$prop_pluginsurl = plugins_url();
?>

<a name ="pagejump">
<link rel="stylesheet" type="text/css" href="<?php echo $prop_pluginsurl ?>/unfiltered-yelp-reviews/yelper.css">
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=MY APP ID";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<html xmlns:fb="http://ogp.me/ns/fb#">

<h6 class="reviews-header ieSucks"><a href="<?php echo bloginfo('url'); ?>/reviews/">
Note: Many of the reviews below are "filtered" and have not been "factored" into <?php echo bloginfo('name'); ?> overall star rating on Yelp.
 </h6><br><?php
$args = array('post_type' => 'reviews', 'numberposts' => 50, 'orderby' => 'rand' );
$rand_posts = get_posts ( $args );
        global $post; 

foreach ($rand_posts as $post) : setup_postdata($post); ?> 

<?php
	
        global $post; 
        $custom = get_post_custom($post->ID);
	$reviewslug = basename(get_permalink());
        $reviewid = $custom["reviewid"][0];
        $reviewerid = $custom["reviewerid"][0]; 
	$reviewerpic = $custom["reviewerpic"][0];
        $reviewername = $custom['reviewername'][0];
        $reviewerfriends = $custom["reviewerfriends"][0]; 
        $reviewerreviews = $custom["reviewerreviews"][0];
        $reviewercity = $custom["reviewercity"][0];	
        $reviewdate = $custom["reviewdate"][0]; 
        $reviewstars = $custom["reviewstars"][0];
        $reviewcomment = $custom["reviewcomment"][0];?>


	
<div id="reviews-other" class="review-container">

<div class="reviews-list">
<a href="bloginfo( 'name' );"><?php echo $reviewername; ?></a><br>
		<?php echo $reviewercity; ?>
  
<div id="review__<?php echo $reviewid; ?>" class="review externalReview clearfix ">
		<div class="wrap clearfix">
			<div class="reviewer">
				<div class="mini">
	<div class="photoBoxSm">
	<div class="clearStyles photoBox pB-ss">	
		<a href="<?php echo $reviewerid; ?>">
			<img src="<?php echo $reviewerpic; ?>" alt="Photo of <?php echo $reviewername; ?>" height="40" width="40">
				</a>
				</div>
	<p class="miniOrange is_elite ieSucks"></p>				 
	<p class="miniOrange friend_count ieSucks"><?php echo $reviewerfriends; ?><span class="offscreen">friends</span></p>
	<p class="miniOrange review_count ieSucks"><?php echo $reviewerreviews; ?><span class="offscreen">reviews</span></p>
</div></div><br><br>
	</p>
</div>
</div>			
	<div class="review_rating clearfix">
	<div class="rating">
<span class="star-img stars_<?php echo $reviewstars; ?>"><img class="" title="<?php echo $reviewstars; ?>.0 star rating" alt="<?php echo $reviewstars; ?>.0 star rating" src="<?php echo $prop_pluginsurl ?>/unfiltered-yelp-reviews/images/stars_map.png" height="325" width="84"></span>
	<span class="value-title" title="<?php echo $reviewstars; ?>"></span>
</div>
<span class="smaller highlight3 dtreviewed"><?php echo $reviewdate; ?><span class="value-title" title="2009-16-09"></span>
			</div>
</div>
	<p class="review_comment ieSucks"><?php echo $reviewcomment; ?></p> 
</div>
<fb:like href="/reviews/<?php echo $reviewslug; ?>" send="true" layout="button_count" width="210" show_faces="false"></fb:like>
<br><br>
<g:plusone size="small" annotation="inline" href="./reviews/<?php echo $reviewslug; ?>"></g:plusone>
<br><br>

<?php endforeach; ?>




<?php

	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}

function yelp_register_widgets() {
	register_widget( 'YelpReview' );
}

add_action( 'widgets_init', 'yelp_register_widgets' );

?>
