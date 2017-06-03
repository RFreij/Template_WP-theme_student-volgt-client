<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 29-3-2017
 * Time: 13:09
 */

$context = Timber::get_context();

$context['post'] = new TimberPost();

ob_start();
dynamic_sidebar("primary" );
$context['sidebar'] = ob_get_contents();
ob_end_clean();

$views = array( "page.twig" );

Timber::render( $views, $context );