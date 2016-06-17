<?php get_template_part('templates/head') ?>
<body <?php body_class(); ?>>
	<?php get_template_part('templates/header') ?>
		<main class="main">

			<div class="container">
				<div id="loader">
					<img src="<?= bloginfo('template_url'); ?>/assets/images/rolling.svg" alt="loading" width="25" height="25" />
				</div>
				<div id="js-wrapper" data-context="<?= get_post_type(); ?>">
					<?php //content gets ajaxed in here ?>
				</div>
			</div>
	
		</main>
	<?php get_template_part('templates/footer') ?>
	<?php wp_footer(); ?>
</body>
</html>