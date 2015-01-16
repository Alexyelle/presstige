<?php
/*
Template Name: Page d'actualités
*/
get_header(); ?>

<div id="primary" class="content mod item full-width">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
	<hr>

	<?php 
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts("showposts=2&paged=$page"); 
	?>

	<?php get_template_part( 'loop', 'index' ); ?>

</div>


<?php 
	wp_reset_query();
	get_footer(); 
?>