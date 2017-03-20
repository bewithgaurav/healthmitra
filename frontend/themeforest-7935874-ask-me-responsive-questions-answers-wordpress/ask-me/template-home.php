<?php /* Template Name: Home page */
get_header();
	$posts_per_page        = rwmb_meta('vbegy_posts_per_page','text',$post->ID);
	$vbegy_index_tabs      = rwmb_meta('vbegy_index_tabs','checkbox',$post->ID);
	$vbegy_pagination_tabs = rwmb_meta('vbegy_pagination_tabs','checkbox',$post->ID);
	$vbegy_what_tab        = get_post_meta($post->ID,'vbegy_what_tab');
	$posts_meta            = vpanel_options("post_meta");
	$posts_per_page        = ($posts_per_page != "")?$posts_per_page:get_option("posts_per_page");
	$paged                 = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	if ($vbegy_index_tabs == 1) {
		$pagination_tabs = array();
		if ($vbegy_pagination_tabs == 1) {
			$pagination_tabs = array("paged" => $paged);
		}?>
		<div class="tabs-warp question-tab">
		    <ul class="tabs">
			<?php if (is_array($vbegy_what_tab) && in_array("recent_questions",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="recent_questions"><?php _e("Recent Questions","vbegy")?></a></li>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("most_responses",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="most_responses"><?php _e("Most Responses","vbegy")?></a></li>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("recently_answered",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="recently_answered"><?php _e("Recently Answered","vbegy")?></a></li>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("no_answers",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="no_answers"><?php _e("No answers","vbegy")?></a></li>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("most_visit",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="most_visit"><?php _e("Most Visit","vbegy")?></a></li>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("most_vote",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="most_vote"><?php _e("Most Vote","vbegy")?></a></li>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("recent_posts",$vbegy_what_tab)) {?>
				<li class="tab"><a href="#" data-js="recent_posts"><?php _e("Recent Posts","vbegy")?></a></li>
			<?php }?>
		    </ul>
		    <?php if (is_array($vbegy_what_tab) && in_array("recent_questions",$vbegy_what_tab)) {?>
			    <div class="tab-inner-warp">
					<div class="tab-inner">
						<?php $args = array_merge($pagination_tabs,array("post_type" => "question","posts_per_page" => $posts_per_page));
						query_posts($args);
						get_template_part("loop-question");
						if ($vbegy_pagination_tabs == 1) {
							vpanel_pagination();
						}
						wp_reset_query();?>
				    </div>
				</div>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("most_responses",$vbegy_what_tab)) {?>
				<div class="tab-inner-warp">
					<div class="tab-inner">
						<?php $args = array_merge($pagination_tabs,array("post_type" => "question","orderby" => "comment_count","posts_per_page" => $posts_per_page));
						query_posts($args);
						get_template_part("loop-question");
						if ($vbegy_pagination_tabs == 1) {
							vpanel_pagination();
						}
						wp_reset_query();?>
				    </div>
				</div>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("recently_answered",$vbegy_what_tab)) {?>
				<div class="tab-inner-warp">
					<div class="tab-inner">
						<?php $offset   = ($paged-1)*$posts_per_page;
						$comments	    = get_comments(array("post_type" => "question","status" => "approve"));
						$query		    = get_comments(array("offset" => $offset,"post_type" => "question","status" => "approve","number" => $posts_per_page));
						$total_comments = count($comments);
						$total_query    = count($query);
						$total_pages    = (int)ceil($total_comments/$posts_per_page);
						if ($query) {?>
							<div id="commentlist" class="page-content">
								<ol class="commentlist clearfix">
									<?php
									foreach ($query as $comment) {
										$comment_vote = get_comment_meta($comment->comment_ID,'comment_vote');
										$comment_vote = (!empty($comment_vote)?$comment_vote[0]["vote"]:"");
										if ($comment->user_id != 0){
											$user_login_id_l = get_user_by("id",$comment->user_id);
										}
										
										$question_category = wp_get_post_terms($comment->comment_post_ID,'question-category',array("fields" => "all"));
										$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
										$yes_private = 0;
										if (isset($question_category[0])) {
											if (isset($question_category[0]) && isset($get_question_category['private']) && $get_question_category['private'] == "on") {
												if (isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == get_current_user_id()) {
													$yes_private = 1;
												}
											}else if (isset($question_category[0]) && !isset($get_question_category['private']) && $question_category[0]->parent == 0) {
												$yes_private = 1;
											}
											
											if (isset($question_category[0]) && $question_category[0]->parent > 0) {
												$get_question_category_parent = get_option("questions_category_".$question_category[0]->parent);
												if (isset($get_question_category_parent[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on" && isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == get_current_user_id()) {
													$yes_private = 1;
												}else if (isset($question_category[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on" && !isset($authordata->ID)) {
													$yes_private = 0;
												}
											}
										}else {
											$yes_private = 1;
										}
										if (is_super_admin(get_current_user_id())) {
											$yes_private = 1;
										}
										if ($yes_private == 1) {
											include("includes/answers.php");
										}
									}?>
								</ol>
							</div>
							<?php if ($total_comments > $total_query && $vbegy_pagination_tabs == 1) {
								echo '<div class="pagination">';
								$current_page = max(1,$paged);
								echo paginate_links(array(
									'base' => get_pagenum_link(1).'%_%',
									'format' => 'page/%#%/',
									'show_all' => false,
									'current' => $current_page,
									'total' => $total_pages,
									'prev_text' => '<i class="icon-angle-left"></i>',
									'next_text' => '<i class="icon-angle-right"></i>',
								));
								echo '</div><div class="clearfix"></div>';
							}
						}else {
							echo "<div class='page-content page-content-user'><p class='no-item'>".__("No answers Found.","vbegy")."</p></div>";
						}?>
				    </div>
				</div>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("no_answers",$vbegy_what_tab)) {?>
				<div class="tab-inner-warp">
					<div class="tab-inner">
						<?php 
						$result = $wpdb->get_results("SELECT * FROM ".$wpdb->posts." WHERE post_type = 'question' AND post_status = 'publish' AND comment_count = 0 ORDER BY comment_count DESC");
						if ($result) {
							$totalpages = ceil($wpdb->num_rows/$posts_per_page);
							if ($vbegy_pagination_tabs == 1) {
								$startfrom = ($paged -1) * $posts_per_page;
							}else {
								$startfrom = 0;
							}
							$result_2 = $wpdb->get_results("SELECT * FROM ".$wpdb->posts." WHERE post_type = 'question' AND post_status = 'publish' AND comment_count = 0 ORDER BY comment_count DESC limit ".$startfrom.",".$posts_per_page);
							$k = 0;
							if ($result_2) {
								foreach ($result_2 as $post) {
									$k++;
									setup_postdata($post);
									include ("question.php");
								}
							}else {
								echo "<div class='page-content page-content-user'><p class='no-item'>".__("No Questions Found.","vbegy")."</p></div>";
							}
							if ($vbegy_pagination_tabs == 1) {
								$current = max(1,$paged);
								echo '<div class="pagination">';
								$current_page = max(1,$paged);
								echo paginate_links(array(
									'base' => get_pagenum_link(1).'%_%',
									'format' => 'page/%#%/',
									'current' => $current,
									'show_all' => false,
									'total' => $totalpages,
									'prev_text' => '<i class="icon-angle-left"></i>',
									'next_text' => '<i class="icon-angle-right"></i>',
								));
								echo '</div>';
							}
						}else {
							echo "<div class='page-content page-content-user'><p class='no-item'>".__("No Questions Found.","vbegy")."</p></div>";
						}
						wp_reset_postdata();?>
				    </div>
				</div>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("most_visit",$vbegy_what_tab)) {?>
				<div class="tab-inner-warp">
					<div class="tab-inner">
						<?php $args = array_merge($pagination_tabs,array("posts_per_page" => $posts_per_page,"post_type" => "question","orderby" => "meta_value_num","meta_key" => "post_stats","meta_query" => array(array('type' => 'numeric',"key" => "post_stats","value" => 0,"compare" => ">="))));
						query_posts($args);
						get_template_part("loop-question");
						if ($vbegy_pagination_tabs == 1) {
							vpanel_pagination();
						}
						wp_reset_query();?>
				    </div>
				</div>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("most_vote",$vbegy_what_tab)) {?>
				<div class="tab-inner-warp">
					<div class="tab-inner">
						<?php $args = array_merge($pagination_tabs,array("posts_per_page" => $posts_per_page,"post_type" => "question","orderby" => "meta_value_num","meta_key" => "question_vote","meta_query" => array(array('type' => 'numeric',"key" => "question_vote","value" => 0,"compare" => ">"))));
						query_posts($args);
						get_template_part("loop-question");
						if ($vbegy_pagination_tabs == 1) {
							vpanel_pagination();
						}
						wp_reset_query();?>
				    </div>
				</div>
			<?php }
			if (is_array($vbegy_what_tab) && in_array("recent_posts",$vbegy_what_tab)) {?>
				<div class="tab-inner-warp">
					<div class="tab-inner">
						<?php wp_reset_query();
						$vbegy_sidebar_all = vpanel_sidebars("sidebar_where");
						$args = array_merge($pagination_tabs,array("post_type" => "post","posts_per_page" => $posts_per_page));
						$blog_style = vpanel_options("home_display");
						query_posts($args);
						get_template_part("loop");
						if ($vbegy_pagination_tabs == 1) {
							vpanel_pagination();
						}
						wp_reset_query();?>
				    </div>
				</div>
			<?php }?>
		</div><!-- End page-content -->
		<?php vpanel_pagination();
	}else if ($vbegy_index_tabs == 2) {
		$args = array("paged" => $paged,"post_type" => "question","posts_per_page" => $posts_per_page);
		query_posts($args);
		get_template_part("loop-question");
		vpanel_pagination();
	}else {
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
			$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
			$vbegy_google = rwmb_meta('vbegy_google',"textarea",$post->ID);
			$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
			$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
			$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
			if ($video_type == 'youtube') {
				$type = "http://www.youtube.com/embed/".$video_id;
			}else if ($video_type == 'vimeo') {
				$type = "http://player.vimeo.com/video/".$video_id;
			}else if ($video_type == 'daily') {
				$type = "http://www.dailymotion.com/swf/video/".$video_id;
			}
			$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
			$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
			$post_comments_s = rwmb_meta('vbegy_post_comments_s','checkbox',$post->ID);
			$vbegy_sidebar_all = vpanel_sidebars("sidebar_where");?>
			<article <?php post_class('post single-post');?> id="post-<?php the_ID();?>">
				<div class="post-inner">
					<div class="post-img<?php if ($vbegy_what_post == "image" && !has_post_thumbnail()) {echo " post-img-0";}else if ($vbegy_what_post == "video") {echo " video_embed";}if ($vbegy_sidebar_all == "full") {echo " post-img-12";}else {echo " post-img-9";}?>">
						<?php include (get_template_directory() . '/includes/head.php');?>
					</div>
		        	<h2 class="post-title"><?php the_title()?></h2>
					<?php $posts_meta = vpanel_options("post_meta");
					if (($posts_meta == 1 && $post_meta_s == "") || ($posts_meta == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {?>
						<div class="post-meta">
						    <span class="meta-author"><i class="icon-user"></i><?php the_author_posts_link();?></span>
						    <span class="meta-date"><i class="icon-time"></i><?php the_time($date_format);?></span>
						    <span class="meta-comment"><i class="icon-comments-alt"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
						    <span class="post-view"><i class="icon-eye-open"></i><?php $post_stats = get_post_meta($post->ID, 'post_stats', true);echo ($post_stats != ""?$post_stats:0);?> <?php _e("views","vbegy");?></span>
						</div>
					<?php }?>
					<div class="post-content">
						<?php the_content();?>
						<div class="clearfix"></div>
					</div>
				</div><!-- End post-inner -->
			</article><!-- End article.post -->
			<?php $post_comments = vpanel_options("post_comments");
			if (($post_comments == 1 && $post_comments_s == "") || ($post_comments == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_comments == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s == 1)) {
				comments_template();
			}
		endwhile; endif;
	}
get_footer();?>