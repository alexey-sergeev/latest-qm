<?php

function latest_entry_footer( $exclude_cat_id = false ) {


	echo '<span class="edit-link"></span>';


	// Hide category and tag text for pages.
	if ( get_post_type() === 'post' || get_post_type() === 'quiz' ) {
	        
		$categories_list = latest_get_the_category_list( $exclude_cat_id, ' / ' );

		if ( $categories_list && latest_categorized_blog() ) {
			echo '<span class="cat-links">' . $categories_list . '</span>';
		}

		$quiz_categories_list = latest_get_the_quiz_category_list( $exclude_cat_id, ' / ' );

		if ( $quiz_categories_list && latest_categorized_blog() ) {
			echo '<span class="cat-links">' . $quiz_categories_list . '</span>';
		}

		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			echo '<span class="tags-links">' . $tags_list . '</span>';
		}

		global $post;
		if ( $post->post_type != 'quiz')
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post for screen readers */
				'<i class="fas fa-pencil-alt"></i>' . esc_html__( 'Edit %s', 'latest' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);

	} 
}

function latest_get_the_quiz_category_list($exclude,$separator = false) {

	if ( !$separator ) {
		$separator = ' / ';
	}
	$categories = get_the_terms( false, 'quiz_category' );

	$categories = array_values( (array) $categories );

	foreach ( array_keys( (array) $categories ) as $key ) {
		_make_cat_compat( $categories[$key] );
	}


	$output = '';
	if ( $categories ) {
		foreach ( $categories as $category ) {
			if( isset($category->term_id) && $category->term_id != $exclude ) {
				$output .= '<a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>' . $separator;
			}
		}
		$output = trim( $output, $separator );
	}

	return $output;
}




function latest_header_title() { 

if ( is_singular() && !is_front_page() ) {

if ( get_post_format() == 'video' ) {
    $content = apply_filters( 'the_content', get_post( get_the_ID() )->post_content );
    $video = false;
    // Only get video from the content if a playlist isn't present.
    if ( false === strpos( $content, 'wp-playlist-script' ) ) {
        $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
    }
    if ( ! empty( $video ) ) {
        $video_entry = 'on';
        $first_video = true;
        foreach ( $video as $video_html ) {
            if ( $first_video ) {
                echo '<div class="container video-container">
                <div id="entry-video" class="entry-video single">';
                    echo $video_html;
                echo '</div>
                </div>';
                $first_video = false;
            }
        }
    } else {
        $video_entry = 'off';
    };

} else {
$video_entry = 'off';
}

if ( has_post_thumbnail() && $video_entry == 'off' ) { 
    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
    if ( $image_attributes[1] = $image_attributes[2] ) { ?>
        <header class="container entry-header singular with-image">
            <div class="title-wrapper" style="background-image: url('<?php echo esc_url( $image_attributes[0] ); //echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>')">
    <?php } else { ?>
        <header class="container entry-header singular">
            <div class="title-wrapper">	
    <?php }
    } else { ?>
    <header class="container entry-header singular">
        <div class="title-wrapper">
<?php } ?>
<a href="<?php echo get_permalink(); ?>">
        <?php the_title( '<h1 class="entry-title"><i class="latest-entry-icon"></i>', '</h1>' ); ?>
</a>
        </div>
    </header><!-- .entry-header.singular -->
<?php
    $trusted_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt') );
    if ( $trusted_excerpt ) {
        echo '<div class="entry-excerpt container">';
        echo $trusted_excerpt;
        echo '</div>';
    }
if ( is_single() && is_active_sidebar( 'latest-sidebar' ) ) { ?>
<div class="entry-meta container">
    <?php $author_id = get_post_field( 'post_author', get_the_ID() );
        $author_name = get_the_author_meta( 'display_name', $author_id );
        $author_url = get_author_posts_url( $author_id );
        $author_avatar = get_avatar( $author_id, 80);
        echo '<div class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url( $author_url ) . '">' . $author_avatar . esc_html( $author_name ) . '</a></div>';
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
    latest_posted_on(); ?>
</div><!-- .entry-meta -->
<?php } ?>
<?php } elseif ( is_archive() ) { ?>
    <header class="container entry-header archive">
        <div class="entry-wrapper">
        <?php if ( is_tag() ) { ?>
            <h1 class="entry-title"><span class="hashtag">#</span><?php echo single_cat_title(); ?></h1>
        <?php } elseif ( is_category() ) { ?>
            <h1 class="entry-title"><?php echo single_cat_title(); ?></h1>
        <?php } else {
            the_archive_title( '<h1 class="entry-title">', '</h1>' );
            }
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
        </div>
    </header><!-- .entry-header.archive -->	
<?php } elseif ( is_search() ) { ?>
    <header class="container entry-header search">
        <div class="entry-wrapper">
        <h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'latest' ), '<i>' . get_search_query() . '</i>' ); ?></h1>
        </div>
    </header><!-- .entry-header.search -->	
<?php }	elseif ( is_404() ) { ?>
    <header class="container entry-header not-found">
        <div class="entry-wrapper">
        <h1 class="entry-title"><?php esc_html_e( '404 Error - Not Found', 'latest' ); ?></h1>
        </div>
    </header><!-- .entry-header.not-found -->	
<?php } ?>

<div class="container clearfix">
<?php }

function latest_powered_by(){
    ?>
            <div class="site-info">
                <a href="http://edu.vspu.ru/"><?php echo __( 'Образовательный портал', 'mif-qm' ); ?></a>
                <span class="sep"> | </span>
                <a href="http://vspu.ru/"><?php echo __( 'ФГБОУ ВО «ВГСПУ»', 'mif-qm' ); ?></a>, <?php echo date( 'Y' ) ?> <?php echo __( 'г.', 'mif-qm' ); ?>
            </div>
    <?php
}


apply_filters( 'get_the_archive_title', $title );

add_filter( 'get_the_archive_title', 'my_archive_title' );
function my_archive_title($content){
	$out = "Каталог тестов";
	return $out;
}


?>