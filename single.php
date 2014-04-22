<?php

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<nav class="nav-single">
						<p class="assistive-text"><?php _e( 'Post navigation', 'presstige' ); ?></p>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'presstige' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'presstige' ) ); ?></span>
				</nav><!-- #nav-single -->

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
								printf( __( '<span class="meta-prep meta-prep-author">Posted on </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a> <span class="meta-sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'presstige' ),
									get_permalink(),
									get_the_date( 'c' ),
									get_the_date(),
									get_author_posts_url( get_the_author_meta( 'ID' ) ),
									sprintf( esc_attr__( 'View all posts by %s', 'presstige' ), get_the_author() ),
									get_the_author()
								);
							?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'presstige' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					
					<footer class="entry-meta">			
						<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'presstige' ) . '</span>', ', ', '<span class="meta-sep"> - </span>' ); ?>
						<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'presstige' ), __( '1 Comment', 'presstige' ), __( '% Comments', 'presstige' ) ); ?></span>
						<?php edit_post_link( __( 'Edit', 'presstige' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					</footer><!-- #entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<nav class="nav-single">
						<p class="assistive-text"><?php _e( 'Post navigation', 'presstige' ); ?></p>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'presstige' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'presstige') ); ?></span>
				</nav><!-- #nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>