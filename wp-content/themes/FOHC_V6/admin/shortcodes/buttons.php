<?php

function buttons($atts, $content) {
	extract(shortcode_atts(array(
		'url' => '',
		'target' => '',
		'color' => '',
		'size' => '',
		'align' => '',
		'float' => ''
		), $atts));

		if($target=='') {
			$target='';
		}else {
			$target = 'target="'. $target .'" ';
		}
		
		if($url=='') {
			$url='';
		}else {
			$url = 'href="'. $url . '" ';
		}
		
		if ($align=='left') {
			$align = 'text-align:left;';
		} elseif ($align == 'right') {
			$align = 'text-align:right;';	
		} elseif($align == 'center') {
			$align = 'text-align:center;';	
		}
		if ($float == '') {
			$float='';			
		} elseif($float == 'left') {
			$float = 'float-left';
		} elseif ($float=='right') {
			$float = 'float-right';
		}
				
		return '<div class="'.$float.'" style="'.$align.'"><a class="btn '.$color.' '.$size.'" '. $url . ' ' . $target.'>'.do_shortcode($content). '</a></div>';
	
	}

add_shortcode('button', 'buttons');


?>