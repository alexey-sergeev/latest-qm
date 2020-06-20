<?php
/**
 * The template for displaying 404 page
 *
 * @package Latest
 */

get_header();
?>

<div class="row justify-content-center mb-4">
	<div class="col-lg-3 col-md-6 col-9 text-align-center">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ghost.png">
	</div>
</div>
	
<div class="row justify-content-center mb-5">
	<div class="text-center mb-5">
		<p class="h5">Ой. Тест, который вам нужен, не существует, </p>
		<p class="h5">но зато существует много других интересных тестов.</p>
		<p class="h5">Найдите их в каталоге или введите правильный </p>
		<p class="h5">код приглашения: <a href="<?php echo get_site_url(); ?>">главная страница</a></p>
	</div>
</div>


<?php get_footer(); ?>
