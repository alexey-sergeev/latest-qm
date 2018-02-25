<?php
/**
 * Template part for displaying single posts
 *
 * @package Latest
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-meta no-sidebar">
		<?php
    //		$user_id = get_post_field( 'post_author', get_the_ID() );
            if ( is_user_logged_in() ) {
                
                $user_id = get_current_user_id();
                $user_avatar = get_avatar( $user_id, 100);

                if ( function_exists( 'bp_core_get_user_domain' ) ) {

                    $user_name = get_the_author_meta( 'display_name', $user_id );
                    $user_url = bp_core_get_user_domain( $user_id );
                    echo '<div class="byline center"><span class="author vcard"><a class="url fn n" href="' . esc_url( $user_url ) . '">' . $user_avatar . esc_html( $user_name ) . '</a></div>';
                    
                } else {
                    
                    $user_name = get_the_author_meta( 'display_name', $user_id );
                    $user_url = the_author_link( $user_id );
                    echo '<div class="byline center"><span class="author vcard">' . $user_avatar . esc_html( $user_name ) . '</div>';

                }
                
            }
                


			if ( function_exists( 'epc_get_primary_term_posts' ) ) {
				$primary_category = get_post_meta( get_the_ID(), 'epc_primary_category', true );
				if ( $primary_category ) {
					$the_category = '<a href="' . esc_url( get_category_link( $primary_category ) ) . '" class="entry-cat">' . esc_html( get_cat_name( $primary_category ) ) . '</a><span class="entry-cat-sep"> / </span>';
				} else {
					$categories = get_the_category();
					if ( ! empty( $categories ) ) {
						$the_category = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="entry-cat">' . esc_html( $categories[0]->name ) . '</a><span class="entry-cat-sep"> / </span>';
					} else {
						$the_category = '';
					}					
				}
				echo $the_category;
			}
		//latest_posted_on(); ?>
	</div><!-- .entry-meta.no-sidebar -->

	<div class="entry-content single-entry-content">

        <?php

            if ( has_post_thumbnail() ) { 
            $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                if ( $image_attributes[1] <= $image_attributes[2] ) { ?>
                    <p class="featured-image"><?php the_post_thumbnail( 'full' ); ?></p>
                <?php } 
            }
            
            the_content();
        ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'latest' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php latest_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

