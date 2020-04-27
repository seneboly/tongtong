<?php
	$header_wrapper = bubulla_get_pageheader_wrapper();
	$header_class = bubulla_get_pageheader_class();
	$pageheader_layout = bubulla_get_pageheader_layout();
	$pageheader_class = bubulla_get_pageheader_parallax_class();
	$navbar_layout = bubulla_get_navbar_layout();
?>
<div class="ltx-content-wrapper <?php echo esc_attr($header_wrapper.' '.$navbar_layout); ?>">
	<div class="header-wrapper <?php echo esc_attr($header_class .' ltx-pageheader-'. $pageheader_layout); ?>">
	<?php
		get_template_part( 'tmpl/navbar' );

		if ( $pageheader_layout != 'disabled' AND $pageheader_layout != 'narrow' ) : ?>
		<header class="<?php echo esc_attr($pageheader_class); ?>">
			<?php bubulla_the_tagline_header(); ?>
		    <div class="container">
		    	<span class="ltx-before"></span>
		    	<?php	
			    	bubulla_the_h1();			
					bubulla_the_breadcrumbs();
				?>	 
				<span class="ltx-after"></span>
				<div class="ltx-header-icon"></div>
			    <?php bubulla_the_social_header(); ?>
		    </div>
		</header>
		<?php endif; ?>
	</div>