<header class="site-header navbar navbar-default navbar-static-top" role="banner">
	<nav id="main-menu" class="collapse navbar-collapse" role="navigation">
		<?php
		if (has_nav_menu('primary_navigation')) :
			wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
		endif;
		?>
	</nav>
</header>