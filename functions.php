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

?>