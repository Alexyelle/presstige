<?php
get_header(); ?>
<?php the_post(); ?>

<div id="primary" role="region" class="content mod fl w70 mrl">
	<header class="page-header">
		<h1 class="page-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'presstige' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'presstige' ), get_the_date( 'F Y' ) ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'presstige' ), get_the_date( 'Y' ) ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'presstige' ); ?>
			<?php endif; ?>
		</h1>
	</header>

	<?php rewind_posts(); ?>

	<?php get_template_part( 'loop', 'archive' ); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>