<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 29-3-2017
 * Time: 13:09
 */

$context = Timber::get_context();

$context['title'] = "Archief";

if ( is_day() ) {
	$context['title'] = "Archief voor: " . get_the_date( 'D M Y' );
}
else if ( is_month() ) {
	$context['title'] = "Archief voor: " . get_the_date( 'M Y' );
}
else if ( is_year() ) {
	$context['title'] = "Archief voor: " . get_the_date( 'Y' );
}
else if ( is_tag() ) {
	$context['title'] = "Archief voor: " . single_tag_title('', false );
}
else if ( is_category() ) {
	$context['title'] = "Archief voor: " . single_cat_title('', false );
}

$context['posts'] = Timber::get_posts();

ob_start();
dynamic_sidebar("primary" );
$context['sidebar'] = ob_get_contents();
ob_end_clean();

$views = array( "archive.twig" );

Timber::render( $views, $context );