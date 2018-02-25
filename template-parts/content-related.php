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

$cats = get_the_term_list( $post->ID, 'quiz_category', '<i class="fas fa-tags mr-2 text-secondary"></i>' , ', ' );

echo '<p>' . $cats . '</p>';


?>