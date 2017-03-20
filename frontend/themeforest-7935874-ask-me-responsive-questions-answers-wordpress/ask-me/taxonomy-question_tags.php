<?php get_header();
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	get_template_part("loop-question","category");
	vpanel_pagination();
get_footer();?>