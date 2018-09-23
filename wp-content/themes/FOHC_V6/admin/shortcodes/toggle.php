<?php

function toggle($atts, $content) {
	extract(shortcode_atts(array(
		'type' => '',/*frame - min*/
                'style'=> '',/*Open - Close*/
                'title' => ''
		), $atts));
	if($type=='') {
		$type='';
	} else {
		$type='_'. $type;
	}

	$output .= '<div class="toggle_wrap'.$type.' '.$style.$type.'"><br />';
	$output .=		'<h4 class="toggle'.$type.'">'.$title.'</h4><br />';
	$output .=		'<div class="toggle_content'.$type.' toggle_'.$style.'">'.do_shortcode($content).'</div><br />';
	$output .= '</div>';
			
	return $output;
			
	}

add_shortcode('toggle', 'toggle');


?>