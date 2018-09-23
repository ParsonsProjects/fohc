<?php

function rows($atts, $content=null, $code) {
	$output .= '<div class="'.$code.'">' . wpautop(do_shortcode($content)) . '</div>';
	return $output;
}


add_shortcode('span1', 'rows');
add_shortcode('span2', 'rows');
add_shortcode('span3', 'rows');
add_shortcode('span4', 'rows');
add_shortcode('span5', 'rows');
add_shortcode('span6', 'rows');
add_shortcode('span7', 'rows');
add_shortcode('span8', 'rows');
add_shortcode('span9', 'rows');
add_shortcode('span10', 'rows');
add_shortcode('span11', 'rows');
add_shortcode('span12', 'rows');


function columns($atts, $content=null, $code) {
	$output .= '<div class="row-fluid">';
	$output .= wpautop(do_shortcode($content));
	$output .= '</div>';
	return $output;
}

add_shortcode('columns', 'columns');

?>