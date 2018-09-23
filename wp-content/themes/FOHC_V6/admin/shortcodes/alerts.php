<?php


function alert($atts, $content) {
	extract(shortcode_atts(array(
		'type' => 'info'	
		), $atts));
		
		$type = 'alert-'.$type.'';

		$output .= '<div class="alert '.$type.'">';
			 $output .= do_shortcode($content);
		$output .= '</div>';
		
		return $output;
}

add_shortcode('alert', 'alert');


?>