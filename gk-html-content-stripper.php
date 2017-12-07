<?php

/*
  Plugin Name: GK HTML Content Stripper
  Plugin URI: http://www.greateck.com/
  Description: This wordpress plugin allows via a single run to remove any HTML formatting across all your posts' content, while only maintaining image and a href links as removing those might lose critical data/links
  Version: 1.0.0
  Author: mcfarhat
  Author URI: http://www.greateck.com
  License: GPLv2
 */
 
/* adding relevant backend menu */
add_action( 'admin_menu', 'gk_html_stripper_menu' );
function gk_html_stripper_menu() {
	add_menu_page( 'HTML Stripper', 'HTML Stripper', 'manage_options', 'gk-html-content-stripper', 'gk_render_html_stripper_options');
}
	
/* call back function for display of strip button and actual execution */
function gk_render_html_stripper_options(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
	<h2>GK HTML Content Stripper</h2>
	<!--container for the form data-->
	<div class="wrap">
<?php
	
	if(isset($_POST['proceed_cleanup'])){
		strip_html_content();
	}else{
?>
		<script>
			jQuery(document).ready(function($){
				$('#clear_posts').click(function(e){
					var proceed = confirm('Are you sure you want to remove HTML content?');
					if (proceed){
						$('#gk_html_stripper_form').submit();
					}
				});
			});
		</script>
	
		<form method="post" id="gk_html_stripper_form">
			<div>In order to remove all HTML content from your posts, click the below button. Keep in mind img and a href tags will be maintained to avoid loss of data</div>
			<input type="button" name="clear_posts"  id="clear_posts" value="Clear All Posts">
			<input type="hidden" name="proceed_cleanup" id="proceed_cleanup">
		</form>
	
	
<?php
	}
?>
	</div>
<?php
}
 
/* function that handles stripping HTML content */
function strip_html_content(){
	//find posts 
	$args = array(
        'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1,
    );
	
	$the_query = new WP_Query($args);
	if($the_query->have_posts() ) :
		//loop through all posts and display ID and title of cleaned posts
		while ( $the_query->have_posts() ){ 
			$the_query->the_post();
			echo 'Cleanup List:';
			echo '<li>' . get_the_ID() . ' - ' . get_the_title() .'</li>';
			
			//store old data under old_html_content meta
			$cur_content = get_post_field('post_content', get_the_ID());
			
			update_post_meta(get_the_ID(), 'old_html_backup', $cur_content);
			
			//strip the content of tags, except images and links
			$edt_post = array(
				'ID'           => get_the_ID(),
				'post_content' => strip_tags($cur_content,'<img><a>'),
			);
			
			//save
			wp_update_post( $edt_post );		
		}
	endif;
	echo 'complete!';
	wp_reset_postdata();
	
}

?>