<?php 

// Function by Wizylabs to retrieve and cache the Twitter feed & https://github.com/J7mbo/twitter-api-php for 1.1 API
function get_tweets( $username, $count )
{	

	ini_set('display_errors', 1);
	require_once('twitterAPIExchange.php');

	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
	    'oauth_access_token' => "25600209-g9QZajPScY2iw92jpklgG0LZIQ0tnwY5YbTm8EP8m",
	    'oauth_access_token_secret' => "VpIydIaVOeppp8erTmuAbCHIlTrsvqyHRbclUbU",
	    'consumer_key' => "vPlb1jRGgOrttUz290l4Q",
	    'consumer_secret' => "jdkxz1NZfXeM7JQaSfjzCsqfWXQ9xN1etE3Cn6IkpsE"
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=' . $username . '&count=' . $count;
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$tweets = $twitter->setGetfield($getfield)
	                    ->buildOauth($url, $requestMethod)
	                    ->performRequest();

	var_dump(json_decode($tweets));

	$cache_expire	= 10*60;
	$cache			= get_option( 'siteurl' );
	
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