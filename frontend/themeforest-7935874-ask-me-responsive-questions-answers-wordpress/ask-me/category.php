<?php get_header();
	$blog_style         = vpanel_options("home_display");
	$category_id        = esc_attr(get_query_var('cat'));
	$categories         = get_option("categories_$category_id");
	$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
	if ($cat_sidebar_layout == "default") {
		$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	}else {
		$vbegy_sidebar_all = $cat_sidebar_layout;
	}
	get_template_part("loop","category");
	vpanel_pagination();
get_footer();?>