<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 5-4-2017
 * Time: 13:21
 */

$templates = array('search.twig');
$context = Timber::get_context();

$context['search_query'] = get_search_query();
$context['title'] = 'Zoekresultaten voor ' . get_search_query();
$context['posts'] = Timber::get_posts();

ob_start();
dynamic_sidebar("primary" );
$context['sidebar'] = ob_get_contents();
ob_end_clean();

Timber::render($templates, $context );