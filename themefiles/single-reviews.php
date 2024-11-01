<?php
/**
* 
Template Name: Single Reviews
* UnFiltered
* Single review template.
* 
* Last Update: Version 1.2
* 
**/
?>
<?php get_header(); ?>
	
<div id="content">
	<div class="content_inside">
				
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
        $reviewcomment = $custom["reviewcomment"][0];

        echo '<input type="hidden" name="tcm-nonce" id="tcm-nonce" value="' .wp_create_nonce('tc-m'). '" />';
?>

<link rel="stylesheet" type="text/css" href="http://media1.ct.yelpcdn.com/static/201006241760126241/css/www-pkg-en_US.min.css">

		<link rel="stylesheet" type="text/css" media="all" href="http://media2.ct.yelpcdn.com/static/201006241218112331/css/biz_details-pkg-en_US.min.css">
		
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
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=306804906005179";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<html xmlns:fb="http://ogp.me/ns/fb#">

<div id="reviews-other" class="review-container">
<br><br>
<h3 class="reviews-header ieSucks">
Note: Many of the reviews below are "filtered" and have not been "factored" into the overall star rating for <?php bloginfo('name'); ?> on Yelp.
 </h3>

<div class="reviews-list">

  
<div id="review__<?php echo $reviewid; ?>" class="review externalReview clearfix ">
		<div class="wrap clearfix">
			<div class="reviewer">
				<div class="mini">
	<div class="photoBoxSm">
	<div class="clearStyles photoBox pB-ss">	
		<a href="<?php echo $reviewerid; ?>" class="reviewer_name reviewer">
			<img src="<?php echo $reviewerpic; ?>" alt="Photo of <?php echo $reviewername; ?>" height="40" width="40">
				</a>
				</div>
	<p class="miniOrange is_elite ieSucks"></p>				 
	<p class="miniOrange friend_count ieSucks"><?php echo $reviewerfriends; ?><span class="offscreen">friends</span></p>
	<p class="miniOrange review_count ieSucks"><?php echo $reviewerreviews; ?><span class="offscreen">reviews</span></p>
</div></div><p class="reviewer_info"><a href="<?php echo $reviewerid; ?>" class="reviewer_name reviewer"><?php echo $reviewername; ?></a>
			<p class="reviewer_info"><?php echo $reviewercity; ?></p>
	</p>
</div>
</div>			
	<div class="review_rating clearfix">
	<div class="rating">
<span class="star-img stars_<?php echo $reviewstars; ?>"><img class="" title="<?php echo $reviewstars; ?>.0 star rating" alt="<?php echo $reviewstars; ?>.0 star rating" src="http://media4.ak.yelpcdn.com/static/201012162808913227/img/ico/stars/stars_map.png" height="325" width="84"></span>
	<span class="value-title" title="<?php echo $reviewstars; ?>"></span>
</div>
<span class="smaller highlight3 dtreviewed"><?php echo $reviewdate; ?><span class="value-title" title="2009-16-09"></span>
			</div>
</div>
	<p class="review_comment ieSucks"><?php echo $reviewcomment; ?></p> 
</div>

<fb:like href="<?php echo home_url(); ?>/reviews/<?php echo $reviewslug; ?>" send="true" layout="button_count" width="210" show_faces="false"></fb:like>
<br><br>
<g:plusone size="small" annotation="inline" href="<?php echo home_url(); ?>/reviews/<?php echo $reviewslug; ?>"></g:plusone>
<br><br>

				
		</div> <!--end of main_content-->			
	</div>
</div> <!--end of content-->

<?php get_footer(); ?>
