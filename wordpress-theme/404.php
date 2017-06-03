<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 29-3-2017
 * Time: 13:10
 */
$context = Timber::get_context();

$views = array( "not_found.twig" );

Timber::render( $views, $context );