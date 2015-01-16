<?php
/*
Template Name: Exemple
*/

get_header(); ?>
<?php the_post(); ?>
<div id="primary" class="content mod item full-width">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php edit_post_link( __( 'Edit', 'presstige' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->

	<?php //comments_template( '', true ); ?>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>

<?php get_footer(); ?>