<?php 

// Acquires contents of RSS feeds for output in certain widgets and plugins
function bones_file_contents( $url )
{
	if( function_exists('curl_init') )
	{
		$ch = curl_init();
		$timeout = 0; // set to zero for no timeout

		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$file_contents = curl_exec($ch); // take out the spaces of curl statement!!

		if ( !$file_contents )
		{
			print_r( curl_getinfo( $ch ) );
			die;
		}

		curl_close( $ch );	
	}
	else
	{
		$file_contents = file_get_contents( $url );
	}
	
	return $file_contents;
}

// Function by Wizylabs to retrieve and cache the Twitter feed
function bones_get_tweets( $username, $count, $id )
{	
	$tweets			= 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $count;
	$tweets			= bones_file_contents( $tweets );
	$cache_expire	= 10*60;
	$cache			= get_option( $id );
	
	if( is_array( $cache ) )
		extract( $cache );
	
	if( $cached_username !== $username 							||
		$cached_count !== $count								||
		$cache_expire < (current_time('timestamp')-$cached_on)  ||
		!$cache )
	{
		if( $tweets !== false )
		{
			$tweets = json_decode( $tweets );
			
			if( !isset( $tweets->error ) )
			{
				$_tweets = array();
		
				foreach( $tweets as $k => $tweet )
				{
					$_tweet = $tweet->text;
					$_tweet = html_entity_decode( $_tweet );
					$_tweet = str_replace( "&#8211;", "&mdash;", $_tweet );
					$_tweet = preg_replace( "/(http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)/", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $_tweet );
					$_tweet = preg_replace( "/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $_tweet );
					$_tweet = preg_replace( "/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $_tweet );
		
					$tweet_time = strtotime( $tweet->created_at );
					$tweet_time = human_time_diff( $tweet_time, current_time('timestamp') );
		
					$_tweets[$k]['user'] = $tweet->user;
					$_tweets[$k]['time'] = $tweet->created_at;
					$_tweets[$k]['source'] = $tweet->source;
					$_tweets[$k]['tweet'] = $_tweet;
					$_tweets[$k]['created_at'][] = $tweet->created_at;
					$_tweets[$k]['created_at']['human_diff'] = $tweet_time;
					$_tweets[$k]['link'] = 'https://twitter.com/'.$username.'/status/'.$tweet->id;
				}
	
				update_option( $id, array(
					'content' => $_tweets,
					'cached_on' => current_time('timestamp'),
					'cached_username' => $username,
					'cached_count' => $count
				));
			
				$tweets = $_tweets;
			}
			else
			{
				if( $cache )
					$tweets = $content;
			}
		}
		else
		{
			if( $cache )
				$tweets = $content;
		}
	}
	else
	{
		if( $cache )
			$tweets = $content;
	}
	
	return $tweets;
}

?>