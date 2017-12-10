<?php

/*
  Plugin Name: GK HTML Content Stripper
  Plugin URI: http://www.greateck.com/
  Description: This wordpress plugin allows via a single run to remove any HTML formatting across all your posts' content.
  Version: 1.1.0
  Author: mcfarhat
  Author URI: http://www.greateck.com
  License: GPLv2
 */

//setting initial skipped tags as img and a href
update_option('gk-html-skipped-tags','<img><a>');
 
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
		//store value of skipped tags
		update_option('gk-html-skipped-tags',$_POST['skipped_tags']);
		//store value of max date
		$date = $_POST['max_date'];
		update_option('gk-html-skipped-max-date',$date);
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
			<i><div>In order to remove all HTML content from your posts, click the below button.</div>
			<div>You can chose to keep specific tags untouched via including them below via format <tag1><tag2><tag3>...</div>
			<div>You can also chose a specific maximum date for your posts so as only posts before this date will be affected</i><br/>
			<label for="skipped_tags">Skipped Tags</label><input type="text" name="skipped_tags" id="skipped_tags" value="<?php echo get_option('gk-html-skipped-tags'); ?>"><br/>
			<label for="max_date">Max Post Date</label><input type="date" name="max_date" id="max_date" value="<?php echo get_option('gk-html-skipped-max-date'); ?>"><br/>
			<input type="button" name="clear_posts"  id="clear_posts" value="Strip Posts">
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
	//grab date individual components
	$date = get_option('gk-html-skipped-max-date',$date);
	//find posts 
	$args = array(
        'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1,
    );
	if ($date!=""){
		$args['date_query'] = array(
								array(
									'before'    => array(
											'year'  => date('Y',strtotime($date)),
											'month' => date('m',strtotime($date)),
											'day'   => date('d',strtotime($date)),
										),
									)
								);
	}
	
	$the_query = new WP_Query($args);
	if($the_query->have_posts() ) :
		//loop through all posts and display ID and title of cleaned posts
		echo 'Cleanup List:';
		while ( $the_query->have_posts() ){ 
			$the_query->the_post();
			echo '<li>' . get_the_ID() . ' - ' . get_the_title() .'</li>';
			
			//store old data under old_html_content meta
			$cur_content = get_post_field('post_content', get_the_ID());
			
			update_post_meta(get_the_ID(), 'old_html_backup', $cur_content);
			
			//strip the content of tags, except images and links
			$edt_post = array(
				'ID'           => get_the_ID(),
				'post_content' => strip_tags($cur_content,get_option('gk-html-skipped-tags')),
			);
			
			//save
			wp_update_post( $edt_post );		
		}
	endif;
	echo 'complete!';
	wp_reset_postdata();
	
}

?>