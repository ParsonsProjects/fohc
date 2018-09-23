<?php

function buttons($atts, $content) {
	extract(shortcode_atts(array(
		'link' => '',
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
		
		if($link=='') {
			$link='';
		}else {
		$link = 'href="'. $link . '" ';
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
				
		return '<div class="'.$float.'" style="'.$align.'"><a class="button '.$color.' '.$size.'" '. $link.$target.'>'.do_shortcode($content). '</a></div>';
	
	}

add_shortcode('button', 'buttons');


?>