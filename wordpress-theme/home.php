<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 29-3-2017
 * Time: 13:10
 */

$context = Timber::get_context();

$context['posts'] = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();

ob_start();
dynamic_sidebar("primary" );
$context['sidebar'] = ob_get_contents();
ob_end_clean();

$views = array( "home.twig" );

Timber::render( $views, $context );