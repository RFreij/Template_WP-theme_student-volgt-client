<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 28-3-2017
 * Time: 23:27
 */

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = array( 'home.twig' );

Timber::render( $templates, $context );