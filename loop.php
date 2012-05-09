<?php if ( $wp_query->max_num_pages > 1 ) : ?>
  <nav id="nav-above" class="navigation">
   <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'brunelleschi' ) ); ?></div>
   <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'brunelleschi' ) ); ?></div>
  </nav><!-- #nav-above -->
<?php endif; ?>

<?php if ( ! have_posts() ) : ?>
  <div id="post-0" class="post error404 not-found">
    <h1 class="entry-title"><?php _e( 'Not Found', 'brunelleschi' ); ?></h1>
    <div class="entry-content">
      <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'brunelleschi' ); ?></p>
      <?php get_search_form(); ?>
    </div><!-- .entry-content -->
  </div><!-- #post-0 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
  <?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'brunelleschi' ) ) ) : ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'brunelleschi' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      <?php if(brunelleschi_option('posted-on') === 'Above Post'): ?>
        <div class="entry-meta">
          <?php brunelleschi_posted_on(); ?>
        </div><!-- .entry-meta -->
      <?php endif; ?>
    </header>
    <div class="entry-content">
  <!-- end -->
      <?php if ( post_password_required() ) : ?>
        <?php the_content(); ?>
        <?php else : ?>
        <?php
    	  $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) ); if ( $images ) :
	  $total_images = count( $images );
	  $image = array_shift( $images );
	  $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
        ?>
        <div class="gallery-thumb">
          <a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
        </div><!-- .gallery-thumb -->
        <p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'brunelleschi' ),
  	  'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'brunelleschi' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
	  number_format_i18n( $total_images )
         ); ?></em></p>
       <?php endif; ?>
       <?php the_excerpt(); ?>
     <?php endif; ?>
    </div><!-- .entry-content -->

    <div class="entry-utility">
      <?php if(brunelleschi_option('posted-on') === 'Below Post'): ?>
 	 <div class="entry-meta">
	   <?php brunelleschi_posted_on(); ?>
	 </div><!-- .entry-meta -->
      <?php endif; ?>
	<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
 	  <a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'brunelleschi' ); ?>"><?php _e( 'More Galleries', 'brunelleschi' ); ?></a>
	  <span class="meta-sep">|</span>
	<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'brunelleschi' ) ) ) : ?>
	  <a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'brunelleschi' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'brunelleschi' ); ?>"><?php _e( 'More Galleries', 'brunelleschi' ); ?></a>
	  <span class="meta-sep">|</span>
	<?php endif; ?>
	<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'brunelleschi' ), __( '1 Comment', 'brunelleschi' ), __( '% Comments', 'brunelleschi' ) ); ?></span>
	<?php edit_post_link( __( 'Edit', 'brunelleschi' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
    </div><!-- .entry-utility -->
  </article><!-- #post-## -->

  <?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'brunelleschi' ) )  ) : ?>
    <aside id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
      <div class="entry-summary">
	<?php if( brunelleschi_option('archives-format') === '1' ){ the_content(); }else{ the_excerpt(); } ?>
        </div><!-- .entry-summary -->
        <?php else : ?>
          <div class="entry-content">
	   <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'brunelleschi' ) ); ?>
          </div><!-- .entry-content -->
	<?php endif; ?>

	<div class="entry-utility">
	  <?php brunelleschi_posted_on(); ?>
	  <span class="meta-sep">|</span>
	  <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'brunelleschi' ), __( '1 Comment', 'brunelleschi' ), __( '% Comments', 'brunelleschi' ) ); ?></span>
	  <?php edit_post_link( __( 'Edit', 'brunelleschi' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-utility -->
    </aside><!-- #post-## -->

    <?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
	  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'brunelleschi' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	  <?php if(brunelleschi_option('posted-on') === 'Above Post'): ?>
	  <div class="entry-meta">
	    <?php brunelleschi_posted_on(); ?>
	  </div><!-- .entry-meta -->
        <?php endif; ?>
	</header>

    <?php if ( is_archive() || is_search() ) : ?>
	<div class="entry-summary">
 	  <?php if( brunelleschi_option('archives-format') === '1' ){ the_content(); }else{ the_excerpt(); } ?>
	</div><!-- .entry-summary -->
    <?php else : ?>
	<div class="entry-content">
  	  <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'brunelleschi' ) ); ?>
	  <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'brunelleschi' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    <?php endif; ?>

    <div class="entry-utility">
	<?php if(brunelleschi_option('posted-on') === 'Below Post'): ?>
	<div class="entry-meta">
		<?php brunelleschi_posted_on(); ?>
	</div><!-- .entry-meta -->
        <?php endif; ?>
        <?php if ( count( get_the_category() ) ) : ?>
	  <span class="cat-links">
	    <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'brunelleschi' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
 	  </span>
	  <span class="meta-sep">|</span>
	<?php endif; ?>
	<?php
	$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ):
	?>
	<span class="tag-links">
 	  <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'brunelleschi' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
	</span>
	<span class="meta-sep">|</span>
	<?php endif; ?>
	<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'brunelleschi' ), __( '1 Comment', 'brunelleschi' ), __( '% Comments', 'brunelleschi' ) ); ?></span>
    </div><!-- .entry-utility -->
</article><!-- #post-## -->

<?php comments_template( '', true ); ?>

<?php endif; ?>

<?php endwhile; ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" class="navigation">
	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'brunelleschi' ) ); ?></div>
	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'brunelleschi' ) ); ?></div>
	</nav><!-- #nav-below -->
<?php endif; ?>

