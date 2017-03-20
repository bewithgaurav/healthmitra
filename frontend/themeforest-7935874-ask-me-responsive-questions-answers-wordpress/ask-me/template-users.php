<?php /* Template Name: Users */
get_header();

	$rows_per_page = get_option("posts_per_page");
	$paged         = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$offset		   = ($paged-1)*$rows_per_page;
	$users		   = get_users('blog_id=1&orderby=registered');
	$query         = get_users('&offset='.$offset.'&number='.$rows_per_page.'&blog_id=1&orderby=registered');
	$total_users   = count($users);
	$total_query   = count($query);
	$total_pages   = (int)ceil($total_users/$rows_per_page);
	  
	foreach ($query as $user) {
		$you_avatar = get_the_author_meta('you_avatar',$user->ID);
		$country = get_the_author_meta('country',$user->ID);
		$url = get_the_author_meta('url',$user->ID);
		$twitter = get_the_author_meta('twitter',$user->ID);
		$facebook = get_the_author_meta('facebook',$user->ID);
		$google = get_the_author_meta('google',$user->ID);
		$linkedin = get_the_author_meta('linkedin',$user->ID);
		$follow_email = get_the_author_meta('follow_email',$user->ID);
		$youtube = get_the_author_meta('youtube',$user->ID);
		$pinterest = get_the_author_meta('pinterest',$user->ID);
		$instagram = get_the_author_meta('instagram',$user->ID);?>  
		<div class="about-author clearfix">
			<div class="author-image">
			<a href="<?php echo vpanel_get_user_url($user->ID);?>" original-title="<?php echo $user->display_name?>" class="tooltip-n">
				<?php if ($you_avatar) {
					$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $user->ID)),"full",65,65);
					echo "<img alt='".$user->display_name."' src='".$you_avatar_img."'>";
				}else {
					echo get_avatar(get_the_author_meta('user_email',$user->ID),'65','');
				}?>
			</a>
			</div>
			<div class="author-bio">
				<h4><a href="<?php echo vpanel_get_user_url($user->ID);?>"><?php echo $user->display_name?></a><?php echo vpanel_get_badge($user->ID)?></h4>
				<?php echo $user->description?>
				<div class="clearfix"></div>
				<br>
				<?php if ($facebook || $twitter || $linkedin || $google || $follow_email || $youtube || $pinterest || $instagram) { ?>
					<span class="user-follow-me"><?php _e("Follow Me","vbegy")?></span>
					<?php if ($facebook) {?>
					<a href="<?php echo $facebook?>" original-title="<?php _e("Facebook","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
								<i class="social_icon-facebook"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($twitter) {?>
					<a href="<?php echo $twitter?>" original-title="<?php _e("Twitter","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
								<i class="social_icon-twitter"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($linkedin) {?>
					<a href="<?php echo $linkedin?>" original-title="<?php _e("Linkedin","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
								<i class="social_icon-linkedin"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($google) {?>
					<a href="<?php echo $google?>" original-title="<?php _e("Google plus","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
								<i class="social_icon-gplus"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($youtube) {?>
					<a href="<?php echo $youtube?>" original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#ef4e41" span_hover="#2f3239">
								<i class="social_icon-youtube"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($pinterest) {?>
					<a href="<?php echo $pinterest?>" original-title="<?php _e("Pinterest","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#e13138" span_hover="#2f3239">
								<i class="social_icon-pinterest"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($instagram) {?>
					<a href="<?php echo $instagram?>" original-title="<?php _e("Instagram","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#548bb6" span_hover="#2f3239">
								<i class="social_icon-instagram"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($follow_email) {?>
					<a href="<?php echo $follow_email?>" original-title="<?php _e("Email","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
								<i class="social_icon-email"></i>
							</span>
						</span>
					</a>
					<?php }
				}?>
			</div>
		</div>
	<?php }
	
	if ($total_users > $total_query) {
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
get_footer();?>