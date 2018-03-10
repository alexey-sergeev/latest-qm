<?php
/**
 * Template part for displaying related posts
 *
 * @package Latest
 */

?>

<div class="related-posts">
<h2><br /></h2>
</div>


<?php

global $post;

$user_id = get_the_author_meta( 'ID' );
$user_name = get_the_author_meta( 'display_name' );
// $user_avatar = get_avatar( $user_id, 50 );

if ( function_exists( 'bp_core_get_user_domain' ) ) {

    $user_url = bp_core_get_user_domain( $user_id );
    
} else {
    
    $user_url = get_the_author_link( $user_id );

}

$author = '<i class="fas fa-user mr-2 text-secondary"></i><a href="' . $user_url . '">' . $user_name . '</a>';
$date = '<i class="fas fa-calendar-alt mr-2 ml-2 text-secondary"></i>' . get_the_modified_date( 'd.m.Y H:i' );

// p($user_url);

$cats = get_the_term_list( $post->ID, 'quiz_category', '<i class="fas fa-tags mr-2 text-secondary"></i>' , ', ' );


echo '<p>';
echo $author;
echo $date;
echo '</p>';

echo '<p>';
echo $cats;
echo '</p>';
?>

