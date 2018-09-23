<?php

function sev_column_wrap( $atts, $content = null ) {
	return '<div class="clearfix">' . do_shortcode($content) . '</div>';
}

add_shortcode('wrap', 'sev_column_wrap');

function sev_third( $atts, $content = null ) {
   return '<div class="third">' . do_shortcode($content) . '</div>';
}

add_shortcode('third', 'sev_third');

function sev_two_third( $atts, $content = null ) {
   return '<div class="third double">' . do_shortcode($content) . '</div>';
}

add_shortcode('two_third', 'sev_two_third');

function sev_half( $atts, $content = null ) {
   return '<div class="half">' . do_shortcode($content) . '</div>';
}

add_shortcode('half', 'sev_half');

function sev_fourth( $atts, $content = null ) {
   return '<div class="fourth">' . do_shortcode($content) . '</div>';
}

add_shortcode('fourth', 'sev_fourth');

function sev_three_fourth( $atts, $content = null ) {
   return '<div class="fourth triple">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fourth', 'sev_three_fourth');

function sev_fifth( $atts, $content = null ) {
   return '<div class="fifth">' . do_shortcode($content) . '</div>';
}

add_shortcode('fifth', 'sev_fifth');

function sev_two_fifth( $atts, $content = null ) {
   return '<div class="fifth double">' . do_shortcode($content) . '</div>';
}

add_shortcode('two_fifth', 'sev_two_fifth');

function sev_three_fifth( $atts, $content = null ) {
   return '<div class="fifth triple">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fifth', 'sev_three_fifth');

function sev_four_fifth( $atts, $content = null ) {
   return '<div class="fifth quad">' . do_shortcode($content) . '</div>';
}

add_shortcode('four_fifth', 'sev_four_fifth');

function sev_sixth( $atts, $content = null ) {
   return '<div class="sixth">' . do_shortcode($content) . '</div>';
}

add_shortcode('sixth', 'sev_sixth');

function sev_five_sixth( $atts, $content = null ) {
   return '<div class="sixth penta">' . do_shortcode($content) . '</div>';
}

add_shortcode('five_sixth', 'sev_five_sixth');

function sev_button( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target'     => '_self',
		'style'   => 'white'
    ), $atts));
	
   return '<a class="button '.$style.'" href="'.$url.'" target="'.$target.'">' . do_shortcode($content) . '</a>';
}

add_shortcode('button', 'sev_button');


?>