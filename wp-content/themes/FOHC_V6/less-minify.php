<?php

	// Include phpless file
	require get_template_directory_uri() . "/less/assets/lessc.inc.php";	
	
	function autoCompileLess($inputFile, $outputFile) {
	  // load the cache
	  $cacheFile = get_template_directory_uri() . "less/assets/cache/theme.less.cache";
	
	  if (file_exists($cacheFile)) {
		$cache = unserialize(file_get_contents($cacheFile));
	  } else {
		$cache = $inputFile;
	  }
	
	  $less = new lessc;
	  $less->setFormatter("compressed"); // compresse css
	  $newCache = $less->cachedCompile($cache);
	
	  if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
		file_put_contents($cacheFile, serialize($newCache));
		file_put_contents($outputFile, $newCache['compiled']);
	  }
	  
	}
	
	autoCompileLess(get_template_directory_uri() . 'less/styles.less', get_template_directory_uri() . 'css/theme.css');
	
	

?>