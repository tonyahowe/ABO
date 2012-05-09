d="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>

<!-- in css, this has been styled display:none, but may as well comment it out, no?
 					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'brunelleschi' ), 'after' => '</div>' ) ); ?>
-->

						<?php edit_post_link( __( 'Edit', 'brunelleschi' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>
