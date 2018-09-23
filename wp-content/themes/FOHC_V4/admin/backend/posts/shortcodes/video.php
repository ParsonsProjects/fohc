<?php
function video_miza($atts, $content) {
	extract(shortcode_atts(array(
		'id' => '',
		'type' => ''
			), $atts));
		if ($type=='youtube') {
			$type="http://www.youtube.com/embed/";
			} elseif($type == 'vimeo') {
				$type= "http://player.vimeo.com/video/";
			} elseif($type == 'daily') {
				$type= "http://www.dailymotion.com/swf/video/";
			} 							
		return '<div class="post-video">
              		<iframe src="'.$type.$id.'" frameborder="0" allowfullscreen></iframe>
             	</div>';

	}

add_shortcode('video', 'video_miza');

?>