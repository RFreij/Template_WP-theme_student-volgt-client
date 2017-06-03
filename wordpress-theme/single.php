<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 29-3-2017
 * Time: 13:09
 */

$context = Timber::get_context();

$context['post'] = new TimberPost();
$context['is_single'] = true;
//$context['comments'] = Timber::get_comments($ct = 0, $type = 'comment', $status = 'approve', $CommentClass = 'TimberComment');

ob_start();
dynamic_sidebar("primary" );
$context['sidebar'] = ob_get_contents();
ob_end_clean();

$views = array( "single.twig" );

Timber::render( $views, $context );