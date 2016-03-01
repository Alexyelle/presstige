<?php
  

get_header(); ?>

<div id="primary" role="region" class="content mod fl w70 mrl">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Recent Articles', 'presstige' ); ?></h1>
	</header><!-- .entry-header -->
	<?php get_template_part( 'loop', 'index' ); ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>