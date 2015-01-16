<?php

get_header(); ?>

<?php the_post(); ?>

<div id="primary" role="region" class="content mod left w70 mrl">
	<header class="page-header">
		<h1 class="page-title"><?php
			printf( __( 'Tag Archives: %s', 'presstige' ), '<span>' . single_tag_title( '', false ) . '</span>' );
		?></h1>
	</header>

	<?php rewind_posts(); ?>

	<?php get_template_part( 'loop', 'tag' ); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>