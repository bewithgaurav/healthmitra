<?php
/* Login */
add_action( 'widgets_init', 'widget_login_widget' );
function widget_login_widget() {
	register_widget( 'Widget_Login' );
}

class Widget_Login extends WP_Widget {

	function Widget_Login() {
		$widget_ops = array( 'classname' => 'login-widget'  );
		$control_ops = array( 'id_base' => 'login-widget' );
		parent::__construct( 'login-widget','Ask me - Login', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title                = apply_filters('widget_title', $instance['title'] );
		$not_login            = esc_attr($instance['not_login']);
		$register_like_button = esc_attr($instance['register_like_button']);
		if (empty($not_login) || !is_user_logged_in()) {
			echo $before_widget;
				if ( $title )
					echo $before_title.esc_attr($title).$after_title;?>
				<div class="widget_login">
					<?php if (!is_user_logged_in()) {
						echo '<div class="form-style form-style-2">
							'.do_shortcode("[ask_login".(isset($register_like_button) && $register_like_button == "on"?" register='button'":"")."]");
							if (empty($register_like_button)) {
								echo '<ul class="login-links login-links-r">
									<li><a href="#">'.__("Register","vbegy").'</a></li>
								</ul>';
							}
							echo '<div class="clearfix"></div>
						</div>';
					}else {
						echo is_user_logged_in_data($instance['user_links']);
					}?>
				</div>
				<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance		                  = $old_instance;
		$instance['title']                = strip_tags( $new_instance['title'] );
		$instance['not_login']            = $new_instance['not_login'];
		$instance['user_links']           = $new_instance['user_links'];
		$instance['register_like_button'] = $new_instance['register_like_button'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Login','vbegy'),'user_links' => array("profile" => "on","questions" => "on","answers" => "on","favorite" => "on","points" => "on","i_follow" => "on","followers" => "on","posts" => "on","follow_questions" => "on","follow_answers" => "on","follow_posts" => "on","follow_comments" => "on","edit_profile" => "on","logout" => "on"));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['not_login']) && $instance['not_login'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'not_login' ); ?>" name="<?php echo $this->get_field_name( 'not_login' ); ?>">
			<label for="<?php echo $this->get_field_id( 'not_login' ); ?>">Display it for not login only ?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['register_like_button']) && $instance['register_like_button'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'register_like_button' ); ?>" name="<?php echo $this->get_field_name( 'register_like_button' ); ?>">
			<label for="<?php echo $this->get_field_id( 'register_like_button' ); ?>">Register like button ?</label>
		</p>
		<p>
			<label>Select the user links : </label><br><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["profile"]) && $instance['user_links']["profile"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-profile" name="<?php echo $this->get_field_name( 'user_links' ); ?>[profile]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-profile">Profile page</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["questions"]) && $instance['user_links']["questions"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-questions" name="<?php echo $this->get_field_name( 'user_links' ); ?>[questions]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-questions">Questions</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["answers"]) && $instance['user_links']["answers"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-answers" name="<?php echo $this->get_field_name( 'user_links' ); ?>[answers]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-answers">Answers</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["favorite"]) && $instance['user_links']["favorite"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-favorite" name="<?php echo $this->get_field_name( 'user_links' ); ?>[favorite]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-favorite">Favorite Questions</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["points"]) && $instance['user_links']["points"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-points" name="<?php echo $this->get_field_name( 'user_links' ); ?>[points]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-points">Points</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["i_follow"]) && $instance['user_links']["i_follow"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-i_follow" name="<?php echo $this->get_field_name( 'user_links' ); ?>[i_follow]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-i_follow">Authors I Follow</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["followers"]) && $instance['user_links']["followers"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-followers" name="<?php echo $this->get_field_name( 'user_links' ); ?>[followers]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-followers">Followers</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["posts"]) && $instance['user_links']["posts"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-posts" name="<?php echo $this->get_field_name( 'user_links' ); ?>[posts]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-posts">Posts</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["follow_questions"]) && $instance['user_links']["follow_questions"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_questions" name="<?php echo $this->get_field_name( 'user_links' ); ?>[follow_questions]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_questions">Follow Questions</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["follow_answers"]) && $instance['user_links']["follow_answers"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_answers" name="<?php echo $this->get_field_name( 'user_links' ); ?>[follow_answers]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_answers">Follow Answers</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["follow_posts"]) && $instance['user_links']["follow_posts"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_posts" name="<?php echo $this->get_field_name( 'user_links' ); ?>[follow_posts]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_posts">Follow Posts</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["follow_comments"]) && $instance['user_links']["follow_comments"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_comments" name="<?php echo $this->get_field_name( 'user_links' ); ?>[follow_comments]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-follow_comments">Follow Comments</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["edit_profile"]) && $instance['user_links']["edit_profile"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-edit_profile" name="<?php echo $this->get_field_name( 'user_links' ); ?>[edit_profile]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-edit_profile">Edit Profile</label><br>
			
			<input <?php echo (isset($instance['user_links']) && is_array($instance['user_links']) && (isset($instance['user_links']["logout"]) && $instance['user_links']["logout"] == "on")?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'user_links' ); ?>-logout" name="<?php echo $this->get_field_name( 'user_links' ); ?>[logout]" type="checkbox">
			<label for="<?php echo $this->get_field_id( 'user_links' ); ?>-logout">Logout</label>
		</p>
	<?php
	}
}
?>